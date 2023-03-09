<?php

namespace App\Http\Controllers;

use App\Domain\Employee\CreateAction;
use App\Domain\Employee\GetAction;
use App\Domain\Employee\ListAction;
use App\Domain\Employee\UpdateAction;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function create(CreateAction $action, Request $request)
    {
        try
        {
            return $action->execute($request);
        }
        catch (\RuntimeException $exception)
        {
            return response()->json([
                'message' => $exception->getMessage(),
                'status' => 400
            ]);
        }
    }

    public function list(ListAction $action, Request $request)
    {
        try
        {
            return $action->execute($request);
        }
        catch (\RuntimeException $exception)
        {
            return response()->json([
                'message' => $exception->getMessage(),
                'status' => 400
            ]);
        }
    }

    public function get(GetAction $action, Request $request, int $id)
    {
        try
        {
            return $action->execute($request, $id);
        }
        catch (\RuntimeException $exception)
        {
            return response()->json([
                'message' => $exception->getMessage(),
                'status' => 400
            ]);
        }
    }

    public function update(UpdateAction $action, Request $request, int $id)
    {
        try
        {
            return $action->execute($request, $id);
        }
        catch (\RuntimeException $exception)
        {
            return response()->json([
                'message' => $exception->getMessage(),
                'status' => 400
            ]);
        }
    }
}
