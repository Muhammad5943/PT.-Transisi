<?php

namespace App\Imports;

use App\Models\Employee;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class EmployeeImport implements ToModel/* , WithHeadingRow, WithValidation, WithChunkReading */
{
    use Importable;

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Employee([
            'name' => $row[1],
            'email' => $row[2],
            'company_id' => $row[3]
        ]);
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            '*.email' => 'require|string|max:255',
            'company_id' => 'max:255'
        ];
    }

    public function batch(): int
    {
        return 100;
    }

    public function chunkSize(): int
    {
        return 10;
    }
}
