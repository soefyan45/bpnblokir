@extends('layouts.default')
@section('title','BPN Kab.Kampar')
@section('siteName','BPN Kab.Kampar')
@section('_containerOfContents')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{asset('/assets/modules/ionicons/css/ionicons.min.css')}}">

    <div class="main-content w-full">
        <section class="section">
            <div class="section-header">
                <h1>Riwayat Pengajuan Blokir</h1>
            </div>
            <div class="card card-info">
                <div class="card-header" style="justify-content: space-between;">
                    <h4 class="">Data Riwayat Pengkajian Blokir</h4>
                    <div class="card-header-form">
                        <form>
                          <div class="input-group">
                            <input type="text" class="form-control" placeholder="No. SHM">
                            <div class="input-group-btn">
                              <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                            </div>
                          </div>
                        </form>
                      </div>
                </div>
                <div class="card-body">
                    {{-- <div class="row px-4" style="justify-content: space-between;">
                        <div class="section-title mt-0">Data Riwayat Pengkajian Blokir</div>
                    </div> --}}
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                              <tr>
                                <th style="background-color: #F6CA56;" scope="col">Tiket.</th>
                                <th style="background-color: #003E69; color:white;" scope="col">Pemohon</th>
                                <th style="background-color: #003E69; color:white;" scope="col">No SHM</th>
                                <th style="background-color: #003E69; color:white;" scope="col">Status</th>
                                <th style="background-color: #4a7a9c;" scope="col"></th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach ($Riwayat as $riwayat)
                                <tr>
                                    <th scope="row">#{{$riwayat['tiket']}}</th>
                                    <td>{{$riwayat['namaPemohon']}}</td>
                                    <td>{{$riwayat['nomorSHM']}}</td>
                                    <td style="color:red;">
                                        {{$riwayat['statusPengkajian']}}
                                    </td>
                                    <td>
                                        <a class="btn btn-sm btn-info" href="{{route('officer.pengkajianblokir',$riwayat['id'])}}">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
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
