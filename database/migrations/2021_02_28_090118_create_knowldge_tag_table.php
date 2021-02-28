<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKnowldgeTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('knowledge_tag', function (Blueprint $table) {
            $table->id();
            $table->foreignId('knowledge_id')->default(0)->constrained('knowledge');
            $table->foreignId('tag_id')->default(0)->constrained('tag');
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
        Schema::dropIfExists('knowldge_tag');
    }
}
