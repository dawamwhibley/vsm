@extends('welcome')

@section('content-section')
    <div class="card">
        <div class="card-header">
            <a href="{{url('/')}}">Kembali Ke Pencarian</a>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>No Document</th>
                            <th>Judul</th>
                            <th>Ranking</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($hasil as $h)
                            <tr>
                                <td>{{$h['id_doc']}}</td>
                                <td>{{$h['judul']}}</td>
                                <td>{{$h['ranking']}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop
