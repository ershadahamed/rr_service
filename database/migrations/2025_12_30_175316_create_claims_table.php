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
        Schema::create('claims', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('ic');
            $table->string('passport');

            $table->foreignId('pic_id')
                ->references('users')
                ->constrained('users')
                ->cascadeOnDelete();

            // $table->string('phone');
            // $table->string('address');
            // $table->string('city');
            // $table->string('state');
            // $table->string('zip');
            // $table->string('country');
            // $table->string('policy_number');
            // $table->string('policy_type');
            // $table->string('policy_start_date');
            // $table->string('policy_end_date');
            // $table->string('policy_premium');
            // $table->string('policy_deductible');
            // $table->string('policy_coverage');
            // $table->string('policy_excess');
            // $table->string('policy_limit');
            // $table->string('policy_deductible');
            // $table->string('policy_excess');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('claims');
    }
};
