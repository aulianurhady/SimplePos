<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationToTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->integer('pelanggan_id')->unsigned()->change();
            $table->foreign('pelanggan_id')->references('id')->on('customers')->onUpdate('cascade')->onDelete('cascade');

            $table->integer('pengguna_id')->unsigned()->change();
            $table->foreign('pengguna_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transactions', function(Blueprint $table) {
            $table->dropForeign('transactions_pelanggan_id_foreign');
        });

        Schema::table('transactions', function(Blueprint $table) {
            $table->dropIndex('transactions_pelanggan_id_foreign');
        });

        Schema::table('transactions', function(Blueprint $table) {
            $table->integer('pelanggan_id')->change();
        });

        Schema::table('transactions', function(Blueprint $table) {
            $table->dropForeign('transactions_pengguna_id_foreign');
        });

        Schema::table('transactions', function(Blueprint $table) {
            $table->dropIndex('transactions_pengguna_id_foreign');
        });

        Schema::table('transactions', function(Blueprint $table) {
            $table->integer('pengguna_id')->change();
        });
    }
}
