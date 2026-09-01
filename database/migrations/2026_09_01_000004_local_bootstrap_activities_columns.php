<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Same schema-drift story: production's activities table has these
 * columns (used on every login via JetstreamServiceProvider) but no
 * migration ever created them.
 */
return new class extends Migration
{
    public function up()
    {
        Schema::table('activities', function (Blueprint $table) {
            if (!Schema::hasColumn('activities', 'user')) {
                $table->bigInteger('user')->nullable();
            }
            foreach (['ip_address', 'device', 'browser', 'os'] as $column) {
                if (!Schema::hasColumn('activities', $column)) {
                    $table->string($column)->nullable();
                }
            }
        });
    }

    public function down()
    {
        //
    }
};
