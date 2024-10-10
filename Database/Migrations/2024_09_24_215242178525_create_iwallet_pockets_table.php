<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('iwallet__pockets', function (Blueprint $table) {
      $table->engine = 'InnoDB';
      $table->increments('id');
      // Your fields...
      $table->integer('type_id');
      $table->integer('total')->default(0);
      $table->string('entity_type')->nullable();
      $table->integer('entity_id')->unsigned()->nullable();
      $table->text('options')->nullable();
      $table->unique(['entity_type', 'entity_id', 'type_id']);
      // Audit fields
      $table->timestamps();
      $table->auditStamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('iwallet__pockets');
  }
};
