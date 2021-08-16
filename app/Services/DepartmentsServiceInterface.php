<?php
/**
 * Created by PhpStorm.
 * User: Администратор
 * Date: 10.08.2021
 * Time: 17:22
 */

namespace App\Services;


use Illuminate\Http\Request;

interface DepartmentsServiceInterface
{
    public function getAll();

    public function create(Request $request);

    public function update(Request $request, $id);

    public function delete($id);
}
