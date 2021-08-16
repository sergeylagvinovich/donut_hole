<?php

namespace App\Http\Controllers\Api;

use App\Services\impl\DepartmentService;
use App\Services\impl\EmployeesService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EmployeesController extends Controller
{

    private $employeesService;

    public  function __construct(EmployeesService $employeesService)
    {
        $this->employeesService = $employeesService;
    }

    public function index(){
        return response()->json($this->employeesService->getAll());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $result = $this->employeesService->create($request);
        return response()->json($result['message'],$result['status']);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $result = $this->employeesService->update($request,$id);
        return response()->json($result['message'],$result['status']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = $this->employeesService->delete($id);
        return response()->json($result['message'],$result['status']);
    }
}
