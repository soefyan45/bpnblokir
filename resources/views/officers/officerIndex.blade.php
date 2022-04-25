@extends('layouts.default')
@section('title','BPN Kab.Kampar')
@section('siteName','Officer')
@section('_containerOfContents')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{asset('/assets/modules/ionicons/css/ionicons.min.css')}}">

    <div class="main-content w-full">
        <section class="section">
            <div class="section-header">
                <h1>Dashboard Officer</h1>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                  <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                      <i class="far fa-user"></i>
                    </div>
                    <div class="card-wrap">
                      <div class="card-header">
                        <h4>Total Pemohon</h4>
                      </div>
                      <div class="card-body">
                        {{$User}}
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                  <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                      <i class="far fa-user"></i>
                    </div>
                    <div class="card-wrap">
                      <div class="card-header">
                        <h4>Total Pengajuan</h4>
                      </div>
                      <div class="card-body">
                        {{$Pengajuan}}
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                  <div class="card card-statistic-1">
                    <div class="card-icon bg-warning">
                      <i class="far fa-file"></i>
                    </div>
                    <div class="card-wrap">
                      <div class="card-header">
                        <h4>Verifikasi Dokumen</h4>
                      </div>
                      <div class="card-body">
                        {{$Verifikasi}}
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                  <div class="card card-statistic-1">
                    <div class="card-icon bg-danger">
                      <i class="far fa-file"></i>
                    </div>
                    <div class="card-wrap">
                      <div class="card-header">
                        <h4>Dokumen di Tolak</h4>
                      </div>
                      <div class="card-body">
                        {{$Ditolak}}
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                  <div class="card card-statistic-1">
                    <div class="card-icon bg-success">
                      <i class="fas fa-file"></i>
                    </div>
                    <div class="card-wrap">
                      <div class="card-header">
                        <h4>Klarifikasi</h4>
                      </div>
                      <div class="card-body">
                        {{$Klarifikasi}}
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                  <div class="card card-statistic-1">
                    <div class="card-icon bg-success">
                      <i class="fas fa-file"></i>
                    </div>
                    <div class="card-wrap">
                      <div class="card-header">
                        <h4>Pengkajian Blokir</h4>
                      </div>
                      <div class="card-body">
                        {{$pengkajianBlokir}}
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                  <div class="card card-statistic-1">
                    <div class="card-icon bg-success">
                      <i class="fas fa-file"></i>
                    </div>
                    <div class="card-wrap">
                      <div class="card-header">
                        <h4>Selesai</h4>
                      </div>
                      <div class="card-body">
                        {{$Selesai}}
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            {{-- <div class="card card-info">
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
                @if ($blokir['statusPengkajian']=='Selesai' && \Carbon\Carbon::parse($blokir['updated_at'])->isoFormat('Y-MM-DD') == \Carbon\Carbon::now()->isoFormat('Y-MM-DD'))
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
