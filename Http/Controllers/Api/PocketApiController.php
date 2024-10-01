<?php

namespace Modules\Iwallet\Http\Controllers\Api;

use Modules\Core\Icrud\Controllers\BaseCrudController;
//Model
use Modules\Iwallet\Entities\Pocket;
use Modules\Iwallet\Repositories\PocketRepository;

class PocketApiController extends BaseCrudController
{
  public $model;
  public $modelRepository;

  public function __construct(Pocket $model, PocketRepository $modelRepository)
  {
    $this->model = $model;
    $this->modelRepository = $modelRepository;
  }
}
