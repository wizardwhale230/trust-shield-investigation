<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCaseNotesTable extends Migration
{
    public function up()
    {
        Schema::create('case_notes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('case_id');
            $table->unsignedBigInteger('author_id');
            $table->string('author_type');
            $table->text('note');
            $table->boolean('is_internal')->default(false);
            $table->timestamps();

            $table->foreign('case_id')->references('id')->on('fraud_cases')->onDelete('cascade');
            $table->index('case_id');
            $table->index(['author_id', 'author_type']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('case_notes');
    }
}
