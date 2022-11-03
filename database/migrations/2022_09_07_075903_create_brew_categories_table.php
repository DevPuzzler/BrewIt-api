<?php

use App\Models\BrewCategory;
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
        Schema::create(BrewCategory::TABLE_NAME, function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger(BrewCategory::COLUMN_USER_ID);
            $table->string(BrewCategory::COLUMN_NAME);
            $table->tinyText(BrewCategory::COLUMN_DESCRIPTION);
            $table->timestamps();
            $table->softDeletes();

            $table
                ->foreign(BrewCategory::COLUMN_USER_ID)
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
        Schema::dropIfExists('brew_categories');
    }
};
