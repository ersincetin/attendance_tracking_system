<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('attendance_record_inputs', function (Blueprint $table) {
            $table->id();
            $table->integer('record_id')->nullable(false);
            $table->tinyInteger('day')->nullable(false);
            $table->tinyInteger('input')->nullable(false);
            $table->timestamp('created_at')->nullable(false);
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();;
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendance_record_inputs');
    }
};
