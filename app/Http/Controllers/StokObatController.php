<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use App\Models\Stok;
use App\Models\Jenis;
use App\Models\Satuan;
use Illuminate\Http\Request;
// use App\Http\Controllers\FungsiController;

class StokObatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function __construct()
     {
         $this->middleware('auth');
     }

    public function index()
    {
      $data_obat    = Obat::all();
      $data_jenis   = Jenis::all();
      $data_satuan  = Satuan::all();

      if(!Stok::count()){
        $data_stok = null;
      }else{
        foreach(Stok::all() as $key => $v)
        {
              $data_stok[$key] = [
                                    'id'          => $v->id,
                                    'nama'        => $v->obat->name,
                                    'bulan'       => explode("-" , $v->bulan)[1],
                                    'bulan_huruf' => $this->Bulan_indo(explode("-" , $v->bulan)[1]),
                                    'tahun'       => explode("-" , $v->bulan)[0],
                                    'jumlah'      => $v->jumlah,
                                  ];
                            }
      }



    // dd($data_stok);



      $data_bulan = [
                ["id" => '01',"name" =>"Jan"],
                ["id" => '02',"name" =>"Feb"],
                ["id" => '03',"name" =>"Mar"],
                ["id" => '04',"name" =>"Apr"],
                ["id" => '05',"name" =>"Mei"],
                ["id" => '06',"name" =>"Jun"],
                ["id" => '07',"name" =>"Jul"],
                ["id" => '08',"name" =>"Agt"],
                ["id" => '09',"name" =>"Spt"],
                ["id" => '10',"name" =>"Okt"],
                ["id" => '11',"name" =>"Nov"],
                ["id" => '12',"name" =>"Des"],
      ];

      return view('template.data_stok_obat',[
                                        'data_obat' => $data_obat,
                                        'data_satuan' => $data_satuan,
                                        'data_jenis' => $data_jenis,
                                        'data_bulan' => $data_bulan,
                                        'data_stok' => $data_stok,
                                                                  ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return "create";
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $data = [
        'obat_id' => $request->obat_id,
        'bulan'   => $request->tahun."-".$request->bulan."-01",
        'jumlah'  => $request->jumlah_stok,
      ];

      if(Stok::insert($data)){
        return redirect()->route('data_stok.index')->with('Berhasil', 'Data Stok Obat Berhasil Ditambahkan.');
      }

      return redirect()->route('data_stok.index')->with('Gagal', 'Data Stok Obat Gagal Ditambahkan.');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      return redirect()->route('data_stok.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return "edit";
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $data = ['jumlah' => $request->jumlah];

      if(Stok::where('id',$id)->update($data)){
        return redirect(route('data_stok.index'))->with('Berhasil', 'Data Stok Obat Berhasil Diedit.');
      }

      return redirect(route('data_stok.index'))->with('Gagal', 'Data Stok Obat Gagal Diedit.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      if(Stok::where('id',$id)->delete()){
        return redirect(route('data_stok.index'))->with('Gagal', 'Data Stok Obat Berhasil Dihapus.');
      }

      return redirect(route('data_stok.index'))->with('Berhasil', 'Data Stok Obat Gagal Dihapus.');
    }

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
