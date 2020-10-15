<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Customer extends Migration
{
    private $typeConnection = \Raiadrogasil\Common\Entity\BaseEntityInterface::CONN_RELATIONAL;

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::connection($this->typeConnection)->hasTable('customer')) {
            Schema::connection($this->typeConnection)->create('customer', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('cpf')->nullable(false);
                $table->string('name', 50)->nullable(false);
                $table->string('email', 50)->nullable(false)->unique();
                $table->unsignedBigInteger('cep')->nullable(false);
                $table->timestamps();
                $table->softDeletes();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::connection($this->typeConnection)->hasTable('customer')) {
            Schema::connection($this->typeConnection)->dropIfExists('customer');
        }
    }
}
