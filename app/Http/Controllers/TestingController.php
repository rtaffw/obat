<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use Illuminate\Http\Request;

class TestingController extends Controller
{
  public function index()
  {

      $data = Obat::all();
      foreach ($data as $key => $v)
      {
        echo " nama obat ".$v['name']." || jenis ".$v->jenis->name." || satuan ".$v->satuan->name;
      }
  }
}
