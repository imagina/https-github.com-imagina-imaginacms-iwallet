<?php

namespace Modules\Iwallet\Traits;

use Modules\Iwallet\Entities\Transaction;

trait isTransactionable
{

  public static function bootIsTransactionable()
  {
    //Listen event after create model
    static::createdWithBindings(function ($model) {
      $model->createTransactions($model->getEventBindings('createdWithBindings'));
    });
    //Listen event after update model
    static::updatedWithBindings(function ($model) {
      $model->createTransactions($model->getEventBindings('updatedWithBindings'));
    });
  }

  public function transactions()
  {
    // Define and return the morphOne relationship
    return $this->morphMany(Transaction::class, 'entity');
  }

  /**
   * Create the transactions
   *
   * @param $params
   * @return void
   */
  public function createTransactions($params)
  {
    // Extract the data related to the buildable entity from the parameters.
    $pocketId = $params["data"]["pocket_id"] ?? null;

    if (method_exists($this, 'getTransactionData') && $pocketId && !$this->transactions->count()) {
      $pocketRespository = app('Modules\Iwallet\Repositories\PocketRepository');
      $transactionRepository = app('Modules\Iwallet\Repositories\TransactionRepository');

      //Get the transaction Data
      $transactions = $this->getTransactionData();

      foreach ($transactions as $transaction) {
        $pocket = null; //Reset pocket value
        $entityType = $transaction['pocket']['entity_type'] ?? null;
        $entityId = $transaction['pocket']['entity_id'] ?? null;

        //Get or Create the origin pocket
        if ($entityType && $entityId) {
          $pocket = $pocketRespository->getItem($entityId, json_decode(json_encode(["filter" => [
            "field" => "entity_id", "entity_type" => $entityType
          ]])));
          if (!$pocket) $pocket = $pocketRespository->create($transaction['pocket']);
        }

        //Teniendo ya el pocketId, entonces crear la transaccion con:
        $transactionRepository->create([
          'amount' => $transaction['amount'],
          'comment' => $transaction['comment'] ?? null,
          'to_pocket_id' => $pocket->id ?? $pocketId,
          'entity_type' => $this->getMorphClass(),
          'entity_id' => $this->id,
        ]);
      }
    }
  }
}
