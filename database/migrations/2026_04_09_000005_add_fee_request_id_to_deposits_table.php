<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFeeRequestIdToDepositsTable extends Migration
{
    public function up()
    {
        Schema::table('deposits', function (Blueprint $table) {
            $table->unsignedBigInteger('fee_request_id')->nullable()->after('proof');
            $table->foreign('fee_request_id')->references('id')->on('fee_requests')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('deposits', function (Blueprint $table) {
            $table->dropForeign(['fee_request_id']);
            $table->dropColumn('fee_request_id');
        });
    }
}
