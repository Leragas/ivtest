<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('test_data', function (Blueprint $table) {
            $table->id();
            $table->string('name')->default('N/A');
            $table->string('level')->default('N/A');
            $table->string('class')->default('N/A');
            $table->string('parent_number')->default('N/A');
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
        //
    }
};
