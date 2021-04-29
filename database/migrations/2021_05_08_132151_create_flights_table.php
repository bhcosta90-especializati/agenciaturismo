<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFlightsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flights', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->foreignId('plane_id')->constrained('planes')->onDelete('cascade');
            $table->foreignId('airport_origin_id')->constrained('airports')->onDelete('cascade');
            $table->foreignId('airport_destination_id')->constrained('airports')->onDelete('cascade');
            $table->foreignId('image_id')->nullable()->constrained('images')->onDelete('set null');
            $table->date('date');
            $table->time('time_duration');
            $table->time('hour_output');
            $table->time('arrival_time');
            $table->double('old_price', 10, 2);
            $table->double('price', 10, 2);
            $table->smallInteger('total_plots');
            $table->boolean('is_promotion')->default(false)->nullable();
            $table->smallInteger('qtd_stops')->default(0);
            $table->text('description')->nullable();
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
        Schema::dropIfExists('flights');
    }
}
