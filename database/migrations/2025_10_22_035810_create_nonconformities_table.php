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
        Schema::create('nonconformities', function (Blueprint $table) {
            $table->id();
            $table->uuid()->unique();
            $table->string('document_number');
            $table->dateTime('found_date');
            $table->uuid('department_uuid');
            $table->string('nonconformity_documentiation');
            $table->longText('description');
            $table->string('information');
            $table->string('location');
            $table->string('corrective_documentation')->nullable();
            $table->dateTime('corrective_date')->nullable();
            $table->integer('point')->nullable();
            $table->integer('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nonconformities');
    }
};
