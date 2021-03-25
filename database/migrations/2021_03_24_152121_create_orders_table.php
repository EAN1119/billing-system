<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('account_id');   //foreign key
            $table->string('account_no')->nullable();
            $table->string('company_name');
            $table->date('delivery_date')->nullable();
            $table->string('day_of_week')->nullable();
            $table->string('payment_terms');
            $table->decimal('total_price', 10, 2);
            $table->string('items')->nullable();
            $table->string('invoice_no')->nullable();
            $table->string('created_by');
            $table->timestamps();
            
            $table->index('account_id');   //foreign key must have index
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
