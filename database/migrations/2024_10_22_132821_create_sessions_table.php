<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSessionsTable extends Migration
{
    public function up()
    {
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->unique(); // Colonne id de type string
            $table->text('payload'); // Colonne payload pour stocker les données de session
            $table->integer('last_activity'); // Colonne last_activity pour stocker le timestamp
            $table->timestamps(); // Colonne created_at et updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('sessions');
    }
}
