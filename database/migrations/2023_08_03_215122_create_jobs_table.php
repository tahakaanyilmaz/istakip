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
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer');
            $table->string('job_title', 150);
            $table->string('job_short_description', 250);
            $table->string('job_description', 10000);
            $table->timestamp('job_start_date');
            $table->timestamp('job_end_date');
            $table->float('job_total_price');
            $table->enum('job_payment_method', ['start', 'end', 'step-by-step']);
            $table->enum('job_status', ['in-process', 'awaiting', 'completed']);
            
            $table->foreign('customer')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs');
    }
};
