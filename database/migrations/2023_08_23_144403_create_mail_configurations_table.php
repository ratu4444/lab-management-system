<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMailConfigurationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mail_configurations', function (Blueprint $table) {
            $table->id();
            $table->string('app_name');
            $table->unsignedBigInteger('oauth_token_id')->nullable();
            $table->string('mail_subject')->nullable();
            $table->longText('mail_body')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mail_configurations');
    }
}
