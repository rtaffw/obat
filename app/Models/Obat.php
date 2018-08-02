<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Obat extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function jenis()
    {
      return $this->belongsTo('App\Models\Jenis', 'jenis_id');
    }

    public function satuan()
    {
      return $this->belongsTo('App\Models\Satuan', 'satuan_id');
    }

    public function Stok()
    {
      return $this->hasOne('App\Models\Stok');
    }

    public function Perhitungan()
    {
      return $this->hasOne('App\Models\Perhitungan');
    }

    public function Hasil()
    {
      return $this->hasOne('App\Models\HHasil');
    }
}
