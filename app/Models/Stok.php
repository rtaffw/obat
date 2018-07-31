<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stok extends Model
{
  public function obat()
  {
    return $this->belongsTo('App\Models\Obat', 'obat_id');
  }
}
