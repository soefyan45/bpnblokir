@extends('layouts.default')
@section('title','BPN Kab.Kampar')
@section('siteName','Officer')
@section('_containerOfContents')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{asset('/assets/modules/ionicons/css/ionicons.min.css')}}">

    <div class="main-content w-full">
        <section class="section">
            <div class="section-header">
                <h1>Report</h1>
            </div>
            <div class="col-12 pb-2" style="border:chocolate; border-style:dotted;">
                <div class="pt-2">Generate Report</div>
                <form action="{{route('officer.generateReportBlokir')}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6 col-12">
                            <div class="form-group">
                                <label>Awal</label>
                                <input type="date" name="startDate" id="startDate" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="form-group">
                                <label>Akhir</label>
                                <input type="date" name="endDate" id="endDate" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button class="btn btn-info float-right">Proses</button>
                        </div>
                    </div>
                </form>
            </div>
            @if ($Generate==true)
                <div class="card card-info mt-2">
                    <div class="card-header" style="justify-content: space-between;">
                        <h3>Report</h3>
                        <div class="card-header-action" style="display: flex">
                            <form action="{{route('officer.downloadReportBlokir')}}" method="POST" class="col-12" style="display: flex">
                                @csrf
                                <input class="form-control pr-1" readonly  name="startDate" value="{{$start}}">
                                <input class="form-control pr-1" readonly name="endDate" value="{{$end}}">
                                <button class="btn btn-info">Download Report</button>
                            </form>
                        </div>
                    </div>
                    @if ($Blokir->count()==0)
                        <div class="card-body">
                            <div class="col-12">
                                <h1>Data Kosong</h1>
                            </div>
                        </div>
                    @endif
                    @if ($Blokir->count()!=0)
                    <div class="row">
                        <div class="col-lg-2 col-md-6 col-sm-6 col-12">
                          <div class="card card-info card-statistic-1">
                            <div class="card-wrap">
                              <div class="card-header">
                                <h4 class="text-black">Total</h4>
                              </div>
                              <div class="card-body">
                                {{$Blokir->count()}}
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-lg-2 col-md-6 col-sm-6 col-12">
                          <div class="card bg-secondary card-statistic-1">
                            <div class="card-wrap">
                              <div class="card-header">
                                <h4 class="text-white">Verifikasi</h4>
                              </div>
                              <div class="card-body">
                                {{$Verifikasi}}
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-lg-2 col-md-6 col-sm-6 col-12">
                          <div class="card bg-danger card-statistic-1">
                            <div class="card-wrap">
                              <div class="card-header">
                                <h4 class="text-white">Tolak</h4>
                              </div>
                              <div class="card-body">
                                {{$Ditolak}}
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-lg-2 col-md-6 col-sm-6 col-12">
                          <div class="card bg-primary card-statistic-1">
                            <div class="card-wrap">
                              <div class="card-header">
                                <h4 class="text-white">Klarifikasi</h4>
                              </div>
                              <div class="card-body">
                                {{$Klarifikasi}}
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-lg-2 col-md-6 col-sm-6 col-12">
                          <div class="card bg-warning card-statistic-1">
                            <div class="card-wrap">
                              <div class="card-header">
                                <h4 class="text-white">Pengkajian</h4>
                              </div>
                              <div class="card-body">
                                {{$pengkajianBlokir}}
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-lg-2 col-md-6 col-sm-6 col-12">
                          <div class="card bg-success card-statistic-1">
                            <div class="card-wrap">
                              <div class="card-header">
                                <h4 class="text-white">Selesai</h4>
                              </div>
                              <div class="card-body">
                                {{$Selesai}}
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                        <div class="card-body">
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
                                        @foreach ($Blokir as $riwayat)
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
                    @endif
                </div>
            @endif

            {{-- <div class="card card-info mt-2">
                <div class="card-header">
                    <h3>Laporan Data</h3>
                </div>
                Total Data Pengajuan : {{$Blokir->count()}}
                @php
                    $selesai = 0;
                    $verifikasiDokumen = 0;
                    $klarifikasi = 0;
                @endphp
                @foreach ($Blokir as $blokir)
                @if ($blokir['statusPengkajian']=='Selesai')
                    @php
                        $selesai++;
                    @endphp
                @endif
                @if ($blokir['statusPengkajian']=='Verifikasi Dokumen')
                    @php
                        $verifikasiDokumen++;
                    @endphp
                @endif
                @if ($blokir['statusPengkajian']=='Klarifikasi')
                    @php
                        $klarifikasi++;
                    @endphp
                @endif

                @endforeach
                Pengajuan Selesai {{$selesai}}
                Verifikasi Dokumen {{$verifikasiDokumen}}
                Klarifikasi {{$klarifikasi}}

            </div> --}}
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
