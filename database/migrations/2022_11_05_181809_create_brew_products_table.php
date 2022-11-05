<?php

use App\Models\BrewProduct;
use App\Models\User;
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
        Schema::create(BrewProduct::TABLE_NAME, function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger(BrewProduct::COLUMN_USER_ID);
            $table->unsignedBigInteger(BrewProduct::COLUMN_PRODUCT_CATEGORY_ID);
            $table->string(BrewProduct::COLUMN_NAME);
            $table->string(BrewProduct::COLUMN_DESCRIPTION);
            $table->timestamps();
            $table->softDeletes();

            $table
                ->foreign(BrewProduct::COLUMN_USER_ID)
                ->references(User::COLUMN_ID)
                ->on(User::TABLE_NAME)
                ->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists(BrewProduct::TABLE_NAME);
    }
};
