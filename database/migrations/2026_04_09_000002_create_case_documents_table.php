<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCaseDocumentsTable extends Migration
{
    public function up()
    {
        Schema::create('case_documents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('case_id');
            $table->unsignedBigInteger('user_id');
            $table->string('filename');
            $table->string('original_name');
            $table->string('file_path');
            $table->string('file_type')->nullable();
            $table->unsignedBigInteger('file_size')->default(0);
            $table->string('description')->nullable();
            $table->enum('uploaded_by', ['user', 'admin'])->default('user');
            $table->timestamps();

            $table->foreign('case_id')->references('id')->on('fraud_cases')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->index('case_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('case_documents');
    }
}
