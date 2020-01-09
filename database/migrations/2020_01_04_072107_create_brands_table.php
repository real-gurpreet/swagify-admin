<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBrandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brands', function (Blueprint $table) {
            $table->increments('id');
            // $table->string("name" , 50);
            // $table->string("slug" , 50);
            // $table->string("description");
            // $table->unsignedTinyInteger("display_order")->nullable();
            // $table->string("logo")->nullable();
            // $table->bigInteger("created_by")->nullable();
            // $table->bigIngteger("updated_by")->nullable();
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
        Schema::dropIfExists('brands');
    }
}
