<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('uuid', 100)->unique();
            $table->integer('dni')->nullable();
            $table->string('nombre')->nullable();
            $table->string('apellido')->nullable();
            $table->string('sexo')->nullable();
            $table->string('usuario')->unique();
            $table->string('password');
            $table->string('password_unico')->nullable();
            $table->string('foto')->nullable();
            $table->string('sede_actual')->nullable();
            $table->foreignId('tipo_role_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('tipo_estado_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
