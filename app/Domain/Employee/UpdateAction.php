<?php

namespace App\Domain\Employee;

use App\Models\Employee;
use App\Service\FileUploader;
use Illuminate\Http\Request;

class UpdateAction
{

    private FileUploader $fileUploader;

    public function __construct(FileUploader $fileUploader)
    {
        $this->fileUploader = $fileUploader;
    }

    public function execute(Request $request, int $id)
    {
        $data = $request->validate([
            'name' => 'nullable|string|max:50',
            'patronymic' => 'nullable|string|max:50',
            'surname' => 'nullable|string|max:50',
            'birthday' => 'nullable|date',
            'phone' => 'nullable|string',
            'position' => 'nullable|string',
            'photo' => 'nullable|file'
        ]);

        $employee = Employee::find($id);

        if ($employee)
        {
            if (!is_null($data["photo"]))
            {
                $data["photo_url"] = env('FILES_URL_ON_SERVER') . "\\" . $this->fileUploader->upload($data["photo"]);
            }

            $employee->update($data);
        }

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
