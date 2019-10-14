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
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->timestamp('last_login')->useCurrent();
            $table->timestamps();
        });

        Schema::create('profiles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->string('company_name');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::create('roles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('model_has_roles', function (Blueprint $table) {
            $table->bigIncrements('role_id');
            $table->string('model_type');
            $table->bigInteger('model_id');
            $table->timestamps();

            $table->foreign('role_id')->references('id')->on('roles');
        });

        DB::statement('DROP VIEW IF EXISTS users_view');
        DB::statement(
            "CREATE VIEW users_view AS
            (SELECT DISTINCT `u`.`id`, 
                `u`.`name`, 
                CASE 
                    WHEN ur.`role_id` IS NOT NULL THEN 'buyer' 
                    WHEN u.`id` = 4 THEN 'admin' 
                    WHEN u.`id` = 3 THEN 'vendor' END AS role, 
                u.email, 
                p.company_name, 
                u.created_at as registered_on,
                u.last_login as last_login 
            FROM users u 
            LEFT JOIN profiles p ON (u.id = p.`user_id`) 
            LEFT JOIN roles r ON (r.id = p.id) 
            LEFT JOIN `model_has_roles` ur ON (u.id = ur.`model_id`)
            ORDER BY u.id DESC)"
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('DROP VIEW IF EXISTS users_view');

        Schema::table('profiles', function (Blueprint $table) {
            $table->dropForeign('profiles_user_id_foreign');
        });
        Schema::table('model_has_roles', function (Blueprint $table) {
            $table->dropForeign('model_has_roles_role_id_foreign');
        });

        Schema::dropIfExists('users');
        Schema::dropIfExists('profiles');
        Schema::dropIfExists('roles');
        Schema::dropIfExists('model_has_roles');
    }
}
