<?php

namespace Modules\Iwallet\Entities;

use Astrotomic\Translatable\Translatable;
use Modules\Core\Icrud\Entities\CrudModel;

class Pocket extends CrudModel
{
  use Translatable;

  protected $table = 'iwallet__pockets';
  public $transformer = 'Modules\Iwallet\Transformers\PocketTransformer';
  public $repository = 'Modules\Iwallet\Repositories\PocketRepository';
  public $requestValidation = [
    'create' => 'Modules\Iwallet\Http\Requests\CreatePocketRequest',
    'update' => 'Modules\Iwallet\Http\Requests\UpdatePocketRequest',
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
  public $translatedAttributes = [
    'title',
    'description',
  ];
  protected $fillable = [
    'type_id',
    'total',
    'entity_type',
    'entity_id',
    'options'
  ];

  protected $casts = ['options' => 'array'];

  public function getTypeAttribute()
  {
    $classType = new Type();
    return $classType->show($this->type_id);
  }

// Define the relationship for transactions sent from this pocket
  public function fromPocketTransactions()
  {
    return $this->hasMany(Transaction::class, 'from_pocket_id');
  }

  // Define the relationship for transactions received by this pocket
  public function toPocketTransactions()
  {
    return $this->hasMany(Transaction::class, 'to_pocket_id');
  }
}
