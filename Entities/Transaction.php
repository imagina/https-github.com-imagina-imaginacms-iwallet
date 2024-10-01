<?php

namespace Modules\Iwallet\Entities;

use Modules\Core\Icrud\Entities\CrudModel;

class Transaction extends CrudModel
{
  protected $table = 'iwallet__transactions';
  public $transformer = 'Modules\Iwallet\Transformers\TransactionTransformer';
  public $repository = 'Modules\Iwallet\Repositories\TransactionRepository';
  public $requestValidation = [
    'create' => 'Modules\Iwallet\Http\Requests\CreateTransactionRequest',
    'update' => 'Modules\Iwallet\Http\Requests\UpdateTransactionRequest',
  ];
  //Instance external/internal events to dispatch with extraData
  public $dispatchesEventsWithBindings = [
    //eg. ['path' => 'path/module/event', 'extraData' => [/*...optional*/]]
    'created' => [],
    'creating' => [],
    'updated' => [],
    'updating' => [],
    'deleting' => [],
    'deleted' => [],
  ];
  public $translatedAttributes = [];
  protected $fillable = [
    'amount',
    'to_pocket_id',
    'from_pocket_id',
    'comments',
    'status_id',
    'entity_id',
    'entity_type',
  ];
}
