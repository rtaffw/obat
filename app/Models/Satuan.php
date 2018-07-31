<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Satuan extends Model
{
    public function Obat()
    {
      return $this->hasOne('App\Models\Obat');
    }
}
