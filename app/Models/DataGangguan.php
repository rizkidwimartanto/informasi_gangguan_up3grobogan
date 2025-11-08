<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataGangguan extends Model
{
    use HasFactory;
    protected $table = 'data_gangguan';
    protected $primaryKey = 'id';
    protected $fillable = [
        'penyulang',
        'keypoint'
    ];
}
