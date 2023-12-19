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
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            $table->boolean('is_active')->default(false);
            $table->foreignId('brand_id')->nullable();

            $table->string('name')->index();
            $table->string('sku_code')->nullable()->index();
            $table->text('short_description')->nullable();
            $table->longText('description')->nullable();

            $table->unsignedInteger('price')->default(0);
            $table->longText('attributes')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
