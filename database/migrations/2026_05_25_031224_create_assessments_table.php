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
        Schema::create('assessments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('visit_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->text('chief_complaint');

            $table->string('blood_pressure');

            $table->decimal('temperature', 4, 1);

            $table->decimal('weight', 5, 2);

            $table->text('initial_diagnosis');

            $table->text('therapy');

            $table->text('doctor_notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assessments');
    }
};
