<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateMeasuresTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('measurements',function(Blueprint $table){
            $table->foreignId('context_id')->nullable()->constrained('contexts')->nullOnDelete();
        });

        Schema::table('measurement_types',function(Blueprint $table){
            $table->foreignId('context_id')->nullable()->constrained('contexts')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('measurements',function(Blueprint $table){
            $table->dropConstrainedForeignId('context_id');
        });

        Schema::table('measurement_types',function(Blueprint $table){
            $table->dropConstrainedForeignId('context_id');
        });
    }
}
