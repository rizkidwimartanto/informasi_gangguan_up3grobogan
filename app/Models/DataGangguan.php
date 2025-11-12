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
        'nihil',
        'ulp',
        'penyulang',
        'keypoint',
        'gardu_padam',
        'progress_nyala',
        'jam_padam',
        'durasi_padam',
        'progress',
        'jumlah_trafo'
    ];
}
