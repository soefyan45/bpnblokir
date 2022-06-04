@extends('layouts.default')
@section('title','BPN Kab.Kampar')
@section('siteName','BPN Kab.Kampar')
@section('_containerOfContents')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{asset('/assets/modules/select2/dist/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('/assets/modules/ionicons/css/ionicons.min.css')}}">

    <div class="main-content w-full">
        <section class="section">
            <div class="section-header">
                <h1>Pengajuan Blokir Online</h1>
            </div>
            <div class="row">
                <div class="col-md-6 col-12 order-md-2">
                    <div class="card card-info">
                        <div class="card-header">
                            <h5>Profile</h5>
                        </div>
                        <div class="card-body">
                            <p>Jika anda <strong style="color: red;">Hukum/Badan Hukum</strong> Silahkan Update Profile, Di Menu <strong><a href="{{route('apps.profile')}}">Profile</a></strong> Untuk Menambahkan Detail</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-12 order-md-1">
                    <div class="card card-primay">
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
                                    <label>Lokasi Koordinat SHM</label>
                                    <input type="text" id="lokasiSHM" name="lokasiSHM" class="form-control @error('lokasiSHM') is-invalid @enderror" tabindex="1">
                                    <div class="row" style="justify-content: space-between;margin-left:2px;margin-right:2px;">
                                        <p class="text-danger">*optional</p>
                                        <a target="_blank" href="https://www.google.com/maps/">Buka Google Maps</a>
                                    </div>
                                    @error('lokasiSHM')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Foto SHM</label>
                                    <input type="file" accept=".png,.jpg,.jpeg" id="fotoSHM" name="fotoSHM" class="form-control @error('fotoSHM') is-invalid @enderror" tabindex="1">
                                    <p class="text-danger">*optional</p>
                                    @error('fotoSHM')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Kecamatan</label>
                                    <select class="form-control select2 kecamatan @error('kecamatan') is-invalid @enderror" name="kecamatan" id="kecamatan"  tabindex="-1" aria-hidden="true">
                                    </select>
                                    @error('kecamatan')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Desa</label>
                                    <select class="form-control select2 desa @error('desa') is-invalid @enderror" name="desa" id="desa" tabindex="-1" aria-hidden="true">
                                    </select>
                                    @error('desa')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                {{-- <div class="form-group">
                                    <label>Kecamatan</label>
                                    <input type="text" id="kecamatan" name="kecamatan" class="form-control @error('kecamatan') is-invalid @enderror" tabindex="1" required>
                                    @error('kecamatan')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div> --}}
                                {{-- <div class="form-group">
                                    <label>Desa</label>
                                    <input type="text" id="desa" name="desa" class="form-control @error('desa') is-invalid @enderror" tabindex="1" required>
                                    @error('desa')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div> --}}
                                <div class="form-group" id="formSuratKuasa">
                                    <label>Surat Kuasa</label>
                                    <input type="file" accept=".pdf" id="suratKuasa" name="suratKuasa" class="form-control @error('suratKuasa') is-invalid @enderror" tabindex="1">
                                    <p class="text-danger text-sm">*pdf *optional</p>
                                    @error('suratKuasa')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                {{-- <div class="form-group" id="formSuratKuasa" style="display: none">
                                    <label>Surat Kuasa</label>
                                    <input type="file" accept=".pdf" id="suratKuasa" name="suratKuasa" class="form-control @error('suratKuasa') is-invalid @enderror" tabindex="1">
                                    <p class="text-danger text-sm">*pdf</p>
                                    @error('suratKuasa')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div> --}}
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
    {{-- <script src="https://cdn.jsdelivr.net/gh/xcash/bootstrap-autocomplete@v2.3.7/dist/latest/bootstrap-autocomplete.min.js"></script> --}}
    <script src="{{asset('assets/modules/select2/dist/js/select2.full.min.js')}}"></script>
    <script>

        $( ".statusPemohon" ).change(function() {
            let statusPemohon = document.getElementById("statusPemohon").value
            console.log(statusPemohon)
            if(statusPemohon=='Badan Hukum' || statusPemohon=='Penegak Hukum'){
               return document.getElementById("formSuratKuasa").style.display = 'block'
            }
            document.getElementById("formSuratKuasa").style.display = 'none'
        });
        let Kecamatan = {
            'Bangkinang Kota' : [
                'Bangkinang',
                'Langgini',
                'Kumantan',
                'Ridan Permai',
            ],
            'Bangkinang':[
                'Pulau',
                'Pasir Sialang',
                'Muara Uwai',
                'Pulau Lawas',
                'Laboy Jaya',
                'Suka Mulya',
                'Bukit Payung',
                'Bukit Sembilang',
                'Binuang',
                'Sipungguk',
            ],
            'KUOK':[
                'Kuok',
                'Merangin',
                'Pulau Jambu',
                'Silam',
                'Bukit Melintang',
                'Empat Balai',
                'Lereng',
                'Pulau Terap',
                'Batu Langkah Kecil',
                'Sipungguk',
            ],
            'XIII KOTO KAMPAR' : [
                'Batu Bersurat',
                'Siberuang',
                'Pulau Gadang',
                'Tanjung Alai',
                'Ranah Sungkai',
                'Lubuk Agung',
                'Koto Mesjid',
                'Bandur Picak',
                'Pongkai Istoqomah',
                'Binamang',
                'Pongkai',
                'Muara Takus',
                'Balung',
                'Koto Tuo',
                'Gunung Bungsu',
                'Tanjung',
                'Gunung Malelo',
                'Tabing',
                'Koto Tuo Barat',
            ],
            'SALO' : [
                'Salo',
                'Salo Timur',
                'Ganting',
                'Ganting Damai',
                'Sipungguk',
                'Siabu',
                'III Koto Sibalimbing',
            ],
            'RUMBIO JAYA':[
                'Teratak',
                'Pulau Payung',
                'Alam Panjang',
                'Bukit kratai',
                'Batang Batindih',
                'Tambusai',
                'Simpang Petai',
            ],
            'PERHENTIAN RAJA':[
                'Pantai Raja',
                'Kampung Pinang',
                'Hangtuah',
                'Sialang Kubang',
                'Lubuk Sakat',
            ],
            'KAMPAR':[
                'Air Tiris',
                'Batu Belah',
                'Tanjung Berulak',
                'Ranah',
                'Penyasawan',
                'Rumbio',
                'Padang Mutung',
                'Pulau Jambu',
                'Tanjung Rambutan',
                'Simpang Kubu',
                'Limau Manis',
                'Naumbai',
                'Ranah Singkuang',
                'Pulau Tinggi',
                'Bukit Ranah',
                'Ranah Baru',
                'Pulau Sarak',
                'Tanah Abang',
                'Simpang Baru',
                'Teratak Rumbio',
                'Koto Tibun',
            ],
            'KAMPAR KIRI HILIR':[
                'Sungai Pagar',
                'Mentulik',
                'Sungai Simpang Dua',
                'Sungai Bungo',
                'Rantau Kasih',
                'Sungai petai',
                'Gading Permai',
                'Bangun Sari',
            ],
            'KAMPAR KIRI HULU':[
                'Gema',
                'Tanjung Belit',
                'Tanjung Belit Selatan',
                'Koto Lama',
                'Batu Sanggan',
                'Aur Kuning',
                'Ludai',
                'Tanjung Karang',
                'Batu Sasak',
                'Pangkalan Kapas',
                'Kebun Tinggi',
                'Tanjung Beringin',
                'Gajah Bertalut',
                'Danau Sontul',
                'Pangkalan Serai',
                'Dua Sepakat',
                'Terusan',
                'Deras Tajak',
                'Sungai Santi',
                'Subayang Jaya',
                'Tanjung Permai',
                'Bukit Betung',
                'Lubuk Bigau',
                'Muara Bio',
            ],
            'KAMPA':[
                'Kampar',
                'Pulau Birandang',
                'Pulau Birandang',
                'Pulau Rambai',
                'Koto Perambahan',
                'Sungai Putih',
                'Deli Makmur',
                'Sungai Tarap',
                'Tanjung Bungo',
                'Sawah Baru',
            ],
            'KAMPAR KIRI TENGAH':[
                'Simalinyang',
                'Penghidupan',
                'Mayang Pongkai',
                'Lubuk Sakai',
                'Hidup Baru',
                'Karya Bakti',
                'Koto Damai',
                'Utama Raya',
                'Bukit Sakai',
                'Mekar Jaya',
                'Bina Baru',
                'Utama Karya',
            ],
            'KAMPAR UTARA':[
                'Sawah',
                'Sungai Tonang',
                'Muara Jalai',
                'Kampung Panjang',
                'Kayu Aro',
                'Sungai Jalau',
                'Sendayan',
                'Naga Beralih',
            ],
            'KAMPAR KIRI':[
                'Lipat Kain',
                'Kuntu',
                'Padang Sawah',
                'Bina Baru',
                'IV Koto Setingkai',
                'Teluk Paman',
                'Sungai Geringging',
                'Sungai Paku',
                'Muara Selaya',
                'Sungai Rambai',
                'Tanjung Harapan',
                'Sungai Raja',
                'Sungai Sarik',
                'Lipat Kain Utara',
                'Lipat Kain Selatan',
                'Kuntu Darusalam',
                'Tanjung Mas',
                'Sungai Liti',
                'Teluk Paman Timur',
                'Sungai Harapan',
                'domo',
            ],
            'GUNUNG SAHILAN':[
                'Gunung Sahilan',
                'Kebun durian',
                'Subarak',
                'Gunung Sari',
                'Suka Makmur',
                'Makmur Sejahtera',
                'Sahilan Darusalam',
                'Gunung Mulya',
                'Sungai Lipai',
            ],
            'TAMBANG':[
                'Tambang',
                'Terantang',
                'Kemang Indah',
                'Sungai Pinang',
                'Aur Sati',
                'Padang Luas',
                'Kualu',
                'Rimbo Panjang',
                'Kualu Nenas',
                'Kuapan',
                'Gobah',
                'Teluk Kenidai',
                'Parit Baru',
                'Tarai Bangun',
                'Palung Raya',
                'Pulau Permai',
                'Balam Jaya',
            ],
            'SIAK HULU':[
                'Pangkalan Baru',
                'Desa Baru',
                'Teratak Buluh',
                'Lubuk Siam',
                'Buluh Cina',
                'Buluh Nipis',
                'Tanah Merah',
                'Pandau Jaya',
                'Tanjung Balam',
                'Kepau Jaya',
                'Pangkalan Serik',
                'Kubang Jaya',
                'Plamboyan',
                'Tanah Abang',
                'Simpang tiga',
                'Sidomulyo',
                'Kijang Jaya',
                'latersia',
                'simpang dua',
                'Gundaling',
            ],
            'TAPUNG':[
                'Petapahan',
                'Pantai Cermin',
                'Petapahan Jaya',
                'Mukti Sari',
                'Sei Putih',
                'Indra Sakti',
                'Gading Sari',
                'Sumber Makmur',
                'Pancuran Gading',
                'Sari Galuh',
                'Trimanunggal',
                'Air Terbit',
                'Tanjung Sawit',
                'Pagaruyung',
                'Sibuak',
                'Pelambaian',
                'Kenantan',
                'Indra Puri',
                'Sei Lambu Makmur',
                'Muara Mahat Baru',
                'Karya Indah',
                'Kijang Rejo',
                'Sungai Agung',
                'Bencah Kelubi',
                'Batu Gajah',
                'Pajajaran',
                'WonoSari',
                'Simarito',
                'Sekijang',
                'Sungai Garo',
                'Sungai Galuh',
                'Maja Pahit',
                'Simpang Dua',
                'Moyang Pongkai',
                'Sungai Pagar IV',
                'Sri Manunggal',
                'Kota Bangun',
                'Bina Baru',
                'Indra Pura',
                'Raharja',
                'Sibuak IV',
                'Hang Tuah',
                'Muara Mahat',
                'Si Pungguk',
                'Sumber Jaya',
                'Tebing Tinggi VI',
                'Kijang Jaya',
            ],
            'TAPUNG HILIR':[
                'Kota Garo',
                'Sekijang',
                'Beringin Lestari',
                'Kota Bangun',
                'Cinta Damai',
                'Suka Maju',
                'Kota Baru',
                'Tebing Lestari',
                'Tanah Tinggi',
                'Kijang Jaya',
                'Tapung Lestari',
                'Tapung Makmur',
                'Tandan Sari',
                'Gerbang Sari',
                'Kijang Makmur',
                'Koto Aman',
                'Kijang Rejo',
            ],
            'TAPUNG HULU':[
                'Senama Nenek',
                'Kasikan',
                'Danau Lancang',
                'Intan Jaya',
                'Tanah Datar',
                'Bukit Kemuning',
                'Rimba Beringin',
                'Muara Intan',
                'Rimba Makmur',
                'Rimba Jaya',
                'Suka Ramai',
                'Sumber Sari',
                'Kusau Makmur',
                'Talang Danto',
                'Prambanan',
            ],
            'KOTO KAMPAR HULU':[
                'Bandur Picak',
                'Sibiruang',
                'Pongkai',
                'Gunung Bungsu',
                'Tanjung',
                'Gunung Malelo',
                'Tabing',
            ],
        }
        let dataKecamatan = [
            '',
            'Bangkinang Kota',
            'Bangkinang',
            'KUOK',
            'XIII KOTO KAMPAR',
            'SALO' ,
            'RUMBIO JAYA',
            'PERHENTIAN RAJA',
            'KAMPAR',
            'KAMPAR KIRI HILIR',
            'KAMPAR KIRI HULU',
            'KAMPA',
            'KAMPAR KIRI TENGAH',
            'KAMPAR UTARA',
            'KAMPAR KIRI',
            'GUNUNG SAHILAN',
            'TAMBANG',
            'SIAK HULU',
            'TAPUNG',
            'TAPUNG HILIR',
            'TAPUNG HULU',
            'KOTO KAMPAR HULU'
        ]
        $('.kecamatan').select2({data:dataKecamatan});
        $('.kecamatan').change(function(){
            // console.log($('#kecamatan').val())
            if($('#kecamatan').val()==''){
                $("#desa").empty();
                return console.log('Kooosong')
            }
            let desa = Kecamatan[$('#kecamatan').val()]
            $('#desa').val(null).trigger('change');
            $("#desa").empty();
            $('.desa').select2({
                data:desa,
                allowClear : true,
                placeholder:'Pilih Kecamatan dulu'
            });

        });
    </script>
@endsection
