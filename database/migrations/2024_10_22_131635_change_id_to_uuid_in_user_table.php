<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class ChangeIdToUuidInUserTable extends Migration
{
    public function up()
    {
        // 1. D'abord, créer une nouvelle colonne pour stocker temporairement l'UUID
        Schema::table('user', function (Blueprint $table) {
            $table->uuid('uuid')->after('id')->nullable(); // Nouvelle colonne pour UUID
        });

        // 2. Mettre à jour chaque enregistrement avec un UUID
        $users = DB::table('user')->get();
        foreach ($users as $user) {
            DB::table('user')->where('id', $user->id)->update(['uuid' => (string) Str::uuid()]);
        }

        // 3. Supprimer l'ancienne colonne 'id' et renommer 'uuid' en 'id'
        Schema::table('user', function (Blueprint $table) {
            $table->dropPrimary('id'); // Supprimer la clé primaire existante
            $table->dropColumn('id'); // Supprimer la colonne id
            $table->renameColumn('uuid', 'id'); // Renommer la colonne uuid en id
            $table->primary('id'); // Définir id comme clé primaire
        });
    }

    public function down()
    {
        // Pour revenir à l'état précédent, vous pouvez ajouter un entier comme clé primaire
        Schema::table('user', function (Blueprint $table) {
            $table->dropPrimary('id'); // Supprimer la clé primaire existante
            $table->increments('id')->after('uuid'); // Réinsertion de la colonne id en tant qu'entier
        });
    }
}
