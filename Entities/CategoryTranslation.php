<?php

namespace Modules\Iwallet\Entities;

use Illuminate\Database\Eloquent\Model;

class CategoryTranslation extends Model
{
  public $timestamps = false;
  protected $fillable = [
    'title',
    'description',
  ];
  protected $table = 'iwallet__category_translations';
}
