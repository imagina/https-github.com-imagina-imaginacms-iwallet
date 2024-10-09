<?php

namespace Modules\Iwallet\Entities;

use Modules\Core\Icrud\Entities\CrudStaticModel;

class Status extends CrudStaticModel
{
  const COMPLETED = 1;

  const REVERSED = 0;

  public function __construct()
  {
    $this->records = [
      self::COMPLETED => [
        'id' => self::COMPLETED,
        'title' => trans('iwallet::transactions.status.completed'),
        'color' => '#28a745', // Green (indicating success or approval)
        'icon' => 'fas fa-check-circle', // Checkmark for approval
      ],
      self::REVERSED => [
        'id' => self::REVERSED,
        'title' => trans('iwallet::transactions.status.reversed'),
        'color' => '#95a5a6', // Neutral Gray, representing a rollback or inactive state
        'icon' => 'fas fa-undo-alt', // Undo icon representing reversal
      ]
    ];
  }

}
