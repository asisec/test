<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('deep_translations', function (Blueprint $table) {
            $table->id();
            $table->char('original_hash', 32);
            $table->string('lang_code', 10);
            $table->longText('translated_text');
            $table->timestamps();

            $table->index(['original_hash', 'lang_code']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('deep_translations');
    }
};
