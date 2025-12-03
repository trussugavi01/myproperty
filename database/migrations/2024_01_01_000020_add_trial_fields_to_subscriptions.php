<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('subscriptions', function (Blueprint $table) {
            $table->timestamp('trial_ends_at')->nullable()->after('ends_at');
            $table->boolean('is_trial')->default(false)->after('trial_ends_at');
        });

        Schema::table('subscription_plans', function (Blueprint $table) {
            $table->integer('trial_days')->default(30)->after('is_popular');
        });
    }

    public function down(): void
    {
        Schema::table('subscriptions', function (Blueprint $table) {
            $table->dropColumn(['trial_ends_at', 'is_trial']);
        });

        Schema::table('subscription_plans', function (Blueprint $table) {
            $table->dropColumn('trial_days');
        });
    }
};
