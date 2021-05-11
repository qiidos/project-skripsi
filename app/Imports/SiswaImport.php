<?php

namespace App\Imports;

use App\Siswa;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;

class SiswaImport implements ToModel, WithHeadingRow, WithValidation, WithCustomCsvSettings
{
    use Importable;
    public function model(array $row)
    {
        return new Siswa([
            'kelas_id' => $row['kelas_id'],
            'nis' => $row['nis'],
            'nama' => $row['nama']
        ]);
    }

    public function rules(): array
    {
        return [
            'nis' => 'required|numeric',
            'nama' => 'required|string|regex:/^[a-zA-Z_,.\s]+$/',
            'kelas_id' => 'required|numeric'
        ];
    }

    public function chunkSize(): int
    {
        return 5000;
    }

    public function getCsvSettings(): array
    {
        return [
            'delimiter' => ";"
        ];
    }
}
