@extends('template.app')
@section('content')

    <div class="content mt-3">
        <div class="animated fadeIn">


            <div class="row">

                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <strong>Basic Form</strong> Elements
                        </div>
                        <div class="card-body card-block">
                            <form action="{{route('perhitungan.store')}}" method="post" enctype="multipart/form-data" class="form-horizontal">
                                @csrf
                                <div class="row form-group">
                                    <div class="col col-md-3"><label for="disabledSelect" class=" form-control-label">Jumlah Cluster</label></div>
                                    <div class="col-12 col-md-9">
                                        <select name="jml_cluster" id="disabledSelect" disabled=""
                                                class="form-control">
{{--                                            <option value="0">Please select</option>--}}
{{--                                            <option value="1">Option #1</option>--}}
{{--                                            <option value="2">Option #2</option>--}}
                                            <option value="3">3</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3"><label for="text-input" class=" form-control-label">Maksimum Iterasi</label></div>
                                    <div class="col-12 col-md-9"><input type="number" id="text-input" name="maksimum_iterasi"
                                                                        placeholder="" class="form-control"></div>
                                </div>

                                <div class="row form-group">
                                    <div class="col col-md-3"><label for="text-input" class=" form-control-label">Error Terkecil</label></div>
                                    <div class="col-12 col-md-9"><input type="number" step="any" id="text-input" name="error_terkecil"
                                                                        placeholder="" class="form-control"></div>
                                </div>

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary btn-sm">
                                        <i class="fa fa-dot-circle-o"></i> Hitung
                                    </button>
                                    <button type="reset" class="btn btn-danger btn-sm">
                                        <i class="fa fa-ban"></i> Kembali
                                    </button>
                                </div>

                            </form>
                        </div>

                    </div>

                </div>
            </div>
        </div><!-- .animated -->
    </div><!-- .content -->
@endsection
