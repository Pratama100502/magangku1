<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReferensiProject extends Model
{
    use HasFactory;

    protected $table = 'referensi_project'; // nama tabel sesuai migrasi
    protected $fillable = [
        'user_id',
        'nama_referensi_project',
        'nama_file',
    ];

    // Relasi ke peserta magang
    public function peserta()
    {
        return $this->belongsTo(PesertaMagang::class, 'user_id');
    }
}
