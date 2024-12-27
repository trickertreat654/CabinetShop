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
        Schema::create('cabinet_jobs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->foreignId('customer_id')->constrained()->cascadeOnDelete();
            // $table->string('status')->default('pending');
            $table->boolean('is_completed')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cabinet_jobs');
    }
};
