<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jenis extends Model
{
    public function Obat()
    {
      return $this->hasOne('App\Models\Obat');
    }
}
