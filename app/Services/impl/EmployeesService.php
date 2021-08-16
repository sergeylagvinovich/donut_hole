<?php
/**
 * Created by PhpStorm.
 * User: Администратор
 * Date: 10.08.2021
 * Time: 17:22
 */

namespace App\Services\impl;


use App\Repository\impl\DepartmentsRepository;
use App\Repository\impl\EmployeesRepository;
use App\Services\DepartmentsServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EmployeesService implements DepartmentsServiceInterface
{
    private $employeesRepository;

    private $validationRules = [
        'first_name'=>'required',
        'last_name'=>'required',
        'patronymic'=>'required',
        'male_gender'=>'required|boolean',
        'wages'=>'required|integer',
        'departments'=>'array|min:1'
    ];


    private $validateMessages = [
        'required' =>'Обязательное поле для заполнения',
        'boolean' => 'Не является boolean',
        'integer' => 'Не является целым числом',
        'min' => 'Количество < 1'
        ];


    public function __construct(EmployeesRepository $employeesRepository)
    {
        $this->employeesRepository = $employeesRepository;
    }

    public function getAll()
    {
        return $this->employeesRepository->getAll();
    }

    private function checkValidate(Request $request)
    {
        return Validator::make($request->all(), $this->validationRules,$this->validateMessages);
    }

    public function create(Request $request)
    {
        $validator = $this->checkValidate($request);
        if($validator->fails()){
            return ['message'=>$validator->errors(),'status'=>400];
        } else
        {
            $result = $this->employeesRepository->create($request);
            return $result;
        }
    }

    public function update(Request $request, $id)
    {
        $validator = $this->checkValidate($request);
        if($validator->fails()){
            return ['message'=>$validator->errors(),'status'=>400];
        } else
        {
            return $this->employeesRepository->update($request,$id);
        }
    }

    public function delete($id)
    {
        return $this->employeesRepository->delete($id);
    }
}
