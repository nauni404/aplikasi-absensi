<?php

namespace App\Imports;

use App\Models\Siswa;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SiswaImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        $validator = Validator::make($row, [
            'nis' => 'required|unique:siswa,nis',
            'nama' => 'required',
            'jenis_kelamin' => 'required|in:L,P',
            'kelas_id' => 'nullable',
        ]);

        if ($validator->fails()) {
            // Melewatkan impor untuk entri dengan NIS yang sudah terdaftar
            return null;
        }

        $siswa = new Siswa([
            'nis' => $row['nis'],
            'nama' => $row['nama'],
            'jk' => $row['jenis_kelamin'],
        ]);

        $siswa->save();

        return $siswa;


    }
}
