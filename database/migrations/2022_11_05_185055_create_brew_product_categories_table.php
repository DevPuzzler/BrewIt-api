<?php

use App\Models\BrewProductCategory;
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
        Schema::create(BrewProductCategory::TABLE_NAME, function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger(BrewProductCategory::COLUMN_USER_ID);
            $table->string(BrewProductCategory::COLUMN_NAME);
            $table->string(BrewProductCategory::COLUMN_DESCRIPTION);
            $table->timestamps();
            $table->softDeletes();

            $table
                ->foreign(BrewProductCategory::COLUMN_USER_ID)
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
        Schema::dropIfExists(BrewProductCategory::TABLE_NAME);
    }
};
