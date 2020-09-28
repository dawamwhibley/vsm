@extends('welcome')

@section('content-section')
    <div class="card">
        <div class="card-header">
            <a href="{{url('artikel/list')}}">List Artikel</a>
        </div>
        <div class="card-body">
            <form action="{{url('artikel')}}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Judul</label>
                            <input name="judul" type="text" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="form-group">
                            <label for="">Artikel</label>
                            <textarea class="form-control" name="artikel" rows="10"></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-9">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@stop
