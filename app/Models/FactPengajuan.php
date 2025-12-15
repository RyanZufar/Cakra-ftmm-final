<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FactPengajuan extends Model
{
    protected $connection = 'mysql_dw';
    protected $table = 'fact_pengajuan';
    public $timestamps = false;
    protected $guarded = ['id'];
    
    public function ormawa()
    {
        return $this->belongsTo(Ormawa::class, 'ormawa_id', 'ormawa_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_pengaju_id', 'user_id');
    }
    
    public function pengajuan()
    {
        return $this->belongsTo(Pengajuan::class, 'pengajuan_id', 'pengajuan_id');
    }
}