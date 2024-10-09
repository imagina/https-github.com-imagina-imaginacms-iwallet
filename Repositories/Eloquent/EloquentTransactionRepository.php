<?php

namespace Modules\Iwallet\Repositories\Eloquent;

use Modules\Iwallet\Repositories\TransactionRepository;
use Modules\Core\Icrud\Repositories\Eloquent\EloquentCrudRepository;
use Modules\Iwallet\Entities\Status;

class EloquentTransactionRepository extends EloquentCrudRepository implements TransactionRepository
{
  /**
   * Filter names to replace
   * @var array
   */
  protected $replaceFilters = [];

  /**
   * Relation names to replace
   * @var array
   */
  protected $replaceSyncModelRelations = [];

  /**
   * Attribute to define default relations
   * all apply to index and show
   * index apply in the getItemsBy
   * show apply in the getItem
   * @var array
   */
  protected $with = [/*all => [] ,index => [],show => []*/];

  /**
   * Filter query
   *
   * @param $query
   * @param $filter
   * @param $params
   * @return mixed
   */
  public function filterQuery($query, $filter, $params)
  {

    /**
     * Note: Add filter name to replaceFilters attribute before replace it
     *
     * Example filter Query
     * if (isset($filter->status)) $query->where('status', $filter->status);
     *
     */

    //Response
    return $query;
  }

  /**
   * Method to sync Model Relations
   *
   * @param $model ,$data
   * @return $model
   */
  public function syncModelRelations($model, $data)
  {
    //Get model relations data from attribute of model
    $modelRelationsData = ($model->modelRelations ?? []);

    /**
     * Note: Add relation name to replaceSyncModelRelations attribute before replace it
     *
     * Example to sync relations
     * if (array_key_exists(<relationName>, $data)){
     *    $model->setRelation(<relationName>, $model-><relationName>()->sync($data[<relationName>]));
     * }
     *
     */

    //Response
    return $model;
  }

  public function afterCreate(&$model, &$data)
  {
    $this->madeTransaction($model);
  }

  public function afterUpdate(&$model, &$data)
  {
    if (array_key_exists('status_id', $model->getChanges())) {
      $this->madeTransaction($model);
    }
  }

  public function madeTransaction($model)
  {
    // Update 'to' pocket total
    if ($model->to_pocket_id) {
      if (is_null($model->status_id) || $model->status_id == Status::COMPLETED) {
        $model->toPocket->increment('total', $model->amount);
      } else $model->toPocket->decrement('total', $model->amount);
    }

    // Update 'from' pocket total
    if ($model->from_pocket_id) {
      if (is_null($model->status_id) || $model->status_id == Status::COMPLETED) {
        $model->fromPocket->decrement('total', $model->amount);
      } else $model->fromPocket->increment('total', $model->amount);
    }
  }
}
