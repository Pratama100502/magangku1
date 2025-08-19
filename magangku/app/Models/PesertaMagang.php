<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class PesertaMagang extends Authenticatable
{

    use Notifiable;

    protected $table = 'peserta_magang';

    protected $fillable = [
        'nama',
        'email',
        'role',
        'password',
        'asal_sekolah',
        'jurusan',
        'nim',
        'no_hp',
        'surat_permohonan',
        'surat_project',

        //update
        'status',
        'catatan',
        'mentor_id',
        'tanggal_mulai',
        'tanggal_selesai'
    ];

    protected $hidden = ['password'];

    public function mentor()
    {
        return $this->belongsTo(MentorModel::class);
    }

    public function anggota()
    {
        return $this->hasMany(Anggota::class, 'ketua_id');
    }

    // Relasi ke referensi project
    public function referensiProjects()
    {
        return $this->hasMany(ReferensiProject::class, 'user_id');
    }

    public function dokumen()
    {
        return $this->hasMany(Dokumen::class, 'peserta_id'); // sesuaikan foreign key
    }

    const ROLE_ADMIN = 'admin';
    const ROLE_PESERTA_MAGANG = 'peserta';

    public function isAdmin()
    {
        return $this->role === self::ROLE_ADMIN;
    }

    public function isPesertaMagang()
    {
        return $this->role === self::ROLE_PESERTA_MAGANG;
    }
}
