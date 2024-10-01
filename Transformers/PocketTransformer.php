<?php

namespace Modules\Iwallet\Transformers;

use Modules\Core\Icrud\Transformers\CrudResource;

class PocketTransformer extends CrudResource
{
  /**
   * Attribute to exclude relations from transformed data
   * @var array
   */
  protected $excludeRelations = [];

  /**
  * Method to merge values with response
  *
  * @return array
  */
  public function modelAttributes($request)
  {
    return [];
  }
}
