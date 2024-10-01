<?php

namespace Modules\Iwallet\Http\Controllers\Api;

use Modules\Core\Icrud\Controllers\BaseCrudController;
//Model
use Modules\Iwallet\Entities\Transaction;
use Modules\Iwallet\Repositories\TransactionRepository;

class TransactionApiController extends BaseCrudController
{
  public $model;
  public $modelRepository;

  public function __construct(Transaction $model, TransactionRepository $modelRepository)
  {
    $this->model = $model;
    $this->modelRepository = $modelRepository;
  }
}
