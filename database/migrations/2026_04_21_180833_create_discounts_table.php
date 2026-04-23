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
        Schema::create('discounts', function (Blueprint $table) {
        $table->id();
        $table->foreignId('discount_type_id')->constrained('discount_types');
        $table->string('code')->unique();
        $table->decimal('discount_value', 10, 2);
        $table->decimal('min_order_amount', 10, 2)->default(0);
        $table->date('expires_at')->nullable();
        $table->integer('max_uses')->nullable();
        $table->integer('used_count')->default(0);
        $table->boolean('is_active')->default(true);
        $table->timestamp('created_at')->useCurrent();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('discounts');
    }
};
