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
        //
        Schema::create('alumni', function (Blueprint $table) {
            $table->id();
            $table->char('uuid', 36)->unique();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('designations');
            $table->string('current_working_company');
            $table->string('current_location');
            $table->string('linkedin_profile_link');
            $table->string('photo');
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
        //
    }
};
