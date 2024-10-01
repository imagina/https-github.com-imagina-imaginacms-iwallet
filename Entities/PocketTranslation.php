<?php

namespace Modules\Iwallet\Entities;

use Illuminate\Database\Eloquent\Model;

class PocketTranslation extends Model
{
  public $timestamps = false;
  protected $fillable = [
    'title',
    'description',
  ];
  protected $table = 'iwallet__pocket_translations';
}
