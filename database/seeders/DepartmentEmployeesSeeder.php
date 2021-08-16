<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentEmployeesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i<50; $i++) {
            $rnd = rand(1,3);
            for ($j=0;$j<$rnd;$j++) {
                $idDepartments = DB::select('select d.id from departments d where d.id not in ((select de.id_department from department_employees de where de.id_department = d.id and de.id_employees='.($i+1).'))');
                DB::table('department_employees')->insert([
                    'id_department' => $idDepartments[rand(0,count($idDepartments)-1)]->id,
                    'id_employees' => $i+1,
                ]);
            }
        }
    }
}
