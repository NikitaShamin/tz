<?php

namespace App\Domain\Employee;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Service\FileUploader;

class CreateAction
{
    private FileUploader $fileUploader;

    public function __construct(FileUploader $fileUploader)
    {
        $this->fileUploader = $fileUploader;
    }

    public function execute(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:50',
            'patronymic' => 'required|string|max:50',
            'surname' => 'required|string|max:50',
            'birthday' => 'required|date',
            'phone' => 'required|string',
            'position' => 'required|string',
            'photo' => 'nullable|file'
        ]);

        if (!is_null($data["photo"]))
        {
            $data["photo_url"] = env('FILES_URL_ON_SERVER') . "\\" . $this->fileUploader->upload($data["photo"]);
        }

        $employee = Employee::create($data);

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
