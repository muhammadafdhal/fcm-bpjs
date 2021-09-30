@extends('template.app')

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
                            <strong class="card-title">Fungsi Objektif & Nilai Error</strong>
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

                        @if($uji == null)
                        <div class="card-body">
                            <a href="{{route('uji', $hasil->hasil_id)}}" class="btn btn-primary btn-sm"><i class="fa fa-star"></i>&nbsp; Pengujian</a>
                        </div>

                        @else
                            <div class="card-body">
                                <a href="{{route('show', $hasil->hasil_id)}}" class="btn btn-primary btn-sm"><i class="fa fa-star"></i>&nbsp;Lihat Pengujian</a>
                            </div>
                        @endif
                        <div class="card-body">
                            <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>Iterasi</th>
                                    <th>Fungsi Objektif</th>
                                    <th>Error</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $hasilFungsiObjektif = json_decode($hasil->hasil_fungsi_objektif);
                                    $hasilError = json_decode($hasil->hasil_error);
                                @endphp
                                @foreach($hasilFungsiObjektif as $key=>$value)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$value}}</td>
                                        <td>{{number_format(abs($hasilError[$key]), 6, '.', '')}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">Hasil Cluster Penerima</strong>
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
                            <table id="bootstrap-data-table-exporttt" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama Peserta</th>
                                    {{--                                    <th>NIK</th>--}}
                                    <th>No HP</th>
                                    <th>Alamat</th>
                                    <th>Tempat Tinggal</th>
                                    <th>Jumlah Keluarga</th>
                                    <th>Pekerjaan</th>
                                    <th>Penghasilan Perbulan</th>
                                    <th>Cluster</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $hasilCluster = json_decode($hasil->hasil_cluster)
                                @endphp
                                @foreach($cluster as $key=>$value)
                                    <tr>
                                        <td>C{{str_pad($loop->iteration, 4, '0', STR_PAD_LEFT)}}</td>
                                        <td>{{$value['data_nama']}}</td>
                                        {{--                                        <td>{{$value['data_nik']}}</td>--}}
                                        <td>{{$value['data_hp']}}</td>
                                        <td>{{$value['data_alamat']}}</td>
                                        <td>{{$value['data_tinggal']}}</td>
                                        <td>{{$value['data_jml_keluarga']}}</td>
                                        <td>{{$value['data_pekerjaan']}}</td>
                                        <td>{{$value['data_penghasilan']}}</td>
                                        <td>{{$value['cluster']}}</td>

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

@endsection
