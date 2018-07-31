<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FungsiController extends Controller
{
    public function Bulan_indo($bulan)
    {
      if($bulan==1)
    		$hasil = "Jan";
    	elseif($bulan==2)
    		$hasil = "Feb";
    	elseif($bulan==3)
    		$hasil = "Mar";
    	elseif($bulan==4)
    		$hasil = "Apr";
    	elseif($bulan==5)
    		$hasil = "Mei";
    	elseif($bulan==6)
    		$hasil = "Jun";
    	elseif($bulan==7)
    		$hasil = "Jul";
    	elseif($bulan==8)
    		$hasil = "Agt";
    	elseif($bulan==9)
    		$hasil = "Sept";
    	elseif($bulan==10)
    		$hasil = "Okt";
    	elseif($bulan==11)
    		$hasil = "Nov";
    	elseif($bulan==12)
    		$hasil = "Des";
    	else
    		$hasil = "ERROR";

    	return $hasil;
    }
}
