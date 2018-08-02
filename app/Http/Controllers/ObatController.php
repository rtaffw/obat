<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use App\Models\Jenis;
use App\Models\Hasil;
use App\Models\Satuan;
use Illuminate\Http\Request;

class ObatController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $data_obat    = Obat::all();
      $data_jenis   = Jenis::all();
      $data_satuan  = Satuan::all();

      return view('template.data_obat',[
                                        'data_obat' => $data_obat,
                                        'data_satuan' => $data_satuan,
                                        'data_jenis' => $data_jenis,
                                                                  ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return "cretae";
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $data_obat    = Obat::all();
      $data_jenis   = Jenis::all();
      $data_satuan  = Satuan::all();

      $data = [
                'name'=>$request->nama,
                'jenis_id'=>$request->jenis,
                'satuan_id'=>$request->satuan,
              ];

        if(Obat::insert($data)){
          return redirect()->route('data_obat.index')->with('Berhasil', 'Data Obat Berhasil Ditambahkan.');
        }

        return redirect(route('data_obat.index'))->with('Gagal', 'Data Obat Gagal Ditambahkan.');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect(route('data_obat.index'));
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
      $data = [
                'name'=>$request->nama,
                'jenis_id'=>$request->jenis,
                'satuan_id'=>$request->satuan,
              ];

      if(Obat::where('id',$id)->update($data)){
        return redirect(route('data_obat.index'))->with('Berhasil', 'Data Obat Berhasil Diedit.');
      }

      return redirect(route('data_obat.index'))->with('Gagal', 'Data Obat Gagal Diedit.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Obat::destroy($id)){
          return redirect(route('data_obat.index'))->with('Gagal', 'Data Berhasil Dihapus.');
        }

        return redirect(route('data_obat.index'))->with('Berhasil', 'Data Obat Gagal Dihapus.');
    }
}
