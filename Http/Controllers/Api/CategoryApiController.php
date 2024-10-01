<?php

namespace Modules\Iwallet\Http\Controllers\Api;

use Modules\Core\Icrud\Controllers\BaseCrudController;
//Model
use Modules\Iwallet\Entities\Category;
use Modules\Iwallet\Repositories\CategoryRepository;

class CategoryApiController extends BaseCrudController
{
  public $model;
  public $modelRepository;

  public function __construct(Category $model, CategoryRepository $modelRepository)
  {
    $this->model = $model;
    $this->modelRepository = $modelRepository;
  }
}
