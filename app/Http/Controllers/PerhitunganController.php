<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use App\Models\Stok;
use App\Models\Hasil;
use App\Models\Jenis;
use App\Models\Satuan;
use App\Models\Perhitungan;
use Illuminate\Http\Request;

class PerhitunganController extends Controller
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
      $obat_id = 1;
      $data = Stok::selectRaw('count(*) as n, obat_id')->where(['obat_id'=>$obat_id])->groupBy('obat_id')->get();

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
              $C = $A+($B*$hasil);

              if(explode("-" ,$bulan[$key])[1]=='12'){
                $tahun = explode("-" ,$bulan[$key])[0] + 1;
                $bulan[$key] = $tahun."-01-01";
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

      // Stok::
        // return $sum;
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
        return "show";
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
        return "update";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return "destroy";
    }
}
