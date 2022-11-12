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
        Schema::create('drops', function (Blueprint $table) {
            $table->id();
            $table->foreignId('npc_id')
                ->constrained('npcs')
                ->cascadeOnDelete();
            $table->string('category');
            $table->string('itemid');
            $table->string('min');
            $table->string('max');
            $table->string('chance');
            $table->timestamps();
            $table->comment('DROP');
        });
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('create_drops');
    }
};
