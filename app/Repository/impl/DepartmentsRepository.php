<?php
/**
 * Created by PhpStorm.
 * User: Администратор
 * Date: 10.08.2021
 * Time: 17:19
 */

namespace App\Repository\impl;


use App\Repository\DepartmnetsRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DepartmentsRepository implements DepartmnetsRepositoryInterface
{


    public function getAll()
    {
        return DB::table('departments')
            ->join('department_employees','departments.id','=','department_employees.id_department')
            ->join('employees','department_employees.id_employees','=','employees.id')
            ->select('departments.id','departments.name',DB::raw('count(department_employees.id_employees)'),DB::raw('max(employees.wages)'))
            ->groupBy('departments.id')
            ->orderBy('departments.id')->paginate(5);
    }

    public function create(Request $request)
    {
        try{

            DB::table('departments')->insert(['name'=>$request->name]);
            return ['message'=>'Успешно','status'=>200];

        }catch (\Exception $e){

            return ['message'=>$e->getMessage(),'status'=>403];
        }

    }

    public function update(Request $request, $id)
    {
        try{

            DB::table('departments')->where('id',$id)->update(['name'=>$request->name]);
            return ['message'=>'Успешно','status'=>200];

        }catch (\Exception $e){

            return ['message'=>$e->getMessage(),'status'=>403];
        }
    }

    public function delete($id)
    {
        try {

            DB::table('departments')->delete($id);
            return ['message'=>'Успешно','status'=>200];

        }catch (\Exception $e){

            return ['message'=>"Отдел имеет сотрудников",'status'=>403];
        }
    }
}
