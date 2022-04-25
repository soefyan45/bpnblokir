@extends('layouts.default')
@section('title','BPN Kab.Kampar')
@section('siteName','Officer')
@section('_containerOfContents')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{asset('/assets/modules/ionicons/css/ionicons.min.css')}}">
    <script src="{{asset('/assets/js/pdfobject.min.js')}}"></script>
    <div class="main-content w-full">
        <section class="section">
            <div class="section-header">
                <h1>Data Pemohon</h1>
            </div>
            <div class="card card-info">
                <div class="card-header">
                    <h3>List Data Pemohon</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                              <tr>
                                <th style="background-color: #F6CA56;" scope="col">Email</th>
                                <th style="background-color: #003E69; color:white;" scope="col">Nama</th>
                                <th style="background-color: #003E69; color:white;" scope="col">Type Pemohon</th>
                                <th style="background-color: #003E69; color:white;" scope="col">Hukum/Badan Hukum</th>
                                <th style="background-color: #003E69; color:white;" scope="col">Status Hukum</th>
                                <th style="background-color: #003E69; color:white;" scope="col">Dokumen</th>
                                <th style="background-color: #003E69; color:white;" scope="col">Created At</th>
                                <th style="background-color: #4a7a9c;" scope="col"></th>
                              </tr>
                            </thead>
                            @foreach ($User as $user)
                                <tbody>
                                    <th scope="row">{{$user['email']}}</th>
                                    <th scope="row">{{$user['name']}}</th>
                                    <th scope="row">{{$user['status_pemohon']}}</th>
                                    <th scope="row">{{$user['nama_hukum']}}</th>
                                    <th scope="row">{{$user['valid_nama_hukum']}}</th>
                                    @if($user['status_pemohon']!='Perorangan')
                                        <th scope="row">
                                            <button data-toggle="modal" data-target="#lihatDokumen" data-urlsurat="{{$user['surat_hukum']}}" class="btn btn-sm btn-info showDokumen" href="">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </th>
                                    @endif
                                    @if($user['status_pemohon']=='Perorangan')
                                        <th scope="row"><strong style="color:red;">-</strong></th>
                                    @endif
                                    <th scope="row">{{$user['created_at']}}</th>
                                    <th scope="row">
                                        <button data-toggle="modal" data-target="#actionPemohon" data-idpemohon="{{$user['id']}}" data-name="{{$user['name']}}" data-email="{{$user['email']}}" data-nowa="{{$user['nowa']}}" class="btn btn-sm btn-warning">Action</button>
                                    </th>
                                </tbody>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>
    </div>
    <div class="modal fade" id="actionPemohon" tabindex="-1" role="dialog" aria-labelledby="actionPemohon" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header bg-warning">
              <h5 class="modal-title text-white">Tindakan Status Hukum</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="{{route('officer.updatevalidhukum')}}" method="POST" >
                @csrf
                <div class="modal-body">
                    <strong style="color: red;">Pastikan anda sudah melihat dokumen hukum yang di upload oleh pemohon !!!</strong>
                    <div class="form-group">
                        <label class="float-left">Status Hukum/Badan Hukum</label>
                        <input id="idPemohon" name="idPemohon" class="form-control" hidden>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-boxes"></i>
                                </div>
                            </div>
                            <select name="status_hukum" class="form-control">
                                <option selected value="">Silahkan Pilih</option>
                                <option value="true">True</option>
                                <option value="false">False</option>
                            </select>
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
    <div class="modal fade" id="lihatDokumen" tabindex="-1" role="dialog" aria-labelledby="lihatDokumen" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header bg-primary">
              <h5 class="modal-title text-white">Lihat Dokumen</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body" style="display: none" id="lihatDokumenHukum">
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
    <script>
        $('#actionPemohon').on('show.bs.modal', function(e){
            document.getElementById("idPemohon").value = $(e.relatedTarget).data('idpemohon')
        });
        $('#lihatDokumen').on('show.bs.modal', function(e){
            let suratUrl = $(e.relatedTarget).data('urlsurat')
            if(suratUrl!=false){
                document.getElementById("lihatDokumenHukum").style.display = 'block';
            }
            if(suratUrl==false){
                document.getElementById("lihatDokumenHukum").style.display = 'none';
            }
            var url = suratUrl
            var options = {
                height: "200%",
                width: "100%",
                pdfOpenParams: {
                    pagemode: 'thumbs'
                }
            };
            PDFObject.embed(url, "#lihatDokumenHukum",{height: "45rem"});
        });
    </script>
    <script>

    </script>
@endsection
