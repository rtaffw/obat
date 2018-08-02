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
            <button class="btn btn-warning" data-toggle="modal" data-target="#TambahObatModal">Tambah Stok Obat</button>
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
                                <th nowrap  align="center">Jumlah Stok</th>
                                <th nowrap  align="center">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        @if($data_stok!=null)
                         @foreach($data_stok as $d)
                            <tr class="odd gradeX">
                                <td nowrap>{{$d['nama']}}</td>
                                <td nowrap align="center">{{$d['bulan_huruf']}} {{$d['tahun']}}</td>
                                <td nowrap align="right">{{$d['jumlah']}}</td>
                                <td nowrap align="center">
                                    <button class="btn btn-xs btn-info btn_edit" data-toggle="modal" data-target="#EditDataObatModal" data-tahun="{{$d['tahun']}}" data-id="{{$d['id']}}" data-nama="{{$d['nama']}}" data-jumlah="{{$d['jumlah']}}" data-bulan="{{$d['bulan']}}" data-bulan-huruf="{{$d['bulan_huruf']}}">Edit Stok</button>

                                    <button class="btn btn-xs btn-danger btn_hapus" data-toggle="modal" data-target="#HapusDataObatModal" data-tahun="{{$d['tahun']}}" data-id="{{$d['id']}}"  data-nama="{{$d['nama']}}" data-jumlah="{{$d['jumlah']}}" data-bulan="{{$d['bulan']}}" data-bulan-huruf="{{$d['bulan_huruf']}}">Hapus Stok</button>
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
<div class="modal fade" id="TambahObatModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
<form action="{{route('data_stok.store')}}" method="POST">
{{ csrf_field() }}
    <div class="modal-dialog" role="document">
    <div class="modal-content">
    <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title" id="myModalLabel">Tambah Data Stok Obat</h4>
    </div>
    <div class="modal-body">
      <div class="form-group">
        <label>Nama Obat</label>
        <select class="form-control" name="obat_id" required>
          <option value="">---Nama Obat---</option>
          @foreach($data_obat as $d)
            <option value="{{$d->id}}">{{$d->name}}</option>
          @endforeach
          </select>
        </div>
    <div class="form-group">
      <label>Bulan</label>
      <select class="form-control" name="bulan" required>
        <option value="">---Bulan---</option>
        @foreach($data_bulan as $d)
          <option value="{{$d['id']}}">{{$d['name']}}</option>
        @endforeach
        </select>
      </div>
      <div class="form-group">
        <label>Tahun</label>
        <select class="form-control" name="tahun" required>
          <option value="">---Tahun---</option>
          @for($i = 1; $i <= 10; $i++)
            <option value="{{$i+2010}}">{{$i+2010}}</option>
          @endfor
          </select>
        </div>
        <div class="form-group">
            <label>Jumlah Stok</label>
            <input class="form-control" placeholder="Jumlah Stok Obat" name="jumlah_stok" required>
          </div>

    </div>
    <div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
    <button type="submit" class="btn btn-primary">Tambah Data Stok Obat</button>
    </form>
    </div>
    </div>
  </div>
</div>

<div class="modal fade" id="EditDataObatModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<h4 class="modal-title" id="myModalLabel">Edit Data Obat</h4>
</div>
<div class="modal-body">
<form id="edit_form" action="" method="POST">
{{ method_field('PUT') }}
  {{ csrf_field() }}

<div class="form-group">
    <label>Nama Obat</label>
    <input class="form-control" placeholder="Nama Obat" id="edit_nama_obat" disabled>
  </div>
  <div class="form-group">
      <label>Bulan</label>
      <input class="form-control" placeholder="Nama Obat" id="edit_bulan_stok" disabled>
    </div>
    <div class="form-group">
        <label>Jumlah Stok Obat</label>
        <input class="form-control" placeholder="Nama Obat" name="jumlah" id="edit_jumlah_stok">
      </div>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
<button type="submit" class="btn btn-primary" id="Modal_Edit">Edit Data Obat</button>
</form>
</div>
</div>
</div>
</div>

<div class="modal fade" id="HapusDataObatModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<h4 class="modal-title" id="myModalLabel">Hapus Data Obat</h4>
</div>
<div class="modal-body">
<div id='modal_hapus_pesan'>

</div>
<form id="hapus_form" action="" method="post">
  {{ method_field('DELETE') }}
    {{ csrf_field() }}


</div>
<div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
<button type="submit" class="btn btn-primary">Hapus Data Obat</button>

</form>
</div>
</div>
</div>
</div>

</div>
<!-- /#wrapper -->

<!-- jQuery -->
<script src="{{secure_asset('template/vendor/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap Core JavaScript -->
<script src="{{secure_asset('template/vendor/bootstrap/js/bootstrap.min.js')}}"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="{{secure_asset('template/vendor/metisMenu/metisMenu.min.js')}}"></script>

<!-- Morris Charts JavaScript -->
<script src="{{secure_asset('template/vendor/raphael/raphael.min.js')}}"></script>
<script src="{{secure_asset('template/vendor/morrisjs/morris.min.js')}}"></script>
<script src="{{secure_asset('template/data/morris-data.js')}}"></script>

<!-- Custom Theme JavaScript -->
<script src="{{secure_asset('template/dist/js/sb-admin-2.js')}}"></script>

<!-- DataTables JavaScript -->
<script src="{{secure_asset('template/vendor/datatables/js/jquery.dataTables.min.js')}}"></script>
<script src="{{secure_asset('template/vendor/datatables-plugins/dataTables.bootstrap.min.js')}}"></script>
<script src="{{secure_asset('template/vendor/datatables-responsive/dataTables.responsive.js')}}"></script>

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

$(document).on('click','button.btn_edit', function()
{
var nama = $(this).attr('data-nama');
var jumlah = $(this).attr('data-jumlah');
var tahun = $(this).attr('data-tahun');
var bulan_huruf = $(this).attr('data-bulan-huruf');
var bulan = bulan_huruf+" "+tahun;
var action = 'data_stok/'+$(this).attr('data-id');

$('#edit_nama_obat').val(nama);
$('#edit_bulan_stok').val(bulan);
$('#edit_jumlah_stok').val(jumlah);

$("#edit_form").attr("action",action);



});


$(document).on('click','button.btn_hapus', function()
{
  var nama = $(this).attr('data-nama');
  var jumlah = $(this).attr('data-jumlah');
  var tahun = $(this).attr('data-tahun');
  var bulan_huruf = $(this).attr('data-bulan-huruf');
  var bulan = bulan_huruf+" "+tahun;
  var action = 'data_stok/'+$(this).attr('data-id');

isi_modal = "Apakah Anda Yakin Menghapus Data Stok Obat "+nama+"<br> Bulan : "+bulan;

$("#modal_hapus_pesan").html(isi_modal);
$("#hapus_form").attr("action",action);




});
</script>
@endsection
