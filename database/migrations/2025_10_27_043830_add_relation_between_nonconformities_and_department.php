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
        Schema::table('nonconformities', function (Blueprint $table) {
            $table->foreign('department_uuid')->references('uuid')->on('departments');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('nonconformities', function (Blueprint $table) {
            $table->dropForeign(['department_uuid']);
        });
    }
};
