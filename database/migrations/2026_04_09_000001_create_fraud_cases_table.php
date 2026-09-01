<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFraudCasesTable extends Migration
{
    public function up()
    {
        Schema::create('fraud_cases', function (Blueprint $table) {
            $table->id();
            $table->string('case_number')->unique();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('assigned_to')->nullable();
            $table->enum('status', [
                'new', 'assigned', 'investigating', 'legal_action',
                'funds_recovered', 'withdrawal_ready', 'closed'
            ])->default('new');
            $table->string('fraud_type');
            $table->string('amount_lost');
            $table->string('timeframe');
            $table->text('description')->nullable();
            $table->decimal('amount_recovered', 15, 2)->default(0);
            $table->enum('priority', ['low', 'medium', 'high', 'urgent'])->default('medium');
            $table->timestamp('closed_at')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('assigned_to')->references('id')->on('admins')->onDelete('set null');
            $table->index('status');
            $table->index('user_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('fraud_cases');
    }
}
