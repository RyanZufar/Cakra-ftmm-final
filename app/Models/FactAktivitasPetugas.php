<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FactAktivitasPetugas extends Model
{
    use HasFactory;
    protected $connection = 'mysql_dw'; 
    protected $table = 'fact_aktivitas'; 
    public $timestamps = false;
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id', 'status_id');
    }

    public function pengajuan()
    {
        return $this->belongsTo(Pengajuan::class, 'pengajuan_id', 'pengajuan_id');
    }
}