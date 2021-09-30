
@extends('template.app')

@section('dash')
    Perhitungan
@endsection

@section('perhitungan')
    active
@endsection

@section('content')
    <div class="content mt-3">
        <div class="animated fadeIn">
            <div class="row">

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">Tabel Data Perhitungan</strong>
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
                            <a href="{{route('perhitungan.create')}}" class="btn btn-primary btn-sm"><i class="fa fa-cogs"></i>&nbsp; Inisialisasi</a>
                        </div>
                        <div class="card-body">
                            <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Maksimum Iterasi</th>
                                    <th>Maksimum Iterasi</th>
                                    <th>Error Terkecil</th>
                                    <th>Set</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($hasil as $key => $value)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$value->hasil_jumlah_cluster}}</td>
                                        <td>{{$value->hasil_iterasi}}</td>
                                        <td>{{number_format(abs($value->hasil_error_terkecil), 6, '.', '')}}</td>
                                        <td>
                                            <a href="{{route('perhitungan.show',$value->hasil_id)}}" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i> Lihat</a>
                                        </td>

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
