<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterFraudCasesForTeamMember extends Migration
{
    public function up()
    {
        Schema::table('fraud_cases', function (Blueprint $table) {
            $table->unsignedBigInteger('team_member_id')->nullable()->after('user_id');
            $table->foreign('team_member_id')->references('id')->on('team_members')->onDelete('set null');
        });

        // Drop old admin FK and column if they exist
        Schema::table('fraud_cases', function (Blueprint $table) {
            if (Schema::hasColumn('fraud_cases', 'assigned_to')) {
                // Drop the foreign key if it exists (MySQL naming convention)
                try {
                    $table->dropForeign(['assigned_to']);
                } catch (\Exception $e) {
                    // FK may not exist if it was not explicitly created
                }
                $table->dropColumn('assigned_to');
            }
        });
    }

    public function down()
    {
        Schema::table('fraud_cases', function (Blueprint $table) {
            $table->dropForeign(['team_member_id']);
            $table->dropColumn('team_member_id');
            $table->unsignedBigInteger('assigned_to')->nullable();
            $table->foreign('assigned_to')->references('id')->on('admins')->onDelete('set null');
        });
    }
}
