<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id('cs_id');
            $table->string('cs_nama');
            $table->string('cs_email')->unique();
            $table->string('cs_notelp');
            $table->text('cs_alamat');
            $table->uuid('uuid');
            $table->string('encrypt_time');
            $table->string('decrypt_time');
            $table->string('created_at');
            $table->string('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
};
