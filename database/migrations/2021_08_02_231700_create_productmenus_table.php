<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductmenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productmenus', function (Blueprint $table) {
            $table->unsignedBigInteger('id');
            $table->string('menu_name');
            $table->string('slug');
            $table->string('icon');
            $table->string('jenis');
            $table->Integer('status');
            $table->integer('sort_menu');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productmenus');
    }
}
