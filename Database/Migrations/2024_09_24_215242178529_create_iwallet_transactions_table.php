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
    Schema::create('iwallet__transactions', function (Blueprint $table) {
      $table->engine = 'InnoDB';
      $table->increments('id');
      // Your fields...
      $table->integer('amount');
      $table->integer('to_pocket_id')->unsigned()->nullable();
      $table->integer('from_pocket_id')->unsigned()->nullable();
      $table->integer('entity_id')->nullable();
      $table->string('entity_type')->nullable();
      $table->foreign('to_pocket_id')->references('id')->on('iwallet__pockets')->onDelete('cascade');
      $table->foreign('from_pocket_id')->references('id')->on('iwallet__pockets')->onDelete('cascade');
      $table->text('comment')->nullable();
      $table->integer('status_id')->default(1);


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
    Schema::dropIfExists('iwallet__transactions');
  }
};
