<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     * @return void
     */
    public function up()
    {
        Schema::create('npc_pet_stats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('npc_pet_id')
                ->constrained('npc_pets')
                ->cascadeOnDelete();
            $table->string('level');
            $table->string('maxMeal');
            $table->string('exp');
            $table->string('expType');
            $table->string('mealInBattle');
            $table->string('mealInNormal');
            $table->string('pAtk');
            $table->string('pDef');
            $table->string('mAtk');
            $table->string('mDef');
            $table->string('hp');
            $table->string('mp');
            $table->string('hpRegen');
            $table->string('mpRegen');
            $table->string('mealInBattleOnRide')->nullable();
            $table->string('mealInNormalOnRide')->nullable();
            $table->string('speedOnRide')->nullable();
            $table->string('atkSpdOnRide')->nullable();
            $table->string('pAtkOnRide')->nullable();
            $table->string('mAtkOnRide')->nullable();
            $table->string('ssCount');
            $table->string('spsCount');
            $table->timestamps();
            $table->comment('NPC - Питомцы - Параметры');
        });
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('npc_pet_stats');
    }
};
