@extends('layouts.default')
@section('title','BPN Kab.Kampar')
@section('siteName','BPN Kab.Kampar')
@section('_containerOfContents')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{asset('/assets/modules/ionicons/css/ionicons.min.css')}}">

    <div class="main-content w-full">
        <section class="section">
            <div class="section-header">
                <h1>Pengajuan Blokir Online</h1>
            </div>
            <div class="row">
                <div class="col-md-6 col-12">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3>Masukan Data</h3>
                        </div>
                        {{-- @if($errors->any())
                            @foreach ($errors->all() as $error)
                                <div>{{ $error }}</div>
                            @endforeach
                        @endif --}}
                        <form action="{{route('apps.storeblokir')}}" method="POST" enctype="multipart/form-data">
                            @csrf()
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Status Pemohon</label>
                                    {{-- @if (auth()->user()['statusPemohon']==null || auth()->user()['statusPemohon']=='' || auth()->user()['statusPemohon']=='Perorangan')
                                        <select id="statusPemohon" name="statusPemohon" required class="form-control">
                                            <option selected value="Perorangan">Perorangan</option>
                                        </select>
                                    @endif--}}
                                    {{auth()->user()['status_pemohon']}}
                                    @if (auth()->user()['status_pemohon']!='Perorangan')
                                    <select id="statusPemohon" name="statusPemohon" required class="form-control statusPemohon @error('statusPemohon') is-invalid @enderror" tabindex="1" required>
                                        <option value="" selected>pilih status</option>
                                        <option value="Perorangan">Perorangan</option>
                                        <option value="Badan Hukum">Badan Hukum</option>
                                        <option value="Penegak Hukum">Penegak Hukum</option>
                                    </select>
                                    @endif
                                    @if (auth()->user()['status_pemohon']=='Perorangan')
                                    <select id="statusPemohon" name="statusPemohon" required class="form-control statusPemohon @error('statusPemohon') is-invalid @enderror" tabindex="1" required>
                                        <option selected value="Perorangan">Perorangan</option>
                                    </select>
                                    @endif

                                    @error('statusPemohon')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>
                                <div class="form-group">
                                    <label>Nama Pemohon</label>
                                    <input type="text" id="namaPemohon" name="namaPemohon" value="{{auth()->user()['fullname']}}" class="form-control @error('namaPemohon') is-invalid @enderror" required>
                                    @error('namaPemohon')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Pekerjaan Pemohon</label>
                                    <select id="pekerjaanPemohon" name="pekerjaanPemohon" required class="form-control pekerjaanPemohon @error('pekerjaanPemohon') is-invalid @enderror" tabindex="1" required>
                                        <option value="" selected>pilih status</option>
                                        <option value="PNS">PNS</option>
                                        <option value="TNI/Polri">TNI/Polri</option>
                                        <option value="Karyawan BUMN">Karyawan BUMN</option>
                                        <option value="Karyawan Swasta">Karyawan Swasta</option>
                                        <option value="Wiraswasta">Wiraswasta</option>
                                    </select>
                                    @error('pekerjaanPemohon')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Alamat Pemohon</label>
                                    <textarea name="alamatPemohon" class="form-control @error('alamatPemohon') is-invalid @enderror" tabindex="1" required placeholder="Alamat sesuai data KTP"></textarea>
                                    @error('alamatPemohon')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Nomor KTP</label>
                                    <input type="number" id="nomorKTP" name="nomorKTP" class="form-control @error('nomorKTP') is-invalid @enderror" tabindex="1" required>
                                    @error('nomorKTP')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Foto KTP</label>
                                    <input type="file" accept=".png,.jpg,.jpeg" id="fotoKTP" name="fotoKTP" class="form-control @error('fotoKTP') is-invalid @enderror" tabindex="1" required>
                                    @error('fotoKTP')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Foto KK</label>
                                    <input type="file" accept=".png,.jpg,.jpeg" id="fotoKK" name="fotoKK" class="form-control @error('fotoKK') is-invalid @enderror" tabindex="1" required>
                                    @error('fotoKK')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Nomor SHM</label>
                                    <input type="text" id="nomorSHM" name="nomorSHM" class="form-control @error('nomorSHM') is-invalid @enderror" tabindex="1" required>
                                    @error('nomorSHM')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Foto SHM</label>
                                    <input type="file" accept=".png,.jpg,.jpeg" id="fotoSHM" name="fotoSHM" class="form-control @error('fotoSHM') is-invalid @enderror" tabindex="1" required>
                                    @error('fotoSHM')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Kecamatan</label>
                                    <input type="text" id="kecamatan" name="kecamatan" class="form-control @error('kecamatan') is-invalid @enderror" tabindex="1" required>
                                    @error('kecamatan')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Desa</label>
                                    <input type="text" id="desa" name="desa" class="form-control @error('desa') is-invalid @enderror" tabindex="1" required>
                                    @error('desa')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group" id="formSuratKuasa" style="display: none">
                                    <label>Surat Kuasa</label>
                                    <input type="file" accept=".pdf" id="suratKuasa" name="suratKuasa" class="form-control @error('suratKuasa') is-invalid @enderror" tabindex="1">
                                    <p class="text-danger text-sm">*pdf</p>
                                    @error('suratKuasa')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Surat Permohonan</label>
                                    <input type="file" accept=".pdf" id="suratPermohonan" name="suratPermohonan" class="form-control @error('suratPermohonan') is-invalid @enderror" tabindex="1" required>
                                    <p class="text-danger text-sm">*pdf</p>
                                    @error('suratPermohonan')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Surat Hubungan Hukum</label>
                                    <input type="file" accept=".pdf" id="suratHubunganHukum" name="suratHubunganHukum" class="form-control @error('suratHubunganHukum') is-invalid @enderror" tabindex="1" required>
                                    <p class="text-danger text-sm">*pdf</p>
                                    @error('suratHubunganHukum')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <button class="btn btn-primary mr-1" type="submit">Submit</button>
                            </div>
                        </form>
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
    <script>

        $( ".statusPemohon" ).change(function() {
            let statusPemohon = document.getElementById("statusPemohon").value
            console.log(statusPemohon)
            if(statusPemohon=='Badan Hukum' || statusPemohon=='Penegak Hukum'){
               return document.getElementById("formSuratKuasa").style.display = 'block'
            }
            document.getElementById("formSuratKuasa").style.display = 'none'
        });
    </script>
@endsection
