@extends('layouts.default')
@section('title','BPN Kab.Kampar')
@section('siteName','BPN Kab.Kampar')
@section('_containerOfContents')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{asset('/assets/modules/ionicons/css/ionicons.min.css')}}">
    <script src="{{asset('/assets/js/pdfobject.min.js')}}"></script>
    <div class="main-content w-full">
        <section class="section">
            <div class="section-header">
                <h1>Detail Pengkajian Blokir</h1>
            </div>
            <div class="card card-warning">
                <div class="card-header">
                    <h3>Data Detail Pengajuan Pengkajian Blokir</h3>
                </div>
                <div class="card-body">
                    <table style="width:100%">
                        <tr>
                          <th style="width: 9rem">No. Tiket</th>
                          <td>:</td>
                          <td style="color: red">{{$blokir['tiket']}}</td>
                          {{-- <td style="color: red">{{$blokir->tiket}}</td> --}}
                        </tr>
                        <tr>
                          <th style="width: 9rem">Status Pemohon</th>
                          <td>:</td>
                          <td>{{$blokir['statusPemohon']}}</td>
                        </tr>
                        <tr>
                          <th style="width: 9rem">SHM</th>
                          <td>:</td>
                          <td>{{$blokir['nomorSHM']}}</td>
                        </tr>
                        <tr>
                          <th style="width: 9rem">Lokasi</th>
                          <td>:</td>
                          <td>{{$blokir['kecamatan']}}/{{$blokir['desa']}}</td>
                        </tr>
                        <tr>
                          <th style="width: 9rem">Google Maps</th>
                          <td>:</td>
                          <td><a target="_blank" href="{{$blokir['lokasi_SHM']}}">{{$blokir['lokasi_SHM']}}</a> </td>
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
                      @if ($blokir['statusPengkajian']=='Klarifikasi')
                      <div style="padding-top: 1rem">
                        <p style="color: red">&#8226; Silahkan Melakukan Pendaftaran di loket BPN Kampar</p>
                        <p style="color: red; margin-top:-20px;">&#8226; Bawa berkas fisik dokumen yang sudah di upload</p>
                        <p style="color: red; margin-top:-20px;">&#8226; Melakukan Pembayaran PNBP, dan Upload Bukti Pembayaran, <a href="#"><strong data-toggle="modal" data-target="#uploadBuktiBayar">Upload Bukti Bayar</strong></a></p>
                      </div>
                      @endif
                      @if ($blokir['statusPengkajian']=='Pengkajian Blokir')
                      <div style="padding-top: 1rem">
                        <p style="color: red">&#8226; Status Pengajuan Blokir Sudah Dalam Tahap Pengkajian Blokir</p>
                        <p style="color: red; margin-top:-20px;">&#8226; Anda Akan Mendapatkan Email Pemberitahuan Jika Tahap Pengkajian Blokir Selesai</p></div>
                      @endif
                      <div class="col-md-12 pt-4">
                        <div class="row" style="justify-content: space-between;">
                            <div><h4>Surat Hasil Kajian</h4></div>
                            <div>
                                <button data-toggle="modal" data-target="#suratHasilKajian" class="btn btn-sm btn-primary lihatHasilKajian">Lihat Hasil Kajian</button>
                            </div>
                        </div>
                      </div>
                      <div class="col-md-12 pt-4">
                        <div class="row" style="justify-content: space-between;">
                            <div><h4>Berkas Pendukung</h4></div>
                            <div>
                                @if ($blokir['statusPengkajian']=='Klarifikasi')
                                <button data-toggle="modal" data-target="#uploadBuktiBayar" class="btn btn-sm btn-warning">Upload Bukti Bayar</button>
                                @endif
                            </div>
                        </div>
                        @if ($blokir['statusPengkajian']=='Klarifikasi')
                        <div class="section-title mt-0">PNBP & Tiket</div>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <tbody>
                                    <th>Bukti Bayar PNBP</th>
                                    <th>{{$blokir['statusPNPB']}}</th>
                                    <td>
                                        <button data-toggle="modal" data-target="#lihatKTP" class="btn btn-sm btn-info">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </td>
                                    <td>
                                        @if ($blokir['statusPNPB']!='Valid')
                                        <button data-toggle="modal" data-target="#uploadBuktiBayar" data-idaction="" class="btn btn-sm btn-warning">Upload Bukti Bayar</button>
                                        @endif
                                    </td>
                                </tbody>
                            </table>
                        </div>
                        @endif
                        <div class="section-title mt-0">Status Validasi Berkas</div>
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
                                        @if ($blokir['status_KTP']!='Valid1')
                                        <button data-toggle="modal" data-target="#editKTP" data-idaction="" class="btn btn-sm btn-warning">Edit</button>
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
                                        @if ($blokir['status_KK']!='Valid1')
                                        <button data-toggle="modal" data-target="#editKK" data-idaction="" class="btn btn-sm btn-warning">Edit</button>
                                        @endif
                                    </td>
                                </tbody>
                                @if($blokir['fotoSHM']!=null || $blokir['fotoSHM']!='')
                                <tbody>
                                    <th>Photo SHM</th>
                                    <th>{{$blokir['status_SHM']}}</th>
                                    <td>
                                        <button data-toggle="modal" data-target="#lihatSHM" class="btn btn-sm btn-info">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </td>
                                    <td>
                                        @if ($blokir['status_SHM']!='Valid1')
                                        <button data-toggle="modal" data-target="#editSHM" data-idaction="" class="btn btn-sm btn-warning">Edit</button>
                                        @endif
                                    </td>
                                </tbody>
                                @endif

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
                                        @if ($blokir['status_suratKuasa']!='Valid1')
                                        <button data-toggle="modal" data-target="#editSuratKuasa" data-idaction="" class="btn btn-sm btn-warning">Edit</button>
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
                                        @if ($blokir['status_suratPermohonan']!='Valid1')
                                        <button data-toggle="modal" data-target="#editSuratPermohonan" data-idaction="" class="btn btn-sm btn-warning">Edit</button>
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
                                        @if ($blokir['status_suratHubunganHukum']!='Valid1')
                                        <button data-toggle="modal" data-target="#editSuratHubunganHukum" data-idaction="" class="btn btn-sm btn-warning">Edit</button>
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
    <div class="modal fade" id="uploadBuktiBayar" tabindex="-1" role="dialog" aria-labelledby="uploadBuktiBayar" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h5 class="modal-title text-white">Upload Bukti Bayar Dan No Tiket</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('apps.riwayatblokir.tiketLoket')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input name="id_blokir" hidden value="{{$blokir['id']}}">
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="float-left">Upload Bukti Bayar</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fas fa-boxes"></i>
                                    </div>
                                </div>
                                <input type="file" accept=".png,.jpg,.jpeg" name="buktiBayar" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="float-left">Tanggal Bayar PNBP</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fas fa-boxes"></i>
                                    </div>
                                </div>
                                <input type="date" name="tanggalBayar" id="date" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="float-left">No Tiket</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fas fa-boxes"></i>
                                    </div>
                                </div>
                                <input type="text" name="notiket" class="form-control" required>
                            </div>
                            <p style="color: red;">Masukan nomer tiket yang di dapatkan di pelayanan</p>
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
    <div class="modal fade" id="suratHasilKajian" tabindex="-1" role="dialog" aria-labelledby="suratHasilKajian" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <h5 class="modal-title text-white">Surat Hasil Kajian</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div id="lihatHasilKajian" class="modal-body">
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="editKTP" tabindex="-1" role="dialog" aria-labelledby="editKTP" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header bg-primary">
              <h5 class="modal-title text-white">Update KTP</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="{{route('apps.riwayatblokir.updatektp')}}" method="POST" enctype="multipart/form-data" >
                @csrf
                <input name="id_blokir" hidden value="{{$blokir['id']}}">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="float-left">KTP</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-boxes"></i>
                                </div>
                            </div>
                            <input type="file" accept=".png,.jpg,.jpeg" name="photoKTP" id="photoKTP" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="float-left">Nomor KTP</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                <i class="fas fa-envelope"></i>
                                </div>
                            </div>
                            <input type="number" name="nomorKTP" value="{{$blokir['nomorKTP']}}" id="nomorKTP" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
          </div>
        </div>
    </div>
    <div class="modal fade" id="editKK" tabindex="-1" role="dialog" aria-labelledby="editKK" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                <h5 class="modal-title text-white">Update KK</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <form action="{{route('apps.riwayatblokir.updatekk')}}" method="POST" enctype="multipart/form-data" >
                    @csrf
                    <input name="id_blokir" hidden value="{{$blokir['id']}}">
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="float-left">KK</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fas fa-boxes"></i>
                                    </div>
                                </div>
                                <input type="file" accept=".png,.jpg,.jpeg" name="photoKK" id="photoKK" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="editSHM" tabindex="-1" role="dialog" aria-labelledby="editSHM" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header bg-primary">
              <h5 class="modal-title text-white" id="editbarangLabel">Update SHM</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="{{route('apps.riwayatblokir.updateshm')}}" method="POST" enctype="multipart/form-data" >
                @csrf
                <input name="id_blokir" hidden value="{{$blokir['id']}}">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="float-left">SHM</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-boxes"></i>
                                </div>
                            </div>
                            <input type="file" accept=".png,.jpg,.jpeg" name="photoSHM" id="photoSHM" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
          </div>
        </div>
    </div>
    <div class="modal fade" id="editSuratKuasa" tabindex="-1" role="dialog" aria-labelledby="editSuratKuasa" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header bg-primary">
              <h5 class="modal-title text-white" id="editSuratKuasa">Update Surat Kuasa</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="{{route('apps.riwayatblokir.updatesuratkuasa')}}" method="POST" enctype="multipart/form-data" >
                @csrf
                <input name="id_blokir" hidden value="{{$blokir['id']}}">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="float-left">Surat Kuasa</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-boxes"></i>
                                </div>
                            </div>
                            <input type="file" accept=".pdf" name="suratKuasa" id="suratKuasa" class="form-control" required>
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
    <div class="modal fade" id="editSuratPermohonan" tabindex="-1" role="dialog" aria-labelledby="editSuratPermohonan" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
                <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="editbarangLabel">Update Surat Permohonan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <form action="{{route('apps.riwayatblokir.updatesuratpermohonan')}}" method="POST" enctype="multipart/form-data" >
                    @csrf
                    <input name="id_blokir" hidden value="{{$blokir['id']}}">
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="float-left">Surat Permohonan</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fas fa-boxes"></i>
                                    </div>
                                </div>
                                <input type="file" accept=".pdf" name="suratPermohonan" id="suratPermohonan" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
          </div>
        </div>
    </div>
    <div class="modal fade" id="editSuratHubunganHukum" tabindex="-1" role="dialog" aria-labelledby="editSuratHubunganHukum" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
                <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="editbarangLabel">Update Surat Hubungan Hukum</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <form action="{{route('apps.riwayatblokir.updatesurathubunganhukum')}}" method="POST" enctype="multipart/form-data" >
                    @csrf
                    <input name="id_blokir" hidden value="{{$blokir['id']}}">
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="float-left">Surat Hubungan Hukum</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fas fa-boxes"></i>
                                    </div>
                                </div>
                                <input type="file" accept=".pdf" name="suratHubunganHukum" id="suratHubunganHukum" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
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
    @if ($blokir['statusPengkajian']=='Selesai')
    <script>
        $(document).on("click", ".lihatHasilKajian", function () {
            var url = "<?php echo url($blokir['suratHasilKajian']); ?>"
            console.log(url)
            var options = {
                height: "200%",
                width: "100%",
                pdfOpenParams: {
                    pagemode: 'thumbs'
                }
            };
            PDFObject.embed(url, "#lihatHasilKajian",{height: "45rem"});
        });
    </script>
    @endif
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
    <script>
    </script>
@endsection
