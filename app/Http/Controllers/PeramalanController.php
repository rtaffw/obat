<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use App\Models\Stok;
use App\Models\Hasil;
use App\Models\Jenis;
use App\Models\Satuan;
use App\Models\Perhitungan;
use Illuminate\Http\Request;

class PeramalanController extends Controller
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
        $data_obat = Obat::all();
        Hasil::all()->delete();

        foreach ($data_obat as $key => $v) {
          // echo Hasil::where(['obat_id'=>$v->id])->count();
          if(!Hasil::where(['obat_id'=>$v->id])->count()){
              Hasil::insert(['obat_id'=>$v->id,'c'=>0]);
          }
        }

// return Hasil::all();

          foreach(Hasil::all() as $key => $v)
          {
                $data_hasil[$key] = [
                                      'id'          => $v->id,
                                      'obat_id'     => $v->obat_id,
                                      'nama'        => $v->obat()->name,
                                      'nama'        => "ERROR",
                                      'bulan'       => explode("-" , $v->bulan)[1],
                                      'bulan_huruf' => $this->Bulan_indo(explode("-" , $v->bulan)[1]),
                                      'tahun'       => explode("-" , $v->bulan)[0],
                                      'jumlah'      => $v->c,
                                    ];
                              }

// return $data_hasil;
          return view('template.data_peramalan',[
                                            'data_obat' => $data_obat,
                                            'data_hasil' => $data_hasil,
                                                                      ]);


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return "index";
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return "store";
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $obat_id = $id;
      $data = Stok::selectRaw('count(*) as n, obat_id')->where(['obat_id'=>$obat_id])->groupBy('obat_id')->get();
      Perhitungan::where(['obat_id'=>$obat_id])->delete();

      foreach ($data as $key => $v) {
        $n       =  $v['n'];
        $obat_id =  $v['obat_id'];

        //SKALA PERIODE WAKTU X
              if($n%2==1){
                $b=(($n-1)/2);
                $a=-$b;
                $c=1;
              }else{
                $a=-$n+1;
                $c=2;
              }

              $hasil = $a;



              $jumlah = stok::select('jumlah','bulan')->where('obat_id','=',$obat_id)->get();

              foreach ($jumlah as $key => $v) {
                $x[$key] = $hasil;
                $x2[$key] = $hasil*$hasil;
                $hasil = $hasil+$c;
                $bulan[$key] = $v['bulan'];
                $y[$key] = $v['jumlah'];
                $xy[$key] = $x[$key]*$y[$key];



                if(Perhitungan::where(['bulan'=>$bulan[$key],'obat_id'=>$obat_id])->count()){
                  //jika ada maka update
                  Perhitungan::where(['bulan'=>$bulan[$key],'obat_id'=>$obat_id])->update([
                    'x'=>$x[$key],
                    'y'=>$y[$key],
                    'x2'=>$x2[$key],
                    'xy'=>$xy[$key],
                  ]);
                  // echo "update \n";
                }else{
                  //jika tidak maka input
                  Perhitungan::insert([
                    'obat_id'=>$obat_id,
                    'bulan'=>$bulan[$key],
                    'x'=>$x[$key],
                    'y'=>$y[$key],
                    'x2'=>$x2[$key],
                    'xy'=>$xy[$key],
                  ]);

                // echo "input \n";
                }

              }
              $X[$obat_id] = array('x'=>$x,'y'=>$y,'x2'=>$x2,'xy'=>$xy,'bulan'=>$bulan);
              $sumx = array_sum($x);
              $sumx2 = array_sum($x2);
              $sumxy = array_sum($xy);
              $sumy = array_sum($y);

              $A = $sumy/$n;
              $B = $sumxy/$sumx2;
              $C = abs($A+($B*$hasil));

              if(explode("-" ,$bulan[$key])[1]=='12'){
                $tahun = explode("-" ,$bulan[$key])[0] + 1;
                $bulan[$key] = $tahun."-01-01";
              }else{
                $tahun = explode("-" ,$bulan[$key])[0];
                $bulanxx = explode("-" ,$bulan[$key])[1] + 1;
                $bulan[$key] = $tahun."-".$bulanxx.".-01";
              }



              $sum = array('obat_id'=>$obat_id,'bulan'=>$bulan[$key],'x' => $sumx,'x2' => $sumx2,'xy' => $sumxy,'y' => $sumy,'xt'=>$hasil,'n'=>$n,'A'=>$A,'B'=>$B,'C'=>$C);

              if(Hasil::where(['obat_id'=>$obat_id])->count()){
                //jika ada maka update
                Hasil::where(['obat_id'=>$obat_id])->update($sum);
                // echo "update \n";
              }else{
                //jika tidak maka input
                Hasil::insert($sum);

              // echo "input \n";
              }

              unset($x);unset($x2);unset($xy);unset($y);unset($jumlah);unset($bulan);
              unset($sumx);unset($sumx2);unset($sumxy);unset($sumy);unset($sum);


      }
      // dd(Perhitungan::where(['obat_id'=>$obat_id])->count());
      // dd(Hasil::where(['obat_id'=>$obat_id])->count());
      if(Perhitungan::where(['obat_id'=>$obat_id])->count()==0){
        return redirect()->route('data_peramalan.index')->with('Gagal', 'Data Stok Obat Masih Kosong.');;
      }

      foreach(Perhitungan::where(['obat_id'=>$obat_id])->get() as $key => $v)
      {
            $data_perhitungan[$key] = [
                                  'id'          => $v->id,
                                  // 'nama'        => $v->obat->name,
                                  'nama'        => "ERROR",
                                  'bulan'       => explode("-" , $v->bulan)[1],
                                  'bulan_huruf' => $this->Bulan_indo(explode("-" , $v->bulan)[1]),
                                  'tahun'       => explode("-" , $v->bulan)[0],
                                  'x'      => $v->x,
                                  'xy'      => $v->xy,
                                  'x2'      => $v->x2,
                                  'y'      => $v->y,
                                ];
                          }



      foreach(Hasil::where(['obat_id'=>$obat_id])->get() as $key => $v)
      {
            $data_hasil[$key] = [
                                  'id'          => $v->id,
                                  'nama'        => $v->obat->name,
                                  'bulan'       => explode("-" , $v->bulan)[1],
                                  'bulan_huruf' => $this->Bulan_indo(explode("-" , $v->bulan)[1]),
                                  'tahun'       => explode("-" , $v->bulan)[0],
                                  'x'      => $v->x,
                                  'xy'      => $v->xy,
                                  'x2'      => $v->x2,
                                  'y'      => $v->y,
                                  'a'      => $v->a,
                                  'b'      => $v->b,
                                  'c'      => $v->c,
                                  'xt'      => $v->xt,
                                  'n'      => $v->n,
                                ];
                          }

              // dd($data_hasil);
      return view('template.data_perhitungan',['data_perhitungan'=>$data_perhitungan,
                                              'data_hasil'=>$data_hasil]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return "edit || id => ".$id;
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
        return "update || id => ".$id;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return "destroy || id => ".$id;
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
