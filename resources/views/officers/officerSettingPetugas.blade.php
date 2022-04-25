@extends('layouts.default')
@section('title','BPN Kab.Kampar')
@section('siteName','Officer')
@section('_containerOfContents')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{asset('/assets/modules/ionicons/css/ionicons.min.css')}}">

    <div class="main-content w-full">
        <section class="section">
            <div class="section-header">
                <h1>Setting</h1>
            </div>
            @if($errors->any())
                {{ implode('', $errors->all('<div>:message</div>')) }}
            @endif
            <div class="card card-info">
                <div class="card-header" style="justify-content: space-between;">
                    <h3>Panel setting Petugas</h3>
                    <div class="card-header-action" style="display: flex">
                        <button data-toggle="modal" data-target="#tambahPetugas" class="btn btn-primary">Tambah Petugas</button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                              <tr>
                                <th style="background-color: #F6CA56;" scope="col">Email</th>
                                <th style="background-color: #003E69; color:white;" scope="col">Nama</th>
                                <th style="background-color: #003E69; color:white;" scope="col">Created At</th>
                                <th style="background-color: #4a7a9c;" scope="col"></th>
                              </tr>
                            </thead>
                            @foreach ($User as $user)
                                <tbody>
                                    <th scope="row">{{$user['email']}}</th>
                                    <th scope="row">{{$user['name']}}</th>
                                    <th scope="row">{{$user['created_at']}}</th>
                                    <th scope="row">
                                        <button data-toggle="modal" data-target="#editPetugas" data-idpetugas="{{$user['id']}}" data-name="{{$user['name']}}" data-email="{{$user['email']}}" data-nowa="{{$user['nowa']}}" class="btn btn-sm btn-warning">edit</button>
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
    <div class="modal fade" id="tambahPetugas" tabindex="-1" role="dialog" aria-labelledby="tambahPetugas" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header bg-warning">
              <h5 class="modal-title text-white">Buat Petugas</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="{{route('officer.storePetugas')}}" method="POST" >
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label class="float-left">Nama</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-boxes"></i>
                                </div>
                            </div>
                            <input name="name" id="name" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="float-left">Email</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-boxes"></i>
                                </div>
                            </div>
                            <input name="email" id="email" class="form-control" required>
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
                            <input name="nowa" id="nowa" class="form-control" required>
                        </div>
                    </div>
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
                    <button type="submit" class="btn btn-primary">Tambah Petugas</button>
                </div>
            </form>
          </div>
        </div>
    </div>
    <div class="modal fade" id="editPetugas" tabindex="-1" role="dialog" aria-labelledby="editPetugas" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header bg-danger">
              <h5 class="modal-title text-white">Edit Petugas</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="{{route('officer.updatePetugas')}}" method="POST" >
                @csrf
                <input id="idPetugas" class="form-control idpetugas" name="idPetugas" hidden>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="float-left">Nama</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-boxes"></i>
                                </div>
                            </div>
                            <input name="name" id="nameEdit" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="float-left">Email</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-boxes"></i>
                                </div>
                            </div>
                            <input name="email" id="emailEdit" readonly class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="float-left">No W</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-boxes"></i>
                                </div>
                            </div>
                            <input name="nowa" id="nowaEdit" readonly class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="float-left">Password</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-boxes"></i>
                                </div>
                            </div>
                            <input type="password" name="password" id="passwordEdit" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Update Petugas</button>
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
    <script>
        $('#editPetugas').on('show.bs.modal', function(e){
            let idPetugas = $(e.relatedTarget).data('idpetugas')
            let name = $(e.relatedTarget).data('name')
            let email = $(e.relatedTarget).data('email')
            let nowa = $(e.relatedTarget).data('nowa')
            document.getElementById("idPetugas").value = idPetugas;
            document.getElementById("nameEdit").value = name;
            document.getElementById("emailEdit").value = email;
            document.getElementById("nowaEdit").value = nowa;
            console.log(email)
        });
    </script>
@endsection
