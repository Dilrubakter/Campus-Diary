<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('time_schedule', function (Blueprint $table) {
            $table->id();
            $table->char('uuid', 36)->unique();
            $table->string('start_time');
            $table->string('end_time');
            $table->string('created_by');
            $table->string('updated_by');
            $table->string('deleted_by');
            $table->timestamp('deleted_at')->nullable();
            $table->timestamps(); // This line adds the created_at and updated_at columns automatically.

            // You may also want to add foreign keys and other constraints here if needed.

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('time_schedule');
    }
};
