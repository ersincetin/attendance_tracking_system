<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->smallInteger('status');
            $table->integer('class_id');
            $table->string('sex', 1);
            $table->string('identity_number', 11)->unique()->nullable();
            $table->string('firstname', 32);
            $table->string('second_name', 32)->nullable();
            $table->string('lastname', 32);
            $table->string('email', 128)->unique();
            $table->string('password');
            $table->string('photo_url')->nullable();
            $table->timestamp('created_at');
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
