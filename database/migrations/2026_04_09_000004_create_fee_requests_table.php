<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeeRequestsTable extends Migration
{
    public function up()
    {
        Schema::create('fee_requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('case_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('requested_by');
            $table->string('title');
            $table->text('description')->nullable();
            $table->decimal('amount', 15, 2);
            $table->enum('status', ['pending', 'paid', 'cancelled'])->default('pending');
            $table->timestamp('paid_at')->nullable();
            $table->unsignedBigInteger('deposit_id')->nullable();
            $table->timestamps();

            $table->foreign('case_id')->references('id')->on('fraud_cases')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('requested_by')->references('id')->on('admins')->onDelete('cascade');
            $table->foreign('deposit_id')->references('id')->on('deposits')->onDelete('set null');
            $table->index(['user_id', 'status']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('fee_requests');
    }
}
