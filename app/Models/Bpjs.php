<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bpjs extends Model
{
    use HasFactory;
    protected $table = 'data';
    protected $primaryKey = 'data_id';
    protected $fillable = [
        'data_nama',
        'data_nik',
        'data_hp',
        'data_alamat',
        'data_tinggal',
        'data_jml_keluarga',
        'data_pekerjaan',
        'data_penghasilan'];
    protected $hidden = ['created_at', 'updated_at'];
}
