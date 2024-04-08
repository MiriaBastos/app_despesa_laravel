<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('cli_despesas', function (Blueprint $table) {
            $table->boolean('despesa_recorrente')->default(0)->nullable()->after('tipo');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cli_despesas', function (Blueprint $table) {
            $table->dropColumn('despesa_recorrente');
        });
    }
};
