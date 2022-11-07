<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('products_campaigns', function(Blueprint $table) {
            $table->foreignId('product_id')->constrained('products');
            $table->foreignId('campaign_id')->constrained('campaigns');
            $table->unique(['campaign_id', 'product_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('products_campaigns');
    }
};
