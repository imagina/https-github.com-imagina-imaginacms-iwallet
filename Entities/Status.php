<?php

namespace Modules\Iwallet\Entities;

use Modules\Core\Icrud\Entities\CrudStaticModel;
use function Modules\Ibooking\Entities\trans;

class Status extends CrudStaticModel
{
  const PENDING = 0;

  const APPROVED = 1;

  const CANCELED = 2;

  public function __construct()
  {
    $records = [
      self::PENDING => [
        'id' => self::PENDING,
        'title' => trans('iwallet::transactions.status.pending'),
//        'color' => '#f39c12', // Orange (indicating waiting or action needed)
//        'icon' => 'fas fa-hourglass-half', // Hourglass indicating waiting
      ],
      self::APPROVED => [
        'id' => self::APPROVED,
        'title' => trans('iwallet::transactions.status.approved'),
//        'color' => '#f39c12', // Orange (indicating waiting or action needed)
//        'icon' => 'fas fa-hourglass-half', // Hourglass indicating waiting
      ],
      self::CANCELED => [
        'id' => self::CANCELED,
        'title' => trans('iwallet::transactions.status.cancelled'),
//        'color' => '#f39c12', // Orange (indicating waiting or action needed)
//        'icon' => 'fas fa-hourglass-half', // Hourglass indicating waiting
      ]
    ];
  }

}