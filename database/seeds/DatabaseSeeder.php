<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        DB::table('users')->insert([
            [
                'id' => '1',
                'name' => 'Viva Ratke',
                'email' => 'viva.ratke@gmail.com',
                'password' => '$2y$10$7j8Wcokg',
                'last_login' => '2019-09-13 09:42:30',
                'created_at' => '2018-04-08 16:53:43',
                'updated_at' => '2019-09-13 09:42:30',
            ],
            [
                'id' => '2',
                'name' => 'Candelario Rempel',
                'email' => 'c.rempel@hotmail.com',
                'password' => '$2y$10$7j8Wcokg',
                'last_login' => '2019-09-13 09:42:30',
                'created_at' => '2018-04-20 14:59:21',
                'updated_at' => '2019-09-13 09:42:30',
            ],
            [
                'id' => '3',
                'name' => 'Nelson Powlowski',
                'email' => 'nelson.pow@gmail.com',
                'password' => '$2y$10$7j8Wcokg',
                'last_login' => '2019-09-13 09:42:30',
                'created_at' => '2018-05-29 15:14:50',
                'updated_at' => '2019-09-13 09:42:30',
            ],
            [
                'id' => '4',
                'name' => 'Myrtis Klein',
                'email' => 'myrtis@yahoo.com',
                'password' => '$2y$10$7j8Wcokg',
                'last_login' => '2019-09-13 09:42:30',
                'created_at' => '2018-07-15 13:08:57',
                'updated_at' => '2019-09-13 09:42:30',
            ]
        ]);

        DB::table('profiles')->insert([
            [
                'id' => '1',
                'user_id' => '1',
                'company_name' => 'Hartmann-Wiegand',
                'created_at' => '2018-04-08 16:53:43',
                'updated_at' => '2019-09-13 09:42:30',
            ],
            [
                'id' => '2',
                'user_id' => '2',
                'company_name' => 'Mertz-Bradtke',
                'created_at' => '2018-04-20 14:59:21',
                'updated_at' => '2019-09-13 09:42:30',
            ],
            [
                'id' => '3',
                'user_id' => '3',
                'company_name' => 'Kertzmann LLC',
                'created_at' => '2018-05-29 15:14:50',
                'updated_at' => '2019-09-13 09:42:30',
            ],
            [
                'id' => '4',
                'user_id' => '4',
                'company_name' => 'Wilderman-Heller',
                'created_at' => '2018-07-15 13:08:57',
                'updated_at' => '2019-09-13 09:42:30',
            ]
        ]);

        DB::table('roles')->insert([
            [
                'id' => '1',
                'name' => 'admin',
                'created_at' => '2018-04-08 16:53:43',
                'updated_at' => '2019-09-13 09:42:30',
            ],
            [
                'id' => '2',
                'name' => 'vendor',
                'created_at' => '2018-04-20 14:59:21',
                'updated_at' => '2019-09-13 09:42:30',
            ],
        ]);

        DB::table('model_has_roles')->insert([
            [
                'role_id' => '1',
                'model_type' => 'App\Models\User',
                'model_id' => '1',
                'created_at' => '2018-04-08 16:53:43',
                'updated_at' => '2019-09-13 09:42:30',
            ],
            [
                'role_id' => '2',
                'model_type' => 'App\Models\User',
                'model_id' => '2',
                'created_at' => '2018-04-20 14:59:21',
                'updated_at' => '2019-09-13 09:42:30',
            ],
        ]);
    }
}
