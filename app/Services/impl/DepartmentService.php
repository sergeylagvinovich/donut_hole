<?php
/**
 * Created by PhpStorm.
 * User: Администратор
 * Date: 10.08.2021
 * Time: 17:22
 */

namespace App\Services\impl;


use App\Repository\impl\DepartmentsRepository;
use App\Services\DepartmentsServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DepartmentService implements DepartmentsServiceInterface
{
    private $departmentRepository;

    private $validationRules = [
        'name' =>'required',
        ];

    private $validateMessages = [
        'required' =>'Обязательное поле для заполнения'
        ];


    public function __construct(DepartmentsRepository $departmentRepository)
    {
        $this->departmentRepository = $departmentRepository;
    }

    public function getAll()
    {
        return $this->departmentRepository->getAll();
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
            $result = $this->departmentRepository->create($request);
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
            return $this->departmentRepository->update($request,$id);
        }
    }

    public function delete($id)
    {
        return $this->departmentRepository->delete($id);
    }
}
