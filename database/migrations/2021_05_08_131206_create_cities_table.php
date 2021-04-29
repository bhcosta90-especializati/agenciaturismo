<?php

use App\Models\City;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateCitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('state_id')->constrained('states')->onDelete('cascade');
            $table->string('name');
            $table->string('zipcode', 11)->nullable()->unique();
            $table->timestamps();
        });

        $file_handle = fopen(database_path("sql/cities.sql"), "r");
        DB::beginTransaction();
        while (!feof($file_handle)) {
            $line = trim(fgets($file_handle));
            if ($line) {
                list(, $init) = explode('VALUES(', $line);
                $init = str_replace(', ', ',', substr($init, 0, -4));
                $values = explode(',', $init);
                $obj = new City();
                $obj->forceFill([
                    "name" => $this->removeChar($values[0]),
                    "state_id" => $values[1],
                ]);
                $obj->save();
            }
        }
        DB::commit();
        fclose($file_handle);
    }

    private function removeChar($str) {
        $str = substr($str, 1);
        $str = substr($str, 0, -1);
        return $str;
    }
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cities');
    }
}
