<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationToTransactionDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transaction_details', function (Blueprint $table) {
            $table->integer('transaksi_id')->unsigned()->change();
            $table->foreign('transaksi_id')->references('id')->on('transactions')->onUpdate('cascade')->onDelete('cascade');

            $table->integer('barang_id')->unsigned()->change();
            $table->foreign('barang_id')->references('id')->on('products')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transaction_details', function (Blueprint $table) {
            Schema::table('transaction_details', function(Blueprint $table) {
                $table->dropForeign('transaction_details_transaksi_id_foreign');
            });

            Schema::table('transaction_details', function(Blueprint $table) {
                $table->dropIndex('transaction_details_transaksi_id_foreign');
            });

            Schema::table('transaction_details', function(Blueprint $table) {
                $table->integer('transaksi_id')->change();
            });

            Schema::table('transaction_details', function(Blueprint $table) {
                $table->dropForeign('transaction_details_barang_id_foreign');
            });

            Schema::table('transaction_details', function(Blueprint $table) {
                $table->dropIndex('transaction_details_barang_id_foreign');
            });

            Schema::table('transaction_details', function(Blueprint $table) {
                $table->integer('barang_id')->change();
            });
        });
    }
}
