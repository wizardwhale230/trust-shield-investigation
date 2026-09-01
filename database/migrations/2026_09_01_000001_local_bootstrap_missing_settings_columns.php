<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Fills in columns/tables that the production database has (added via
 * raw SQL over time, outside the tracked migration history) but that
 * are missing from a fresh migrate. Needed to boot the app locally.
 */
return new class extends Migration
{
    public function up()
    {
        Schema::table('settings', function (Blueprint $table) {
            foreach ([
                'whatsapp', 'twak', 'tido', 'usertheme', 'install_type', 'timezone',
                'capt_secret', 'capt_sitekey',
                'google_id', 'google_secret', 'google_redirect',
                'smtp_host', 'smtp_port', 'smtp_encrypt', 'smtp_user', 'smtp_password',
                'mail_server', 'emailfrom', 'emailfromname',
                's_currency', 'enable_social_login', 'deposit_option', 'subscription_service',
            ] as $column) {
                if (!Schema::hasColumn('settings', $column)) {
                    $table->text($column)->nullable();
                }
            }
        });

        Schema::table('settings_conts', function (Blueprint $table) {
            foreach ([
                'fee', 'currency_rate', 'btc', 'eth', 'ltc', 'link', 'bnb',
                'aave', 'usdt', 'bch', 'xrp', 'xlm', 'ada', 'minamt',
                'flw_public_key', 'flw_secret_key', 'flw_secret_hash',
                'bnc_api_key', 'bnc_secret_key',
                'transfer_charges', 'min_transfer', 'purchase_code', 'telegram_bot_api',
            ] as $column) {
                if (!Schema::hasColumn('settings_conts', $column)) {
                    $table->text($column)->nullable();
                }
            }
            if (!Schema::hasColumn('settings_conts', 'use_transfer')) {
                $table->boolean('use_transfer')->default(false);
            }
        });

        if (!Schema::hasTable('paystacks')) {
            Schema::create('paystacks', function (Blueprint $table) {
                $table->id();
                $table->string('paystack_public_key')->nullable();
                $table->string('paystack_secret_key')->nullable();
                $table->string('paystack_url')->nullable();
                $table->string('paystack_email')->nullable();
                $table->timestamps();
            });
        }
    }

    public function down()
    {
        //
    }
};
