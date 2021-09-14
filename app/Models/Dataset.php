<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dataset extends Model
{
    use HasFactory;
    protected $primaryKey = 'dataset_id';
    protected $table = 'dataset';
    protected $fillable = [
        'dataset_x1',
        'dataset_x2',
        'dataset_x3',
        'dataset_x4'];
}
