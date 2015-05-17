<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Account extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('account', function($table)
        {
            $table->increments('id');
            $table->integer('received_from');
            $table->float('received_amount');
            $table->char('received_currency', 50);
            $table->integer('sent_to');
            $table->char('sent_currency', 50);
            $table->float('sent_rate');
            $table->float('total_transferred_money');
            $table->text('comment');
            $table->timestamps();
        });


	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::drop('account');
	}

}
