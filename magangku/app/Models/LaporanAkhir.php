<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LaporanAkhir extends Model
{
    use HasFactory;

    protected $table = 'laporan_akhir';

    protected $fillable = [
        'user_id',
        'nama_file',
    ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
