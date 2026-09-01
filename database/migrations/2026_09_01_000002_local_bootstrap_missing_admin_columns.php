<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Same story as the settings bootstrap migration: these admins columns
 * exist on production (added outside migration history) but are missing
 * from a fresh migrate.
 */
return new class extends Migration
{
    public function up()
    {
        Schema::table('admins', function (Blueprint $table) {
            foreach (['enable_2fa', 'token_2fa', 'pass_2fa'] as $column) {
                if (!Schema::hasColumn('admins', $column)) {
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
