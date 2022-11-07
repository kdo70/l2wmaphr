<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('npc_ai', function (Blueprint $table) {
            $table->id();
            $table->foreignId('npc_id')
                ->constrained('npcs')
                ->cascadeOnDelete();
            $table->string('type');
            $table->string('ssCount');
            $table->string('ssRate');
            $table->string('spsCount');
            $table->string('spsRate');
            $table->string('aggro');
            $table->string('clan')->nullable();
            $table->string('clanRange')->nullable();
            $table->string('ignoredIds')->nullable();
            $table->string('canMove');
            $table->string('seedable');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('npc_ai');
    }
};
