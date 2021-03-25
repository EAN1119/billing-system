<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('account_id');   //foreign key
            $table->string('invoice_no')->unique();
            $table->date('invoice_date');
            $table->unsignedBigInteger('order_id')->unique();   //foreign key
            $table->string('payment_terms');
            $table->decimal('total_price', 10, 2);
            $table->decimal('total_paid', 10, 2)->nullable();
            $table->decimal('total_unpaid', 10, 2)->nullable();         
            $table->string('created_by');
            $table->timestamps();
            
            $table->index('account_id');   //foreign key must have index
            $table->index('order_id');   //foreign key must have index
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoices');
    }
}
