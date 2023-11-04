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
        Schema::create('person_office_hour_day', function (Blueprint $table) {
            $table->id();
            $table->char('uuid', 36)->unique();
            $table->string('person_uuid');
            $table->string('day_uuid');
            $table->string('created_by');
            $table->string('updated_by');
            $table->string('deleted_by');
            $table->timestamp('deleted_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
