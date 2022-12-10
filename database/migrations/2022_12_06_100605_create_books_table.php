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
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->string("name");
            $table->text("description");
            $table->float("price");
            $table->integer("discount")->nullable();
            $table->json("images");
            $table->integer("pages_count");
            $table->string("author", 50);
            $table->integer("release_year");
            $table->integer("age_class");
            $table->foreignId("category_id");
            $table->fullText(["name", "description", "author"]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
    }
};
