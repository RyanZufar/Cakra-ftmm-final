<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FactDana extends Model
{
    use HasFactory;
    protected $connection = 'mysql_dw'; 
    protected $table = 'fact_dana';
    public $timestamps = false;

    protected $guarded = ['id'];

    public function ormawa()
    {
        return $this->belongsTo(Ormawa::class, 'ormawa_id', 'ormawa_id');
    }

    public function pengajuan()
    {
        return $this->belongsTo(Pengajuan::class, 'pengajuan_id', 'pengajuan_id');
    }
}