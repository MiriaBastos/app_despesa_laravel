<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('cli_despesas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('descricao', 255)->nullable();
            $table->decimal('valor', 10, 2)->nullable();
            $table->string('dia', 200)->nullable();
            $table->string('mes', 200)->nullable();
            $table->string('ano', 200)->nullable();
            $table->string('tipo', 50)->nullable();
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cli_orcamento');
    }
};
