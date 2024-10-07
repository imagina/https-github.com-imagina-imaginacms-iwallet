<?php

namespace Modules\Iwallet\Entities;

use Modules\Core\Icrud\Entities\CrudStaticModel;

class Type extends CrudStaticModel
{
  const DEBT = 0;

  const PROFIT = 1;


  public function __construct()
  {
    $this->records = [
      self::DEBT => [
        'id' => self::DEBT,
        'title' => trans('iwallet::pockets.type.debt'), // "Debt Pocket"
        'color' => '#e74c3c', // Red, indicating loss or negative balance
        'icon' => 'fas fa-minus-circle', // Icon representing a decrease or negative status
      ],
      self::PROFIT => [
        'id' => self::PROFIT,
        'title' => trans('iwallet::pockets.type.profit'), // "Earning Pocket"
        'color' => '#2ecc71', // Green, representing growth or positive balance
        'icon' => 'fas fa-plus-circle', // Icon representing an increase or positive status
      ]
    ];
  }

}
