<?php

namespace App\Imports;

use App\Models\Bpjs;
use Maatwebsite\Excel\Concerns\ToModel;

class BpjsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)

    {
        if (!isset($row[0]))
        {
            return null;
        }
        return new Bpjs([
            'data_nama' => $row[0],
            'data_nik' => $row[1],
            'data_hp' => $row[2],
            'data_alamat' => $row[3],
            'data_tinggal' => $row[4],
            'data_jml_keluarga' => $row[5],
            'data_pekerjaan' => $row[6],
            'data_penghasilan' => $row[7],
        ]);
    }
}
