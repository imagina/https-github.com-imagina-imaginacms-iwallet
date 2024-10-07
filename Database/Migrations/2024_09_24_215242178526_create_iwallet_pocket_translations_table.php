<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIwalletPocketTranslationsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('iwallet__pocket_translations', function (Blueprint $table) {
      $table->engine = 'InnoDB';
      $table->increments('id');
      // Your translatable fields
      $table->text('title');
      $table->text('description')->nullable();

      $table->integer('pocket_id')->unsigned();
      $table->string('locale')->index();
      $table->unique(['pocket_id', 'locale']);
      $table->foreign('pocket_id')->references('id')->on('iwallet__pockets')->onDelete('cascade');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table('iwallet__pocket_translations', function (Blueprint $table) {
      $table->dropForeign(['pocket_id']);
    });
    Schema::dropIfExists('iwallet__pocket_translations');
  }
}
