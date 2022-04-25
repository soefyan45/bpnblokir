@extends('layouts.default')
@section('title','BPN Kab.Kampar')
@section('siteName','Officer')
@section('_containerOfContents')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{asset('/assets/modules/ionicons/css/ionicons.min.css')}}">

    <div class="main-content w-full">
        <section class="section">
            <div class="section-header">
                <h1>Setting Penjabat Berwenanag</h1>
            </div>
            <div class="card card-info">
                <div class="card-header" style="justify-content: space-between;">
                    <h3>Panel Penjabat Berwenang</h3>
                    <div class="card-header-action" style="display: flex">
                        <button data-toggle="modal" data-target="#updatePenjabat" class="btn btn-warning">Rubah Data Penjabat</button>
                    </div>
                </div>
                <div class="card-body">
                    <table style="width:100%">
                        <tr>
                          <th style="width: 40rem">Kepala Kantor</th>
                          <td>:</td>
                          <td>{{$penjabat['kepala_kantor']}}</td>
                        </tr>
                        <tr>
                          <th style="width: 40rem">NIP Kepala Kantor</th>
                          <td>:</td>
                          <td>{{$penjabat['nip_kepala_kantor']}}</td>
                        </tr>
                        <tr>
                          <th style="width: 40rem">Kepala Seksi Penanganan Masalah dan  Pengendalian Pertanahan</th>
                          <td>:</td>
                          <td>{{$penjabat['kepala_sub_penanganan_masalah_pertanahan']}}</td>
                        </tr>
                        <tr>
                          <th style="width: 40rem">NIP Kepala Seksi Penanganan Masalah dan  Pengendalian Pertanahan</th>
                          <td>:</td>
                          <td>{{$penjabat['nip_kepala_sub_penanganan_masalah_pertanahan']}}</td>
                        </tr>
                        <tr>
                          <th style="width: 40rem">Calon Analis Sengketa Pertanahan</th>
                          <td>:</td>
                          <td>{{$penjabat['calon_analis_sengketa']}}</td>
                        </tr>
                        <tr>
                          <th style="width: 40rem">NIP Calon Analis Sengketa Pertanahan</th>
                          <td>:</td>
                          <td>{{$penjabat['nip_calon_analisis_sengketa']}}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </section>
    </div>
    </div>
    <div class="modal fade" id="updatePenjabat" tabindex="-1" role="dialog" aria-labelledby="updatePenjabat" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header bg-warning">
              <h5 class="modal-title text-white">Update Data Penjabat Kantor</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="{{route('officer.updatePenjabat')}}" method="POST" >
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label class="float-left">Kepala Kantor</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-boxes"></i>
                                </div>
                            </div>
                            <input name="kepalaKantor" id="KepalaKantor" class="form-control" value="{{$penjabat['kepala_kantor']}}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="float-left">NIP Kepala Kantor</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-boxes"></i>
                                </div>
                            </div>
                            <input name="nipKepalaKantor" id="nipKepalaKantor" class="form-control" value="{{$penjabat['nip_kepala_kantor']}}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="float-left">Kepala Seksi Penanganan Masalah dan Pengendalian Pertanahan</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-boxes"></i>
                                </div>
                            </div>
                            <input name="kepala_seksi_penanganan_masalah" id="kepala_seksi_penanganan_masalah" class="form-control" value="{{$penjabat['kepala_sub_penanganan_masalah_pertanahan']}}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="float-left">NIP Kepala Seksi Penanganan Masalah dan Pengendalian Pertanahan</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-boxes"></i>
                                </div>
                            </div>
                            <input name="nip_kepala_seksi_penanganan_masalah" id="nip_kepala_seksi_penanganan_masalah" class="form-control" value="{{$penjabat['nip_kepala_sub_penanganan_masalah_pertanahan']}}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="float-left">Calon Analis Sengketa Pertanahan</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-boxes"></i>
                                </div>
                            </div>
                            <input name="calon_analis_sengketa_pertanahan" id="calon_analis_sengketa_pertanahan" class="form-control" value="{{$penjabat['calon_analis_sengketa']}}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="float-left">NIP Calon Analis Sengketa Pertanahan</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-boxes"></i>
                                </div>
                            </div>
                            <input name="nip_calon_analis_sengketa_pertanahan" id="nip_calon_analis_sengketa_pertanahan" class="form-control" value="{{$penjabat['nip_calon_analisis_sengketa']}}" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan Data</button>
                </div>
            </form>
          </div>
        </div>
    </div>
    </div>
    <!-- General JS Scripts -->
    <script src="{{asset('/assets/modules/jquery.min.js')}}"></script>
    <script src="{{asset('/assets/modules/popper.js')}}"></script>
    <script src="{{asset('/assets/modules/tooltip.js')}}"></script>
    <script src="{{asset('/assets/modules/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('/assets/modules/nicescroll/jquery.nicescroll.min.js')}}"></script>
    <script src="{{asset('/assets/modules/moment.min.js')}}"></script>
    <script src="{{asset('/assets/js/stisla.js')}}"></script>

    <!-- JS Libraies -->
    <script src="{{asset('/assets/modules/simple-weather/jquery.simpleWeather.min.js')}}"></script>
    <script src="{{asset('/assets/modules/chart.min.js')}}"></script>
    <script src="{{asset('/assets/modules/jqvmap/dist/jquery.vmap.min.js')}}"></script>
    <script src="{{asset('/assets/modules/jqvmap/dist/maps/jquery.vmap.world.js')}}"></script>
    <script src="{{asset('/assets/modules/summernote/summernote-bs4.js')}}"></script>
    <script src="{{asset('/assets/modules/chocolat/dist/js/jquery.chocolat.min.js')}}"></script>

    <!-- JS Libraies -->
    <script src="{{asset('/assets/modules/datatables/datatables.min.js')}}"></script>
    <script src="{{asset('/assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('/assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js')}}"></script>

    <!-- Template JS File -->
    <script src="{{asset('/assets/js/scripts.js')}}"></script>
    <script src="{{asset('/assets/js/custom.js')}}"></script>
@endsection
