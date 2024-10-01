<?php

namespace Modules\Iwallet\Entities;

use Astrotomic\Translatable\Translatable;
use Modules\Core\Icrud\Entities\CrudModel;

class Category extends CrudModel
{
  use Translatable;

  protected $table = 'iwallet__categories';
  public $transformer = 'Modules\Iwallet\Transformers\CategoryTransformer';
  public $repository = 'Modules\Iwallet\Repositories\CategoryRepository';
  public $requestValidation = [
    'create' => 'Modules\Iwallet\Http\Requests\CreateCategoryRequest',
    'update' => 'Modules\Iwallet\Http\Requests\UpdateCategoryRequest',
  ];
  protected $casts = ['options' => 'array'];
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
  public $translatedAttributes = [
    'title',
    'description',
  ];
  protected $fillable = [
    'parent_id',
    'options'
  ];

  public function parent()
  {
    return $this->belongsTo('Modules\Iwallet\Entities\Category', 'parent_id');
  }

  public function children()
  {
    return $this->hasMany('Modules\Iwallet\Entities\Category', 'parent_id');
  }
}
