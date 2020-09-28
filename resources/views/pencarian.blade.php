@extends('welcome')

@section('content-section')
    <div class="card">
        <div class="card-header">
            <a href="{{url('artikel/list')}}">List Artikel</a>
        </div>
    </div>

    <div class="flex-center position-ref full-height">
        <div class="content">
            <form action="{{url('test')}}" method="get">
                <div class="title m-b-md">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Pencarian</label>
                                <input name="keyword" type="text" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-info">Pencarian</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@stop
