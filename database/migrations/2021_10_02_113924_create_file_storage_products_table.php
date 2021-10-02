<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFileStorageProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('file_storage_products', function (Blueprint $table) {
            $table->id();
            $table->string('path',255)->nullable();
            $table->string('ext',255)->nullable();
            $table->integer('size')->nullable();
            $table->string('status',10)->nullable();
            $table->string('relation');
            $table->unsignedBigInteger('relation_id');
            $table->softDeletes();
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
        Schema::dropIfExists('file_storage_products');
    }
}
