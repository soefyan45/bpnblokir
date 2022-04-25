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
                <h1>Profile</h1>
            </div>
            <div class="card card-info">
                <div class="card-header" style="justify-content: space-between;">
                    <h3>Profile</h3>
                    <div class="card-header-action" style="display: flex">
                        <button data-toggle="modal" data-target="#gantiPassword" class="btn btn-warning mr-1">Ganti Password</button>
                        <button data-toggle="modal" data-target="#editProfile" class="btn btn-primary">Edit Profile</button>
                    </div>
                </div>
                <div class="card-body">
                    <table style="width:100%">
                        <tr>
                          <th style="width: 20rem">Nama</th>
                          <td>:</td>
                          <td>{{Auth::user()['fullname']}}</td>
                        </tr>
                        <tr>
                          <th style="width: 20rem">Email</th>
                          <td>:</td>
                          <td>{{Auth::user()['email']}}</td>
                        </tr>
                        <tr>
                          <th style="width: 20rem">Handphone/WA</th>
                          <td>:</td>
                          <td>{{Auth::user()['nowa']}}</td>
                        </tr>
                        <tr>
                          <th style="width: 20rem">Type Pemohon</th>
                          <td>:</td>
                          <td>{{Auth::user()['status_pemohon']}}</td>
                        </tr>
                        <tr>
                          <th style="width: 20rem">Hukum/Badan Hukum</th>
                          <td>:</td>
                          <td>{{Auth::user()['nama_hukum']}}</td>
                        </tr>
                        <tr>
                            <th style="width: 20rem">Dokumen</th>
                            <td>:</td>
                            <td>
                                <button data-toggle="modal" data-target="#lihatDokumen" class="btn btn-sm btn-info lihatDokumen" href="">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </section>
    </div>
    </div>
    <div class="modal fade" id="editProfile" tabindex="-1" role="dialog" aria-labelledby="editProfile" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header bg-warning">
              <h5 class="modal-title text-white">Edit Profile</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="{{route('apps.updateProfile')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label class="float-left">Email</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-boxes"></i>
                                </div>
                            </div>
                            <input name="email" value="{{Auth::user()['email']}}" id="email" class="form-control" disabled required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="float-left">No WA</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-boxes"></i>
                                </div>
                            </div>
                            <input name="nowa" value="{{Auth::user()['nowa']}}" id="nowa" class="form-control" disabled required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="float-left">Nama</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-boxes"></i>
                                </div>
                            </div>
                            <input name="name" value="{{Auth::user()['fullname']}}" id="name" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="float-left">Tipe Pemohon</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-boxes"></i>
                                </div>
                            </div>
                            <select name="tipePemohon" id="tipePemohon" class="form-control">
                                <option value="">Pilih Tipe</option>
                                <option selected value="{{Auth::user()['status_pemohon']}}">{{Auth::user()['status_pemohon']}}</option>
                                <option value="Perorangan">Perorangan</option>
                                <option value="Badan Hukum">Badan Hukum</option>
                                <option value="Penegak Hukum">Penegak Hukum</option>
                            </select>
                            {{-- <input name="name" id="name" class="form-control" required> --}}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="float-left">Nama Hukum/Badan Hukum</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-boxes"></i>
                                </div>
                            </div>
                            <input type="name" name="nama_hukum" id="nama_hukum" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="float-left">File Surat Hukum</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-boxes"></i>
                                </div>
                            </div>
                            <input type="file" accept=".pdf" name="surat_hukum" id="surat_hukum" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Update Profile</button>
                </div>
            </form>
          </div>
        </div>
    </div>
    <div class="modal fade" id="gantiPassword" tabindex="-1" role="dialog" aria-labelledby="gantiPassword" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header bg-danger">
              <h5 class="modal-title text-white">Ganti Password</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="{{route('apps.updatePassword')}}" method="POST" >
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label class="float-left">Password</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-boxes"></i>
                                </div>
                            </div>
                            <input type="password" name="password" id="password" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Update Password</button>
                </div>
            </form>
          </div>
        </div>
    </div>
    <div class="modal fade" id="lihatDokumen" tabindex="-1" role="dialog" aria-labelledby="lihatDokumen" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header bg-warning">
              <h5 class="modal-title text-white">Lihat Dokumen</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="{{route('officer.storePetugas')}}" method="POST" >
                @csrf
                <div id="frameSuratHukum" class="modal-body">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
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
    @if (Auth::user()['status_pemohon']!='Perorangan')
    <script>
        $(document).on("click", ".lihatDokumen", function () {
            var url = "<?php echo url(Auth::user()['surat_hukum']); ?>"
            console.log(url)
            var options = {
                height: "200%",
                width: "100%",
                pdfOpenParams: {
                    pagemode: 'thumbs'
                }
            };
            PDFObject.embed(url, "#frameSuratHukum",{height: "45rem"});
        });
    </script>
    @endif
@endsection
