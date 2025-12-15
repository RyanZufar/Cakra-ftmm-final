<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\HistoriStatus;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $connection = 'mysql';
    protected $table = 'users';
    protected $primaryKey = 'user_id';
    protected $fillable = ['name', 'email', 'password', 'role_id', 'ormawa_id'];

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id', 'role_id');
    }

    public function pengajuan()
    {
        return $this->hasMany(Pengajuan::class, 'user_id', 'user_id');
    }

    public function ormawa()
    {
        return $this->belongsTo(Ormawa::class, 'ormawa_id', 'ormawa_id');
    }
    public function historiStatus()
    {
        return $this->hasMany(HistoriStatus::class, 'diubah_oleh_user_id', 'user_id');
    }
}
