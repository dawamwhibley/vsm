@extends('welcome')

@section('content-section')
    <div class="card">
        <div class="card-header">
            <a href="{{url('artikel/list')}}">List Artikel</a>
        </div>
        <div class="card-body">
            <h3 style="text-align: center">{{$artikel->judul}}</h3>
            <br>
            <p style="text-align: justify;text-justify: inter-word;">{{$artikel->deskripsi}}</p>
        </div>
    </div>
@stop
