<?php

use App\Models\State;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateStatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('states', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('initials')->unique();
            $table->timestamps();
        });

        $file_handle = fopen(database_path("sql/states.sql"), "r");
        DB::beginTransaction();
        while (!feof($file_handle)) {
            $line = trim(fgets($file_handle));
            if ($line) {
                list(, $init) = explode('VALUES(', $line);
                $init = str_replace(', ', ',', substr($init, 0, -4));
                $values = explode(',', $init);

                $obj = new State();
                $obj->forceFill([
                    "id" => $values[0],
                    "name" => $this->removeChar($values[1]),
                    "initials" => $this->removeChar($values[2]),
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
        Schema::dropIfExists('states');
    }
}
