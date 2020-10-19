@extends('welcome')

@section('content-section')
    <div class="card">
        <div class="card-header">
            <a href="{{url('artikel')}}">Tambah Artikel</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;
            <a href="{{url('/')}}">Pencarian</a>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                <tr>
                    <th>No.</th>
                    <th>No Documen</th>
                    <th>Judul</th>
                    <th>Artikel</th>
                    <th>Hapus</th>
                </tr>
                </thead>
                <tbody>
                @php($i = 1)
                @foreach($list as $l)
                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{$l->id}}</td>
                        <td>{{$l->judul}}</td>
                        <td><span class="text">{{$l->deskripsi}}</span></td>
                        <td>
                            <form method="post" action="{{url('artikel/hapus?id=' . $l->id)}}">
                                @csrf
                                <button class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop
