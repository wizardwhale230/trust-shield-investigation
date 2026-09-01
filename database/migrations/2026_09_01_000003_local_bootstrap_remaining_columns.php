<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Remaining production columns (from update/version5DB.sql and
 * update/version5_0_3.sql) not captured in any tracked migration.
 */
return new class extends Migration
{
    public function up()
    {
        Schema::table('settings', function (Blueprint $table) {
            if (!Schema::hasColumn('settings', 'return_capital')) {
                $table->boolean('return_capital')->default(true);
            }
            if (!Schema::hasColumn('settings', 'should_cancel_plan')) {
                $table->boolean('should_cancel_plan')->default(true);
            }
            if (!Schema::hasColumn('settings', 'deposit_bonus')) {
                $table->integer('deposit_bonus')->nullable();
            }
            if (!Schema::hasColumn('settings', 'modules')) {
                $table->json('modules')->nullable();
            }
            foreach ([
                'auto_merchant_option', 'welcome_message', 'website_theme',
                'deduction_option', 'redirect_url', 'merchant_key',
                'credit_card_provider', 'theme',
            ] as $column) {
                if (!Schema::hasColumn('settings', $column)) {
                    $table->text($column)->nullable();
                }
            }
        });

        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'kyc_id')) {
                $table->bigInteger('kyc_id')->nullable();
            }
            if (!Schema::hasColumn('users', 'usdt_address')) {
                $table->string('usdt_address')->nullable();
            }
        });
    }

    public function down()
    {
        //
    }
};
