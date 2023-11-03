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
        Schema::create('office_hours', function (Blueprint $table) {
            $table->id();
            $table->char('uuid', 36)->unique();
            $table->string('persons_uuid');
            $table->string('day_uuid');
            $table->string('time_uuid');
            $table->string('subject_code');
            $table->string('room_no');
            $table->boolean('office_hour')->default(0);
            $table->boolean('idle')->default(0);
            $table->string('created_by');
            $table->string('updated_by')->nullable()->default(null);
            $table->string('deleted_by')->nullable()->default(null);
            $table->timestamp('deleted_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('office_hours');
    }
};
