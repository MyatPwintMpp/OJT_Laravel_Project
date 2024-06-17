<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithValidation;

class UsersImport implements ToModel, WithValidation, SkipsOnFailure 
{
    use Importable, SkipsFailures;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new User([
            'email' => $row[0],
            'password' => bcrypt($row[1]),
            'name' => $row[2],
            'img' => $row[3],
            'role' => $row[4],
            'created_by' => $row[5],
            'updated_by' => $row[6]
        ]);
    }

    /**
     * Validation for csv rows
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            '0' => 'required|string|max:255',
            '1' => 'max:2000',
            '2' => 'required|string|max:255',
            '3' => 'nullable', 
            '4' => 'required|integer',
            '5' => 'nullable|integer',
            '6' => 'nullable|integer',
        ];
    }

}
