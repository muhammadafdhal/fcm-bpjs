@extends('template.app')

@section('dash')
    Dashboard
@endsection

@section('dashboard')
    active
@endsection

@section('content')

<div class="row">
    <div class="col-md-2">
        <div class="card">

        </div>
    </div>


    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <div class="mx-auto d-block">
                    <h5 class="text-sm-center mt-2 mb-1">Clustering Penentuan Kelas Bpjs</h5>
                    <h5 class="text-sm-center mt-2 mb-1">Menggunakan Metode Fuzzy C-Means</h5>
{{--                    <div class="location text-sm-center"><i class="fa fa-map-marker"></i> California, United States</div>--}}
                </div>
                <hr>
                <div class="card-text text-sm-center">
                    <a href="#"><i class="fa fa-facebook pr-1"></i></a>
                    <a href="#"><i class="fa fa-twitter pr-1"></i></a>
                    <a href="#"><i class="fa fa-linkedin pr-1"></i></a>
                    <a href="#"><i class="fa fa-pinterest pr-1"></i></a>
                </div>
            </div>
        </div>
    </div>



    <div class="col-md-2">
        <div class="card">

        </div>
    </div>
</div>

@endsection

