<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ListUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'geomiq:users:list
                            {--view : Use Database view to select users}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'List users';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if ($this->option('view')) {
            $users = DB::table('users_view')->select('*')->get();
        } else {
            $users = DB::select('SELECT DISTINCT `u`.`id`, 
                    `u`.`name`, 
                    CASE 
                        WHEN `ur`.`role_id` IS NOT NULL THEN "buyer" 
                        WHEN `u`.`id` = 4 THEN "admin" 
                        WHEN `u`.`id` = 3 THEN "vendor" END AS role, 
                    `u`.`email`, 
                    `p`.`company_name`, 
                    `u`.`created_at` as `registered_on`,
                    `u`.`last_login` as `last_login` 
                FROM `users` `u` 
                LEFT JOIN `profiles` `p` ON (`u`.`id` = `p`.`user_id`) 
                LEFT JOIN `roles` `r` ON (`r`.`id` = `p`.`id`) 
                LEFT JOIN `model_has_roles` `ur` ON (`u`.`id` = `ur`.`model_id`)
                ORDER BY `u`.`id` DESC');
        }

        foreach ($users as $user) {
            $tableValues[] = [
                $user->id,
                $user->name,
                $user->role,
                $user->email,
                $user->company_name,
                $user->registered_on,
                ];
        }

        $this->table(['id', 'name', 'role', 'email', 'company_name', 'registered_on'],
            $tableValues
        );
    }
}
