@extends('template.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Data Stok Obat</h1>
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
            <button class="btn btn-warning" data-toggle="modal" data-target="#TambahObatModal">Update Semua Data Peramalan</button>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <br>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Data Stok Obat Apotek Nur Bercahaya
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th nowrap>Nama Obat</th>
                                <th nowrap  align="center">Bulan</th>
                                <th nowrap  align="center">Perkiraan Jumlah Stok</th>
                                <th nowrap  align="center">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        @if($data_hasil!=null)
                         @foreach($data_hasil as $d)
                            <tr class="odd gradeX">
                                <td nowrap>{{$d['nama']}}</td>
                                <td nowrap align="center">{{$d['bulan_huruf']}} {{$d['tahun']}}</td>
                                <td nowrap align="right">{{$d['jumlah']}}</td>
                                <td nowrap align="center">
                                    <button class="btn btn-xs btn-info btn_lihat" data-toggle="modal" data-target="#EditDataObatModal"  data-id="{{$d['obat_id']}}" >Lihat Perhitungan</button>
                                  </td>
                            </tr>
                            @endforeach
                          @endif
                          </tbody>
                      </table>
                      <!-- /.table-responsive -->

                  </div>
                  <!-- /.panel-body -->
              </div>
              <!-- /.panel -->
          </div>
          <!-- /.col-lg-12 -->
      </div>
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

$(document).on('click','button.btn_lihat', function()
{
  var id = $(this).attr('data-id');
  var route = "{{route('data_peramalan.index')}}";

  window.location = route+"/"+id;
});





</script>
@endsection
