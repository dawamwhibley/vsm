@extends('welcome')

@section('content-section')
    <div class="card">
        <div class="card-header">
            <a href="{{url('/')}}">Kembali Ke Pencarian</a>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="d-flex justify-content-center">
                        <div class="spinner-border text-primary" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-12">
                    <table id="tbl-hasil" class="table">
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
                        {{--@php($i = 1)--}}
                        {{--@foreach($hasil as $h)--}}
                            {{--@if($h['ranking']>0)--}}
                                {{--<tr>--}}
                                    {{--<td>{{$i++}}</td>--}}
                                    {{--<td>{{$h['id_doc']}}</td>--}}
                                    {{--<td>{{$h['judul']}}</td>--}}
                                    {{--<td>{{$h['ranking']}}</td>--}}
                                    {{--<td><a href="{{url('artikel/detail?id=' . $h['id_doc'])}}">Lihat</a></td>--}}
                                {{--</tr>--}}
                            {{--@endif--}}
                        {{--@endforeach--}}
                        {{--</tbody>--}}
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script>
        (function( $ ){
            function cek(){
                $.ajax({
                    url: '{{url('/')}}/cekhasil',
                    success: function (data) {
                        console.log('cek hasil', data);
                        var contentHtml = '';
                        var i = 1 ;
                        $.each(data, function (i, d) {
                            console.log('>>>>', d);
                            contentHtml += '<tr>' +
                                '<td>'+(i++)+'</td>' +
                                '<td>'+d.id_doc+'</td>' +
                                '<td>'+d.judul+'</td>' +
                                '<td>'+d.ranking+'</td>' +
                                '<td><a href="{{url('/artikel/detail?id=')}}'+d.id_doc+'">Lihat</a></td>' +
                                '</tr>';
                        })

                        $('#tbl-hasil tbody').html(contentHtml);

                        if (data.length > 0) {
                            clearInterval(interval);
                            $('.spinner-border').addClass('d-none')
                        }
                    }
                });
            }
            var interval = setInterval( cek, 5000 );
        })( jQuery );
    </script>
@stop