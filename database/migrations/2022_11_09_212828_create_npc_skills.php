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
        Schema::create('npc_skills', function (Blueprint $table) {
            $table->id();
            $table->foreignId('npc_id')
                ->constrained('npcs')
                ->cascadeOnDelete();
            $table->foreignId('skill_id')
                ->constrained('skills')
                ->cascadeOnDelete();
            $table->string('level');
            $table->timestamps();
            $table->comment('NPC - Умения');
        });
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('npc_skills');
    }
};
