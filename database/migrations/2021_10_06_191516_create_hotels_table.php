<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHotelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('n_reserva')->nullable(true);
            $table->string('nome_cliente');
            $table->string('cliente_cpf')->nullable(true);
            $table->string('cliente_email');
            $table->string('cliente_telefone');
            $table->date('checkin')->nullable(true);
            $table->date('checkout')->nullable(true);
            $table->integer('adultos')->nullable(true);
            $table->integer('criancas')->nullable(true);
            $table->set('pagamento',['cartao','dinheiro'])->nullable(true);
            $table->set('status_reserva',['pendente','recuperada','confirmada','cancelada'])->nullable(true);
            $table->string('motivo_cancelamento')->nullable(true);
        });

        Schema::create('cards', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('card_cliente_id');
            $table->string('card_numero');
            $table->string('card_validade');
            $table->string('card_titular');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hotels');
    }
}
