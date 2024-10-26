<?php

namespace Modules\Iwallet\Repositories\Eloquent;

use Modules\Iwallet\Entities\Status;
use Modules\Iwallet\Repositories\PocketRepository;
use Modules\Core\Icrud\Repositories\Eloquent\EloquentCrudRepository;
use Carbon\Carbon;

class EloquentPocketRepository extends EloquentCrudRepository implements PocketRepository
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

    // get date range for transactions
    $startDate = $filter->transactionsDate->from ?? Carbon::today();
    $endDate = $filter->transactionsDate->to ?? Carbon::today();

    //Include the transactions by range date
    $query->with('fromPocketTransactions', function ($query) use ($startDate, $endDate) {
      $query->whereDate('created_at', '>=', $startDate)
        ->whereDate('created_at', '<=', $endDate)
        ->where('status_id', Status::COMPLETED);
    });

    //Include the transactions by range date
    $query->with('toPocketTransactions', function ($query) use ($startDate, $endDate) {
      $query->whereDate('created_at', '>=', $startDate)
        ->whereDate('created_at', '<=', $endDate)
        ->where('status_id', Status::COMPLETED);
    });

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
}
