@extends('layouts.default')
@section('title','BPN Kab.Kampar')
@section('siteName','BPN Kab.Kampar')
@section('_containerOfContents')
<style>
    /* Content of modal div is center aligned */
    .modal {
        text-align: center;
    }
</style>
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{asset('/assets/modules/ionicons/css/ionicons.min.css')}}">

    <div class="main-content w-full">
        <section class="section">
            <div class="section-header">
                <h4>Tindakan Pengkajian Pengajuan Blokir</h4>

            </div>
            <div class="card card-warning">
                <div class="card-header" style="justify-content: space-between;">
                    <h3>Data Detail Pengajuan Pengkajian Blokir</h3>
                    <div class="card-header-action">
                        @if ($blokir['statusPengkajian']=='Pengkajian Blokir')
                        <button data-toggle="modal" data-target="#cetakHasilKajian" class="btn btn-info">Buat Surat Hasil Kajian</i></button>
                        @endif
                        @if ($blokir['statusPengkajian']=='Selesai')
                        <a target="_blank" href="{{route('officer.printHasilKajian',$blokir['id'])}}"  class="btn btn-info">Lihat Surat Hasil Kajian</i></a>
                        <button data-toggle="modal" data-target="#uploadHasilKajian"  class="btn btn-primary">Upload Hasil Kajian</i></a>
                        @endif
                    </div>
                </div>
                <div class="card-body">
                    <table style="width:100%">
                        <tr>
                          <th style="width: 9rem">No. Tiket</th>
                          <td>:</td>
                          <td style="color: red"><strong>{{$blokir['tiket']}}</strong></td>
                        </tr>
                        <tr>
                          <th style="width: 9rem">Status Pemohon</th>
                          <td>:</td>
                          <td>{{$blokir['statusPemohon']}}</td>
                        </tr>
                        <tr>
                          <th style="width: 9rem">Nama Pemohon</th>
                          <td>:</td>
                          <td>{{$blokir['namaPemohon']}}</td>
                        </tr>
                        <tr>
                          <th style="width: 9rem">Pekerjaan Pemohon</th>
                          <td>:</td>
                          <td>{{$blokir['pekerjaanPemohon']}}</td>
                        </tr>
                        <tr>
                          <th style="width: 9rem">Nomor KTP</th>
                          <td>:</td>
                          <td>{{$blokir['nomorKTP']}}</td>
                        </tr>
                        <tr>
                          <th style="width: 9rem">Nomor SHM</th>
                          <td>:</td>
                          <td>{{$blokir['nomorSHM']}}</td>
                        </tr>
                        <tr>
                          <th style="width: 9rem">Lokasi</th>
                          <td>:</td>
                          <td>{{$blokir['kecamatan']}}/{{$blokir['desa']}}</td>
                        </tr>
                        <tr>
                          <th style="width: 9rem">Status Pengkajian</th>
                          <td>:</td>
                          <td>
                              <strong style="color: red">{{$blokir['statusPengkajian']}}</strong>
                          </td>
                        </tr>
                        @if ($blokir['statusPengkajian']!='Verifikasi Dokumen')
                            <tr><th><hr></th></tr>
                            <tr>
                                <th style="width: 9rem">Nomor SHM</th>
                                <td>:</td>
                                <td>
                                    <strong style="color: red">{{$blokir['nomorSHM']}}</strong>
                                </td>
                            </tr>
                            <tr>
                                <th style="width: 9rem">Tanggal SHM</th>
                                <td>:</td>
                                <td>
                                    <strong>{{$blokir['tanggalSHM']}}</strong>
                                </td>
                            </tr>
                            <tr>
                                <th style="width: 9rem">Atas Nama SHM</th>
                                <td>:</td>
                                <td>
                                    {{$blokir['anSHM']}}
                                </td>
                            </tr>
                            <tr>
                                <th style="width: 9rem">SU Nomor</th>
                                <td>:</td>
                                <td>
                                    {{$blokir['SUnomor']}}
                                </td>
                            </tr>
                            <tr>
                                <th style="width: 9rem">Luas Tanah</th>
                                <td>:</td>
                                <td>
                                    {{$blokir['luasSHM']}}
                                </td>
                            </tr>
                        @endif
                    </table>
                    <div class="col-md-12 pt-4">
                        {{-- Start Kajian --}}
                        @if ($blokir['statusPengkajian']=='Pengkajian Blokir' || $blokir['statusPengkajian']=='Selesai')
                            <div class="row" style="justify-content: space-between;">
                                <div class="section-title mt-0">
                                    Hasil Kajian
                                </div>
                                <div>
                                    <a href="#" style="color: red"><strong data-toggle="modal" data-target="#tambahHasilKajian">+ Tambah Hasil Kajian</strong></a>
                                </div>
                            </div>
                            <div class="col-md-12">
                                {{-- {{$blokir['hasilKajian']}} --}}
                                {{-- @foreach ($blokir['hasilKajian'] as $hasilKajian)
                                    <p style="color: red">&#8226; {{$hasilKajian['keterangan']}}</p>
                                @endforeach --}}
                                @foreach ($blokir['hasilKajian']->groupBy('pointKajian') as $hasilKajian)
                                    @if ($hasilKajian[0]['pointKajian']=='Subjek/Pemohon')
                                        <strong>Subjek/Pemohon</strong>
                                        <div>
                                            @foreach ($hasilKajian as $kajian)
                                            <p style="color: red">&#8226; <i style="color: black;" class="far fa-edit"></i> {{$kajian['keterangan']}}</p>
                                            @endforeach
                                        </div>
                                    @endif
                                    @if ($hasilKajian[0]['pointKajian']=='Persyaratan Pengajuan Pencatatan Blokir')
                                        <strong>Persyaratan Pengajuan Pencatatan Blokir</strong>
                                        <div>
                                            @foreach ($hasilKajian as $kajian)
                                            <p style="color: red">&#8226; <i style="color: black;" class="far fa-edit"></i>{{$kajian['keterangan']}}</p>
                                            @endforeach
                                        </div>
                                    @endif
                                    @if ($hasilKajian[0]['pointKajian']=='Alasan Pencacatan Blokir')
                                        <strong>Alasan Pencacatan Blokir</strong>
                                        <div>
                                            @foreach ($hasilKajian as $kajian)
                                            <p style="color: red">&#8226; <i style="color: black;" class="far fa-edit"></i>{{$kajian['keterangan']}}</p>
                                            @endforeach
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                            <div class="row" style="justify-content: space-between;">
                                <div class="section-title mt-0">
                                    Keterangan Dokumen Yang Dilampirkan
                                </div>
                                <div>
                                    <a href="#" style="color: red"><strong data-toggle="modal" data-target="#tambahKeteranganDokumen">+ Tambah Keterangan</strong></a>
                                </div>
                            </div>
                            <div class="col-md-12">
                                @foreach ($blokir['noteDokumen'] as $dokumen)
                                    <p style="color: red">&#8226; <i style="color: black;" class="far fa-edit"></i>{{$dokumen['detail_dokumen']}}</p>
                                @endforeach
                            </div>
                        @endif
                        {{-- End Kajian --}}
                        <div class="row" style="justify-content: space-between;">
                            <div><h4>Berkas Pendukung</h4></div>
                            <div class="row" style="white-space: break-spaces;">
                                @if ($blokir['statusPengkajian']=='Verifikasi Dokumen' || $blokir['statusPengkajian']=='Dokumen di Tolak')
                                <button data-toggle="modal" data-target="#tindakan" class="btn btn-sm btn-warning float-right">Tindakan</button>
                                {{-- @if ($blokir['status_KTP']!='Valid' && $blokir['status_KK'] !='Valid' && $blokir['status_SHM'] !='Valid' && $blokir['status_suratKuasa'] !='Valid' && $blokir['status_suratPermohonan'] != 'Valid' && $blokir['status_suratHubunganHukum'] != 'Valid')
                                <button data-toggle="modal" data-target="#dokumenTidakLengkap" class="btn btn-sm btn-info float-right ml-2 mr-2">Dokumen Tidak Lengkap</button>
                                @endif --}}
                                <button data-toggle="modal" data-target="#dokumenTidakLengkap" class="btn btn-sm btn-info float-right ml-2 mr-2">Dokumen Tidak Lengkap</button>
                                @endif
                                @if ($blokir['statusPengkajian']=='Klarifikasi')
                                @endif

                            </div>
                        </div>
                        @if ($blokir['statusPengkajian']!='Verifikasi Dokumen' && $blokir['statusPengkajian']!='Dokumen di Tolak')
                        <div class="section-title mt-0">PNPB & Tiket</div>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <tbody>
                                    <th>Bukti Bayar PNPB</th>
                                    <th>{{$blokir['tanggalBayarPNPB']}}</th>
                                    <th>{{$blokir['statusPNPB']}}</th>
                                    <td>
                                        <button data-toggle="modal" data-target="#lihatPNPB" class="btn btn-sm btn-info">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </td>
                                    <td>
                                        @if ($blokir['tiketLoket']!=''||$blokir['tiketLoket']!=null)
                                        @if ($blokir['statusPNPB']!='Valid')
                                        <button data-toggle="modal" data-target="#konfirmasi" data-idaction="" class="btn btn-sm btn-primary">Konfirmasi</button>
                                        @endif
                                        @endif
                                    </td>
                                </tbody>
                            </table>
                        </div>
                        @endif
                        <div class="section-title mt-0">Cek Berkas</div>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <tbody>
                                    <th>Photo KTP No. {{$blokir['nomorKTP']}}</th>
                                    <th>{{$blokir['status_KTP']}}</th>
                                    <td>
                                        <button data-toggle="modal" data-target="#lihatKTP" class="btn btn-sm btn-info">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </td>
                                    <td>
                                        @if ($blokir['status_KTP']!='Valid')
                                        <button data-toggle="modal" data-target="#actionKTP" data-idaction="" class="btn btn-sm btn-primary">Action</button>
                                        @endif
                                    </td>
                                </tbody>
                                <tbody>
                                    <th>Photo KK</th>
                                    <th>{{$blokir['status_KK']}}</th>
                                    <td>
                                        <button data-toggle="modal" data-target="#lihatKK" class="btn btn-sm btn-info">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </td>
                                    <td>
                                        @if ($blokir['status_KK']!='Valid')
                                        <button data-toggle="modal" data-target="#actionKK" data-idaction="" class="btn btn-sm btn-primary">Action</button>
                                        @endif
                                    </td>
                                </tbody>
                                <tbody>
                                    <th>Photo SHM</th>
                                    <th>{{$blokir['status_SHM']}}</th>
                                    <td>
                                        <button data-toggle="modal" data-target="#lihatSHM" class="btn btn-sm btn-info">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </td>
                                    <td>
                                        @if ($blokir['status_SHM']!='Valid')
                                        <button data-toggle="modal" data-target="#actionSHM" data-idaction="" class="btn btn-sm btn-primary">Action</button>
                                        @endif
                                    </td>
                                </tbody>
                                @if ($blokir['suratKuasa']!=null || $blokir['suratKuasa']!='')
                                <tbody>
                                    <th>Surat Kuasa</th>
                                    <th>{{$blokir['status_suratKuasa']}}</th>
                                    <td>
                                        <button data-toggle="modal" data-target="#lihatSuratKuasa" data-urlSuratKuasa="{{ $blokir['suratKuasa'] }}" class="btn btn-sm btn-info lihatSuratKuasa">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </td>
                                    <td>
                                        @if ($blokir['status_suratKuasa']!='Valid')
                                        <button data-toggle="modal" data-target="#actionSuratKuasa" data-idaction="" class="btn btn-sm btn-primary">Action</button>
                                        @endif
                                    </td>
                                </tbody>
                                @endif
                                <tbody>
                                    <th>Surat Permohonan</th>
                                    <th>{{$blokir['status_suratPermohonan']}}</th>
                                    <td>
                                        <button data-toggle="modal" data-target="#lihatSuratPermohonan" class="btn btn-sm btn-info lihatSuratPermohonan">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </td>
                                    <td>
                                        @if ($blokir['status_suratPermohonan']!='Valid')
                                        <button data-toggle="modal" data-target="#actionSuratPermohonan" data-idaction="" class="btn btn-sm btn-primary">Action</button>
                                        @endif
                                    </td>
                                </tbody>
                                <tbody>
                                    <th>Surat Hubungan Hukum</th>
                                    <th>{{$blokir['status_suratHubunganHukum']}}</th>
                                    <td>
                                        <button data-toggle="modal" data-target="#lihatSuratHubunganHukum" class="btn btn-sm btn-info lihatSuratHubunganHukum">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </td>
                                    <td>
                                        @if ($blokir['status_suratHubunganHukum']!='Valid')
                                        <button data-toggle="modal" data-target="#actionSuratHubunganHukum" data-idaction="" class="btn btn-sm btn-primary">Action</button>
                                        @endif
                                    </td>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    </div>
    <div class="modal fade" id="tindakan" tabindex="-1" role="dialog" aria-labelledby="tindakan" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header bg-warning">
              <h5 class="modal-title text-white">Tindakan Permohonan Pengkajian Blokir</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="{{route('officer.klarifikasiDokumenBlokir')}}" method="POST" >
                @csrf
                <div class="modal-body">
                    <p style="text-align: justify;">Dengan melakukan tindakan ini pemohon akan di <strong style="color: red;">intruksikan untuk melakukan pendaftaran ke loket pelayanan BPN Kab. Kampar</strong> dengan membawa berkas fisik yang sudah di upload di aplikasi. <strong style="color: red;">Dan melakukan pembayaran PNPB</strong></strong></p>
                    <div class="form-group">
                        <label class="float-left">Tindakan</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-boxes"></i>
                                </div>
                            </div>
                            <input name="id_blokir" hidden value="{{$blokir['id']}}">
                            <select name="statusPengajuan" class="form-control" required>
                                <option value="">pilih tindakan pengajuan</option>
                                <option value="Klarifikasi">Klarifikasi Dokumen</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="float-left">Atas Nama SHM</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-boxes"></i>
                                </div>
                            </div>
                            <input name="anSHM" value="{{$blokir['namaPemohon']}}" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="float-left">Tanggal SHM</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-boxes"></i>
                                </div>
                            </div>
                            <input type="date" name="tanggalSHM" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="float-left">Luas SHM</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-boxes"></i>
                                </div>
                            </div>
                            <input name="luasSHM" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="float-left">SU Nomor</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-boxes"></i>
                                </div>
                            </div>
                            <input name="suNomor" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Proses</button>
                </div>
            </form>
          </div>
        </div>
    </div>
    <div class="modal fade" id="dokumenTidakLengkap" tabindex="-1" role="dialog" aria-labelledby="dokumenTidakLengkap" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header bg-warning">
              <h5 class="modal-title text-white">Dokument Yang Dikirim Pemohon Tidak Valid</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="{{route('officer.dokumenTidakValid')}}" method="POST" >
                @csrf
                <input name="id_blokir" hidden value="{{$blokir['id']}}">
                <div class="modal-body">
                    <p style="text-align: justify;">Dengan melakukan tindakan ini pemohon akan di <strong style="color: red;">intruksikan untuk melakukan berkas dokumen yang tidak valid</strong></p>
                    <div class="form-group">
                        <label class="float-left">Email</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-boxes"></i>
                                </div>
                            </div>
                            <input name="email" value="{{$blokir['user']['email']}}" class="form-control" readonly required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Proses & Kirim Email</button>
                </div>
            </form>
          </div>
        </div>
    </div>
    <div class="modal fade" id="uploadHasilKajian" tabindex="-1" role="dialog" aria-labelledby="uploadHasilKajian" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header bg-info">
              <h5 class="modal-title text-white">Upload Hasil Kajian Bertanda tangan</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="{{route('officer.uploadHasilKajian')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <input name="id_blokir" hidden value="{{$blokir['id']}}">
                <div class="modal-body">
                    <p style="text-align: justify;">Upload Surat Hasil Kajian</p>
                    <p style="text-align: justify;color:red;">Pastikan Surat Sudah Di Tandatangin oleh Pejabat Terkait</p>
                    <div class="form-group">
                        <label class="float-left">Surat Hasil Kajian</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-boxes"></i>
                                </div>
                            </div>
                            <input type="file" name="suratKajian" id="suratKajian" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Upload</button>
                </div>
            </form>
          </div>
        </div>
    </div>
    <div class="modal fade" id="cetakHasilKajian" tabindex="-1" role="dialog" aria-labelledby="cetakHasilKajian" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header bg-info">
              <h5 class="modal-title text-white">Buat Hasil Kajian</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="{{route('officer.generateHasilKajian')}}" method="POST" >
                @csrf
                <input name="id_blokir" hidden value="{{$blokir['id']}}">
                <div class="modal-body">
                    <p style="text-align: justify;">Buat Hasil Kajian</p>
                    <div class="form-group">
                        <label class="float-left">Nota Dinas</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-boxes"></i>
                                </div>
                            </div>
                            <input name="nomor_notaDinas" id="nomor_notaDinas" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="float-left">Tanggal Nota Dinas</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-boxes"></i>
                                </div>
                            </div>
                            <input type="date" name="tanggal_notaDinas" id="tanggal_notaDinas" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Generate</button>
                </div>
            </form>
          </div>
        </div>
    </div>
    <div class="modal fade" id="tambahHasilKajian" tabindex="-1" role="dialog" aria-labelledby="tambahHasilKajian" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header bg-info">
              <h5 class="modal-title text-white">Hasil Kajian Pengajuan Blokir</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="{{route('officer.hasilKajian')}}" method="POST" >
                @csrf
                <input name="id_blokir" hidden value="{{$blokir['id']}}">
                <div class="modal-body">
                    <p style="text-align: justify;">Hasil kajian untuk pengajuan blokir</p>
                    <div class="form-group">
                        <label class="float-left">Point</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-boxes"></i>
                                </div>
                            </div>
                            <select name="pointHasilKajian" class="form-control" required>
                                <option value=""></option>
                                <option value="Subjek/Pemohon">Subjek/Pemohon</option>
                                <option value="Persyaratan Pengajuan Pencatatan Blokir">Persyaratan Pengajuan Pencatatan Blokir</option>
                                <option value="Alasan Pencacatan Blokir">Alasan Pencacatan Blokir</option>
                                <option value="Alasan Pencacatan Blokir">Pengkajian Blokir</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="float-left">Deskripsi</label>
                        <div class="input-group">
                            <textarea name="deskripsiHasilKajian" class="form-control"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Proses</button>
                </div>
            </form>
          </div>
        </div>
    </div>
    <div class="modal fade" id="tambahKeteranganDokumen" tabindex="-1" role="dialog" aria-labelledby="tambahKeteranganDokumen" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header bg-info">
              <h5 class="modal-title text-white">Menambahkan Keterangan Dokumen</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="{{route('officer.keteranganDokumen')}}" method="POST" >
                @csrf
                <input name="id_blokir" hidden value="{{$blokir['id']}}">
                <div class="modal-body">
                    <p style="text-align: justify;">Keterangan Dokumen untuk di tampilkan di dalam surat Analisa</p>
                    <div class="form-group">
                        <label class="float-left">Keterangan Dokumen</label>
                        <div class="input-group">
                            <textarea name="keteranganDokumen" class="form-control"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Proses</button>
                </div>
            </form>
          </div>
        </div>
    </div>
    <div class="modal fade" id="konfirmasi" tabindex="-1" role="dialog" aria-labelledby="konfirmasi" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header bg-info">
              <h5 class="modal-title text-white">Konfirmasi Pembayaran PNPB & Loket</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="{{route('officer.cekPNPB')}}" method="POST" >
                @csrf
                <div class="modal-body">
                    <p style="text-align: justify;">Dengan melakukan tindakan ini petugas mengkonfirmasi pemohon sudah open tiket dan melakukan pembayaran PNPB, dan Petugas melanjutkan pengkajian blokir</p>
                    <div class="form-group">
                        <label class="float-left">No Tiket Yang Di Input Pemohon</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-boxes"></i>
                                </div>
                            </div>
                            <input disabled class="form-control" value="{{$blokir['tiketLoket']}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="float-left">Konfirmasi</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-boxes"></i>
                                </div>
                            </div>
                            <input name="id_blokir" hidden value="{{$blokir['id']}}">
                            <select name="konfirmasiPNPB" class="form-control" required>
                                <option value=""></option>
                                <option value="Valid">Valid</option>
                                <option value="Tidak Valid">Tidak Valid</option>
                            </select>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Proses</button>
                </div>
            </form>
          </div>
        </div>
    </div>
    <div class="modal fade" id="actionKTP" tabindex="-1" role="dialog" aria-labelledby="actionKTP" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header bg-primary">
              <h5 class="modal-title text-white">Tindakan KTP</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="{{route('officer.berkasKTP')}}" method="POST" >
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label class="float-left">Tindakan</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-boxes"></i>
                                </div>
                            </div>
                            <input name="id_blokir" hidden value="{{$blokir['id']}}">
                            <select name="statusKTP" class="form-control" required>
                                <option value="">pilih tindakan ktp</option>
                                <option value="Dokumen di Tolak">Dokumen di Tolak</option>
                                <option value="Valid">Valid</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="float-left">Keterangan</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                <i class="fas fa-envelope"></i>
                                </div>
                            </div>
                            <select name="keterangan" class="form-control">
                                <option value="">pilih keterangan</option>
                                <option value="File Tidak Jelas">File Tidak Jelas</option>
                                <option value="File Salah">File Salah</option>
                                <option value="Valid">Valid</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Proses</button>
                </div>
            </form>
          </div>
        </div>
    </div>
    <div class="modal fade" id="actionKK" tabindex="-1" role="dialog" aria-labelledby="actionKK" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                <h5 class="modal-title text-white">Tindakan KK</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <form action="{{route('officer.berkasKK')}}" method="POST" >
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="float-left">Tindakan</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fas fa-boxes"></i>
                                    </div>
                                </div>
                                <input name="id_blokir" hidden value="{{$blokir['id']}}">
                                <select name="statusKK" class="form-control" required>
                                    <option value="">pilih tindakan kk</option>
                                    <option value="Dokumen di Tolak">Dokumen di Tolak</option>
                                    <option value="Valid">Valid</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="float-left">Keterangan</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                    <i class="fas fa-envelope"></i>
                                    </div>
                                </div>
                                <select name="keterangan" class="form-control">
                                    <option value="">pilih keterangan</option>
                                    <option value="File Tidak Jelas">File Tidak Jelas</option>
                                    <option value="File Salah">File Salah</option>
                                    <option value="Valid">Valid</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Proses</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="actionSHM" tabindex="-1" role="dialog" aria-labelledby="actionSHM" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header bg-primary">
              <h5 class="modal-title text-white" id="editbarangLabel">Tindakan SHM</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="{{route('officer.berkasSHM')}}" method="POST" >
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label class="float-left">Tindakan</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-boxes"></i>
                                </div>
                            </div>
                            <input name="id_blokir" hidden value="{{$blokir['id']}}">
                            <select name="statusSHM" class="form-control" required>
                                <option value="">pilih tindakan shm</option>
                                <option value="Dokumen di Tolak">Dokumen di Tolak</option>
                                <option value="Valid">Valid</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="float-left">Keterangan</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                <i class="fas fa-envelope"></i>
                                </div>
                            </div>
                            <select name="keterangan" class="form-control">
                                <option value="">pilih keterangan</option>
                                <option value="File Tidak Jelas">File Tidak Jelas</option>
                                <option value="File Salah">File Salah</option>
                                <option value="Valid">Valid</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
          </div>
        </div>
    </div>
    <div class="modal fade" id="actionSuratKuasa" tabindex="-1" role="dialog" aria-labelledby="actionSuratKuasa" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header bg-primary">
              <h5 class="modal-title text-white" id="editbarangLabel">Tindakan Surat Kuasa</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="{{route('officer.berkasSuratKuasa')}}" method="POST" >
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label class="float-left">Tindakan</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-boxes"></i>
                                </div>
                            </div>
                            <input name="id_blokir" hidden value="{{$blokir['id']}}">
                            <select name="statusSuratKuasa" class="form-control" required>
                                <option value="">pilih tindakan surat kuasa</option>
                                <option value="Dokumen di Tolak">Dokumen di Tolak</option>
                                <option value="Valid">Valid</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="float-left">Keterangan</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                <i class="fas fa-envelope"></i>
                                </div>
                            </div>
                            <select name="keterangan" class="form-control">
                                <option value="">pilih keterangan</option>
                                <option value="File Tidak Jelas">File Tidak Jelas</option>
                                <option value="File Salah">File Salah</option>
                                <option value="Valid">Valid</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
          </div>
        </div>
    </div>
    <div class="modal fade" id="actionSuratPermohonan" tabindex="-1" role="dialog" aria-labelledby="actionSuratPermohonan" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
                <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="editbarangLabel">Tindakan Surat Permohonan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <form action="{{route('officer.berkasSuratPermohonan')}}" method="POST" >
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="float-left">Tindakan</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fas fa-boxes"></i>
                                    </div>
                                </div>
                                <input name="id_blokir" hidden value="{{$blokir['id']}}">
                                <select name="statusSuratPermohonan" class="form-control" required>
                                    <option value="">pilih tindakan surat permohonan</option>
                                    <option value="Dokumen di Tolak">Dokumen di Tolak</option>
                                    <option value="Valid">Valid</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="float-left">Keterangan</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                    <i class="fas fa-envelope"></i>
                                    </div>
                                </div>
                                <select name="keterangan" class="form-control">
                                    <option value="">pilih keterangan</option>
                                    <option value="File Tidak Jelas">File Tidak Jelas</option>
                                    <option value="File Salah">File Salah</option>
                                    <option value="Valid">Valid</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
          </div>
        </div>
    </div>
    <div class="modal fade" id="actionSuratHubunganHukum" tabindex="-1" role="dialog" aria-labelledby="actionSuratHubunganHukum" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
                <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="editbarangLabel">Tindakan Surat Hubungan Hukum</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <form action="{{route('officer.berkasSuratHubunganHukum')}}" method="POST" >
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="float-left">Tindakan</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fas fa-boxes"></i>
                                    </div>
                                </div>
                                <input name="id_blokir" hidden value="{{$blokir['id']}}">
                                <select name="statusSuratHubunganHukum" class="form-control" required>
                                    <option value="">pilih tindakan surat hubungan hukum</option>
                                    <option value="Dokumen di Tolak">Dokumen di Tolak</option>
                                    <option value="Valid">Valid</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="float-left">Keterangan</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                    <i class="fas fa-envelope"></i>
                                    </div>
                                </div>
                                <select name="keterangan" class="form-control">
                                    <option value="">pilih keterangan</option>
                                    <option value="File Tidak Jelas">File Tidak Jelas</option>
                                    <option value="File Salah">File Salah</option>
                                    <option value="Valid">Valid</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
          </div>
        </div>
    </div>
    <div class="modal fade" id="lihatPNPB" tabindex="-1" role="dialog" aria-labelledby="lihatPNPB" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
                <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="editbarangLabel">Lihat PNPB</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>

                <div class="modal-body">
                    @if ($blokir['tiketLoket']==''||$blokir['tiketLoket']==null)
                    <p>Pemohon Belum Input Data</p>
                    @endif
                    @if ($blokir['tiketLoket']!=''||$blokir['tiketLoket']!=null)
                    <img style="width:100%;max-width:512px" src="{{URL::to('/')}}/{{$blokir['fotoPNPB']}}">
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>

                </div>
          </div>
        </div>
    </div>
    <div class="modal fade" id="lihatKTP" tabindex="-1" role="dialog" aria-labelledby="lihatKTP" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
                <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="editbarangLabel">Lihat KTP</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <img style="width:100%;max-width:512px" src="{{URL::to('/')}}/{{$blokir['fotoKTP']}}">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
          </div>
        </div>
    </div>
    <div class="modal fade" id="lihatKK" tabindex="-1" role="dialog" aria-labelledby="lihatKK" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
                <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="editbarangLabel">Lihat KK</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <img style="width:100%;max-width:512px" src="{{URL::to('/')}}/{{$blokir['fotoKK']}}">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
          </div>
        </div>
    </div>
    <div class="modal fade" id="lihatSHM" tabindex="-1" role="dialog" aria-labelledby="lihatSHM" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
                <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="editbarangLabel">Lihat SHM</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <img style="width:100%;max-width:512px" src="{{URL::to('/')}}/{{$blokir['fotoSHM']}}">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
          </div>
        </div>
    </div>
    <div class="modal fade" id="lihatSuratKuasa" tabindex="-1" role="dialog" aria-labelledby="lihatSuratKuasa" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
          <div class="modal-content">
                <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="editbarangLabel">Lihat Surat Kuasa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div id="frameSuratKuasa" class="modal-body">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
          </div>
        </div>
    </div>
    <div class="modal fade" id="lihatSuratPermohonan" tabindex="-1" role="dialog" aria-labelledby="lihatSuratPermohonan" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
          <div class="modal-content">
                <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="editbarangLabel">Lihat Surat Permohonan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div id="frameSuratPermohonan" class="modal-body">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
          </div>
        </div>
    </div>
    <div class="modal fade" id="lihatSuratHubunganHukum" tabindex="-1" role="dialog" aria-labelledby="lihatSuratHubunganHukum" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
          <div class="modal-content">
                <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="editbarangLabel">Lihat Surat Permohonan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div id="frameSuratHubunganHukum" class="modal-body">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
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
    <script src="{{asset('/assets/js/pdfobject.min.js')}}"></script>
    @if ($blokir['suratKuasa']!=null || $blokir['suratKuasa']!='')
    <script>
        $(document).on("click", ".lihatSuratKuasa", function () {
            var url = "<?php echo url($blokir['suratKuasa']); ?>"
            console.log(url)
            var options = {
                height: "200%",
                width: "100%",
                pdfOpenParams: {
                    pagemode: 'thumbs'
                }
            };
            PDFObject.embed(url, "#frameSuratKuasa",{height: "45rem"});
        });
    </script>
    @endif
    <script>
        $(document).on("click", ".lihatSuratPermohonan", function () {
            // var url = {{$blokir['suratPermohonan']}}
            var url = "<?php echo url($blokir['suratPermohonan']); ?>"
            console.log(url)
            var options = {
                height: "200%",
                width: "100%",
                pdfOpenParams: {
                    pagemode: 'thumbs'
                }
            };
            PDFObject.embed(url, "#frameSuratPermohonan",{height: "45rem"});
        });
    </script>
    <script>
        $(document).on("click", ".lihatSuratHubunganHukum", function () {
            // var url = {{$blokir['suratPermohonan']}}
            var url = "<?php echo url($blokir['suratHubunganHukum']); ?>"
            console.log(url)
            var options = {
                height: "200%",
                width: "100%",
                pdfOpenParams: {
                    pagemode: 'thumbs'
                }
            };
            PDFObject.embed(url, "#frameSuratHubunganHukum",{height: "45rem"});
        });
    </script>
@endsection
