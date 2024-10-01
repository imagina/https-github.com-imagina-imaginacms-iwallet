<?php

namespace Modules\Iwallet\Entities;

use function Modules\Ibooking\Entities\trans;
use Modules\Core\Icrud\Entities\CrudStaticModel;

class Type extends CrudStaticModel
{
  const DEBT = 0;

  const PROFIT = 1;


  public function __construct()
  {
    $records = [
      self::DEBT => [
        'id' => self::DEBT,
        'title' => trans('iwallet::pockets.type.debt'),
//        'color' => '#f39c12', // Orange (indicating waiting or action needed)
//        'icon' => 'fas fa-hourglass-half', // Hourglass indicating waiting
      ],
      self::PROFIT => [
        'id' => self::PROFIT,
        'title' => trans('iwallet::pockets.type.profit'),
//        'color' => '#f39c12', // Orange (indicating waiting or action needed)
//        'icon' => 'fas fa-hourglass-half', // Hourglass indicating waiting
      ]
    ];
  }

}
