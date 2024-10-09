<?php

namespace Modules\Iwallet\Entities;

use Modules\Core\Icrud\Entities\CrudModel;
use Modules\Iblog\Entities\Post;

class Transaction extends CrudModel
{
  protected $table = 'iwallet__transactions';
  public $transformer = 'Modules\Iwallet\Transformers\TransactionTransformer';
  public $repository = 'Modules\Iwallet\Repositories\TransactionRepository';
  public $requestValidation = [
    'create' => 'Modules\Iwallet\Http\Requests\CreateTransactionRequest',
    'update' => 'Modules\Iwallet\Http\Requests\UpdateTransactionRequest',
  ];
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
  public $translatedAttributes = [];
  protected $fillable = [
    'amount',
    'from_pocket_id',
    'to_pocket_id',
    'comment',
    'status_id',
    'entity_id',
    'entity_type',
  ];

  public function getTypeAttribute()
  {
    if ($this->from_pocket_id && $this->to_pocket_id) return [
      'color' => 'indigo',
      'icon' => 'fa-solid fa-exchange-alt',
      'title' => trans('iwallet::transactions.type.transaction')
    ];

    if ($this->from_pocket_id) return [
      "color" => 'red',
      "icon" => 'fa-solid fa-arrow-down',
      "title" => trans('iwallet::transactions.type.withdrawal')
    ];

    if ($this->to_pocket_id) return [
      "color" => 'green',
      "icon" => 'fa-solid fa-arrow-up',
      "title" => trans('iwallet::transactions.type.income')
    ];

    return null;
  }

  public function fromPocket()
  {
    return $this->belongsTo(Pocket::class);
  }

  public function toPocket()
  {
    return $this->belongsTo(Pocket::class);
  }

  public function getStatusAttribute()
  {
    $statusClass = new Status();
    return $statusClass->show($this->status_id);
  }
}
