@extends('template.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Perhitungan Peramalan Stok Obat</h1>
        </div>
    </div>

    @if(session('Berhasil'))
        <div class="alert alert-success" id="peringatan">
            {{ session('Berhasil') }}
        </div>
    @endif

    @if(session('Gagal'))
        <div class="alert alert-danger" id="peringatan">
            {{ session('Gagal') }}
        </div>
    @endif



    <div class="row">
        <div class="col-lg-12">
            <br>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Grafik Stok Obat {{$data_hasil[0]['nama']}}
                </div>

                {{-- Grafik --}}
                <div class="sales-chart">
								   <div class="ct-bar-chart" style="height:350px"></div>
                </div>



              </div>
              </div>
              </div>

              <div class="row">
                  <div class="col-lg-12">
                      <div class="panel panel-default">
                        <div class="panel-heading">
                            Tabel Perhitungan Menggunakan Least Square
                        </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th nowrap>Nama Obat</th>
                                <th nowrap>Bulan</th>
                                <th nowrap  align="center">X</th>
                                <th nowrap  align="center">Y</th>
                                <th nowrap  align="center">X2</th>
                                <th nowrap  align="center">XY</th>
                            </tr>
                        </thead>
                        <tbody>

                        @if($data_perhitungan!=null)
                         @foreach ($data_perhitungan as $d)
                            <tr class="odd gradeX">
                                <td nowrap>{{$d['nama']}}</td>
                                <td nowrap align="center">{{$d['bulan_huruf']}} {{$d['tahun']}}</td>
                                <td nowrap align="right">{{$d['x']}}</td>
                                <td nowrap align="right">{{$d['y']}}</td>
                                <td nowrap align="right">{{$d['x2']}}</td>
                                <td nowrap align="right">{{$d['xy']}}</td>
                            </tr>
                            @endforeach
                          @endif
                          </tbody>
@php
$iter=0;
foreach ($data_perhitungan as $v) {
  $nama_obat = $v['nama'];
  $bulan[$iter] = $v['bulan_huruf']." ".$v['tahun'];
  $a[$iter] = $v['y'];
  $b[$iter] = "null";
  $iter++;
}
// $b[$iter-1] = $a[$iter-1];
// $a[$iter] = "null";

foreach ($data_hasil as $key => $v) {
  $bulan[$iter] = $v['bulan_huruf']." ".$v['tahun'];
  $a[$iter] = $v['c'];
  $b[$iter] = $v['c'];

  $data_hasil_xt = $v['xt'];
  $data_hasil_x = $v['x'];
  $data_hasil_x2 = $v['x2'];
  $data_hasil_xy = $v['xy'];
  $data_hasil_y = $v['y'];
  $data_hasil_a = $v['a'];
  $data_hasil_b = $v['b'];
  $data_hasil_c = $v['c'];
  $data_hasil_n = $v['n'];
}
@endphp


                          <thead>
                              <tr>
                                  <th nowrap>Total</th>
                                  <th nowrap>{{$data_hasil_n}} data </th>
                                  <th nowrap  align="right">{{$data_hasil_x}}</th>
                                  <th nowrap  align="right">{{$data_hasil_y}}</th>
                                  <th nowrap  align="right">{{$data_hasil_x2}}</th>
                                  <th nowrap  align="right">{{$data_hasil_xy}}</th>
                              </tr>
                          </thead>
                      </table>
                      <!-- /.table-responsive -->

                  </div>
                  <!-- /.panel-body -->
              </div>
              <!-- /.panel -->
          </div>


          <!-- /.col-lg-12 -->
      </div>



      <div class="row">
          <div class="col-lg-12">
              <div class="panel panel-default">
                <div class="panel-heading">
                    Perhitungan Menggunakan Least Square
                </div>
        <!-- /.panel-heading -->
                <div class="panel-body">
                  <div class="row">
                    <div class="col-xs-1">

                    </div>

                    <div class="col-xs-2">
                      Xterakhir = {{$data_hasil_xt}}
                    </div>
                    <div class="col-xs-1">
                      N = {{$data_hasil_n}}
                    </div>
                    <div class="col-xs-1">
                      &#8721;X  = {{$data_hasil_x}}
                    </div>
                    <div class="col-xs-2">
                      &#8721;Y  = {{$data_hasil_y}}
                    </div>
                    <div class="col-xs-2">
                      &#8721;X2 = {{$data_hasil_x2}}
                    </div>
                    <div class="col-xs-2">
                      &#8721;XY = {{$data_hasil_xy}}
                    </div>
                  </div>
                  <br>
                  <div class="row">
                    <div class="col-xs-3">
                      A = &#8721;Y/N = {{$data_hasil_a}}
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-xs-3">
                      B = &#8721;XY/&#8721;X2 = {{$data_hasil_b}}
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-xs-3">
                      Hasil  = A + (B x Xterakhir) = {{$data_hasil_c}}
                    </div>
                  </div>
                  <br>
                  <div class="row">
                    <div class="col-xs-12">
                      Perkiraan Stok Obat {{$nama_obat}} Bulan {{$bulan[$iter]}} Sebesar {{round($data_hasil_c)}} buah
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

<br><br><br><br>



      <!-- /.row -->
    <!-- /.row -->
    <!-- /.row -->

    <!-- /.row -->
</div>
<!-- /#page-wrapper -->


<!-- Modal -->


<!-- /#wrapper -->

<!-- jQuery -->
<script src="{{asset('template/vendor/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap Core JavaScript -->
<script src="{{asset('template/vendor/bootstrap/js/bootstrap.min.js')}}"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="{{asset('template/vendor/metisMenu/metisMenu.min.js')}}"></script>

<!-- Morris Charts JavaScript -->
<script src="{{asset('template/vendor/raphael/raphael.min.js')}}"></script>
<script src="{{asset('template/vendor/morrisjs/morris.min.js')}}"></script>
<script src="{{asset('template/data/morris-data.js')}}"></script>

<!-- Custom Theme JavaScript -->
<script src="{{asset('template/dist/js/sb-admin-2.js')}}"></script>

<!-- DataTables JavaScript -->
<script src="{{asset('template/vendor/datatables/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('template/vendor/datatables-plugins/dataTables.bootstrap.min.js')}}"></script>
<script src="{{asset('template/vendor/datatables-responsive/dataTables.responsive.js')}}"></script>

<script src="{{asset('template/vendor/chartist/chartist.min.js')}}"></script>
<script src="{{asset('template/vendor/chartist/chartist-plugin-tooltip.min.js')}}"></script>

<script>
$(document).ready(function() {
$('#dataTables-example').DataTable({
    responsive: true
});

//waktu mundur
var detik = 5;
var menit = 0;
function hitung()
{
  setTimeout(hitung,1000);
  detik --;



  if(detik < 0)
  {
    detik = 59;
    menit --;
    if(menit < 0)
    {
      menit = 0;
      detik = 0;
    }
    $('#peringatan').hide();
  }

}


hitung();



});


$( function () {
    	"use strict";

      // LINE CHART
      //Simple line chart

		new Chartist.Line('.ct-bar-chart', {
	labels: [@foreach ($bulan as $v) "{{$v}}", @endforeach],
		series: [
					[@foreach ($a as $v) {{$v}}, @endforeach ],
          [ @foreach ($b as $v) {{$v}}, @endforeach],
			]
		}, {
		fullWidth: true,

		// plugins: [
		//   Chartist.plugins.tooltip()
		// ],
		chartPadding: {
		  right: 50
		}
		});

		});







</script>
@endsection
