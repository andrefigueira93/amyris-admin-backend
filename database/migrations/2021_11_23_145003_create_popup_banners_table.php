<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePopupBannersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('popup_banners', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->foreignId('project_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->text('text')->nullable();
            $table->longText('image')->nullable();
            $table->string('link')->nullable();
            $table->timestamps();
            $table->softDeletesTz();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('popup_banners');
    }
}
