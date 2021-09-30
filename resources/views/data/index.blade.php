@extends('template.app')

@section('dash')
    Data Master
@endsection

@section('data')
    active
@endsection

@section('content')
    <div class="content mt-3">
        <div class="animated fadeIn">
            <div class="row">

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">Tabel Data Master</strong>
                        </div>
                        @if($message = Session::get('success'))
                            <div class="alert alert-success" role="alert">
                                {{ $message }}
                            </div>
                        @elseif($message =  Session::get('error'))
                            <div class="alert alert-danger" role="alert">
                                {{ $message }}
                            </div>
                        @endif
                        <div class="card-body">
                            <button type="button" data-toggle="modal" data-target="#import" class="btn btn-primary"><i class="fa fa-upload"> Import Data</i></button>
                        </div>
                        <div class="card-body">
                            <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama Peserta</th>
                                    <th>NIK</th>
                                    <th>No HP</th>
                                    <th>Alamat</th>
                                    <th>Tempat Tinggal</th>
                                    <th>Jumlah Keluarga</th>
                                    <th>Pekerjaan</th>
                                    <th>Penghasilan Perbulan</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $value)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$value->data_nama}}</td>
                                    <td>{{$value->data_nik}}</td>
                                    <td>{{$value->data_hp}}</td>
                                    <td>{{$value->data_alamat}}</td>
                                    <td>{{$value->data_tinggal}}</td>
                                    <td>{{$value->data_jml_keluarga}}</td>
                                    <td>{{$value->data_pekerjaan}}</td>
                                    <td>{{$value->data_penghasilan}}</td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


            </div>
        </div><!-- .animated -->
    </div><!-- .content -->

    <!-- modal -->
    <div class="modal fade" id="import" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">IMPORT DATA</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('importExcel')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label>PILIH FILE</label>
                            <input type="file" name="file" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">TUTUP</button>
                        <button type="submit" class="btn btn-success">IMPORT</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
