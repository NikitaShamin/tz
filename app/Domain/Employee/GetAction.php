<?php

namespace App\Domain\Employee;

use App\Models\Employee;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\File\File;

class GetAction
{
    public function execute(Request $request, int $id)
    {
        $employee = Employee::find($id);

        $employee["photo"] = null;
        if (!is_null($employee["photo_url"]))
        {
            $employee["photo"] = new File($employee["photo_url"]);
        }
        unset($employee["photo_url"]);

        return response()->json([
            'data' => [
                'employee' => $employee
            ],
            'meta' => [
                'status' => 200
            ]
        ]);
    }
}
