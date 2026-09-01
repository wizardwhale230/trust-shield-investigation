<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropUserIdForeignFromTicketReplies extends Migration
{
    /**
     * The user_id column on ticket_replies stores either a users.id (when the
     * reply comes from a customer) or an admins.id (when is_admin = true).
     * The original foreign key to the users table prevents admin replies from
     * being inserted, so we drop it. The is_admin flag disambiguates the
     * referenced table at the application layer.
     */
    public function up()
    {
        Schema::table('ticket_replies', function (Blueprint $table) {
            $table->dropForeign('ticket_replies_user_id_foreign');
        });
    }

    public function down()
    {
        Schema::table('ticket_replies', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
        });
    }
}
