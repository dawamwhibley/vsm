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
                            <th>No.</th>
                            <th>No Dokumen</th>
                            <th>Judul</th>
                            <th>Ranking</th>
                            <th>Detail</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php($i = 1)
                        @foreach($hasil as $h)
                            @if($h['ranking']>0)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$h['id_doc']}}</td>
                                    <td>{{$h['judul']}}</td>
                                    <td>{{$h['ranking']}}</td>
                                    <td><a href="{{url('artikel/detail?id=' . $h['id_doc'])}}">Lihat</a></td>
                                </tr>
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop
