<?php

namespace App\Domain\Employee;

use App\Models\Employee;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\File\File;

class ListAction
{
    public function execute(Request $request)
    {
        $queryList = Employee::query();

        if (!is_null($request->get('name')))
        {
            $queryList->orWhere('name', 'LIKE', '%' . $request->get("name") . '%');
        }

        if (!is_null($request->get('surname')))
        {
            $queryList->orWhere('surname', 'LIKE', '%' . $request->get("surname") . '%');
        }

        if (!is_null($request->get('patronymic')))
        {
            $queryList->orWhere('patronymic', 'LIKE', '%' . $request->get("patronymic") . '%');
        }

        if (!is_null($request->get('position')))
        {
            $queryList->orWhere('position', 'LIKE', '%' . $request->get("position") . '%');
        }

        if (!is_null($request->get('order')))
        {
            $sort = "asc";

            if (!is_null($request->get('sort')) && in_array($request->get('sort'), ['asc', 'desc']))

            $queryList->orderBy($sort, $request->get('order'));
        }

        $employees = $queryList->get();

        $limit = 10;
        $offset = null;
        $page = 1;

        if (!is_null($request->get('limit')))
        {
            $limit = $request->get('limit');
            if (!is_null($request->get('page')))
            {
                $page = $request->get('page');
                $offset = ($page - 1) * $limit;
            }
        }

        $total = $employees->count();
        $employees = array_slice($employees->toArray(),$offset ?? 0, $limit);

        foreach ($employees as $id => $employee)
        {
            if (!is_null($employee["photo_url"]))
            {
                $employees[$id]["photo"] = new File($employee["photo_url"]);
                unset($employees[$id]["photo_url"]);
            }
            unset($employees[$id]["photo_url"]);
        }

        return response()->json([
            'data' => [
                'list' => $employees
            ],
            'meta' => [
                'status' => 200,
                'page' => $page,
                'limit' => $limit,
                'total' => $total
            ]
        ]);
    }
}
