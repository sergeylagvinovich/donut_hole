<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i<50; $i++) {
            DB::table('employees')->insert([
                'first_name' => 'first_name '.$i,
                'last_name' => 'first_name '.$i,
                'patronymic' => 'first_name '.$i,
                'male_gender' => rand(0,1),
                'wages' => rand(500,3000),
            ]);
        }
    }
}
