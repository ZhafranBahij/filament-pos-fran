<?php

use App\Models\CompanyDebtCategory;
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
        Schema::create('company_debts', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(CompanyDebtCategory::class)->nullable();
            $table->foreignId('created_by_id')->constrained('users')->nullable();
            $table->foreignId('updated_by_id')->constrained('users')->nullable();
            $table->foreignId('debtor_id')->constrained('users')->nullable();
            $table->foreignId('creditor_id')->constrained('users')->nullable();
            $table->string('name')->nullable();
            $table->integer('price')->nullable();
            $table->text('description')->nullable();
            $table->string('status')->nullable();
            $table->string('attachment')->nullable();
            $table->dateTime('deadline')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_debts');
    }
};
