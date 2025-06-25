<?php

namespace App\Infrastructure\Database\Migrations;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('form_submissions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('form_id');
            $table->string('form_type');
            $table->json('values');

            $table->timestamps();
            $table->softDeletes();

            // Indexing
            $table->index(['form_type', 'created_at']);
            $table->index('form_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form_submissions');
    }
};