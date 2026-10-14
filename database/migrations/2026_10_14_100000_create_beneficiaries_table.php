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
        Schema::create('beneficiaries', function (Blueprint $table) {
            $table->id();
            $table->string('application_no')->unique()->index();
            $table->string('beneficiary_name');
            $table->string('gender')->default('female');
            $table->string('wife_or_widow_of');
            $table->string('cnic_no')->index();
            $table->string('district')->index();
            $table->string('tehsil')->index();
            $table->string('village');
            $table->text('address');
            $table->string('contact_no');
            $table->boolean('one_unit_given')->default(true);
            $table->json('vulnerabilities')->nullable();
            $table->boolean('is_headed')->default(false);
            $table->boolean('is_widow')->default(false);
            $table->boolean('is_homeless')->default(false);
            $table->boolean('is_poor')->default(false);
            $table->decimal('amount_received_per_unit', 10, 2)->default(1050.00);
            $table->string('status')->default('registered');
            $table->text('remarks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('beneficiaries');
    }
};
