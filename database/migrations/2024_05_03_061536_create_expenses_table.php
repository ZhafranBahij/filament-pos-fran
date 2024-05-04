<?php

use App\Models\ExpenseCategory;
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
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(ExpenseCategory::class)->nullable();
            $table->string('name')->nullable();
            $table->integer('price')->nullable();
            $table->string('attachment')->nullable();
            $table->foreignId('created_by_id')->constrained('users')->nullable();
            $table->foreignId('updated_by_id')->constrained('users')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expenses');
    }
};
