<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->string('account_prefix');
            $table->string('account_index')->nullable();
            $table->string('account_no')->nullable()->unique();
            $table->string('company_name');
            $table->string('created_by');
            $table->timestamps();
        });
        
        DB::statement("ALTER TABLE accounts AUTO_INCREMENT = 000000;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accounts');
    }
}
