<?php
/**
 * Created by PhpStorm.
 * User: Администратор
 * Date: 10.08.2021
 * Time: 17:19
 */

namespace App\Repository\impl;


use App\Repository\DepartmnetsRepositoryInterface;
use App\Repository\EmployeesRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeesRepository implements EmployeesRepositoryInterface
{

    public function getAll()
    {
        return DB::table('employees')->select(
            'id',
            DB::raw("CONCAT (last_name, ' ', first_name, ' ', patronymic) as full_name"),
            DB::raw("(case male_gender when true then 'Мужской' else 'Женский' end) as gender"),
            'wages'
        )->paginate(5);
    }

    private function setValues(Request $request){
        return [
            'first_name'=>$request->first_name,
            'last_name'=>$request->last_name,
            'patronymic'=>$request->patronymic,
            'male_gender'=>$request->male_gender,
            'wages'=>$request->wages
        ];
    }

    public function create(Request $request)
    {
        try{
            DB::table('employees')->insert($this->setValues($request));

            $id = DB::table('employees')->orderByDesc('id')->limit(1)->get('id');
            $this->addDepartmentEmployees($request->departments,$id[0]->id);
            return ['message'=>'Успешно','status'=>200];
        }catch (\Exception $e){

            return ['message'=>$e->getMessage(),'status'=>403];
        }

    }

    private function addDepartmentEmployees($departments,$employee){

        for ($i=0;$i<count($departments);$i++) {
            DB::table('department_employees')->insert([
                'id_department' => $departments[$i],
                'id_employees' => $employee,
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        try{

            DB::table('employees')->where('id',$id)->update($this->setValues($request));
            DB::table('department_employees')->where('id_employees',$id)->delete();
            $this->addDepartmentEmployees($request->departments,$id);
            return ['message'=>'Успешно','status'=>200];

        }catch (\Exception $e){

            return ['message'=>$e->getMessage(),'status'=>403];
        }
    }

    public function delete($id)
    {
        try {

            DB::table('employees')->delete($id);
            return ['message'=>'Успешно','status'=>200];

        }catch (\Exception $e){

            return ['message'=>$e->getMessage(),'status'=>403];
        }
    }
}
