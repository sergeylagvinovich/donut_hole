<?php
/**
 * Created by PhpStorm.
 * User: Администратор
 * Date: 10.08.2021
 * Time: 17:16
 */

namespace App\Repository;

use Illuminate\Http\Request;
interface EmployeesRepositoryInterface
{
    public function getAll();

    public function create(Request $request);

    public function update(Request $request, $id);

    public function delete($id);

}
