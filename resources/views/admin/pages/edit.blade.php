@extends('layouts.main')

@section('title', 'Uređivanje stranice')

@section('content')

<div class="container-fluid">
    <div class="row align-items-center">
        <div class="col-sm-3 border border-warning rounded-pill ml-3 pt-2 pl-3 pr-3 pb-1 bg-light text-warning">
            <h4 style="text-align: left">Uređivanje stranice</h4>
        </div>

        <div class="col-sm-3">
            <a href="{{ route('pages.index') }}" class="btn btn-outline-primary"> &lt;&lt;&lt; Povratak</a>
        </div>
    </div>

    <hr>

    <div>
        @if (!$errors->isEmpty())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $message)
                <li>{{$message}}</li>
                @endforeach
            </ul>
        </div>
        @endif
    </div>

    <div>
        <form action="{{route('pages.update', ['page' => $model->id])}}" method="POST" enctype="multipart/form-data">
            @method('PUT')

            @csrf

            <div class="form-group row align-items-center">
                <div class="col-sm-8">
                    <div class="row align-items-center">
                        <label for="title" class="control-label col-sm-3 text-right">Naslov</label>
                        <div class="col-sm-4">
                            <input type="text" name="title" class="form-control" id="title" value="{{ $model->title }}">
                        </div>

                        <label for="url" class="control-label col-sm-2 text-right">URL</label>
                        <div class="col-sm-3">
                            <input type="text" name="url" class="form-control" id="url" value="{{ $model->url }}">
                        </div>
                    </div>
                </div>
            </div>

            {{-- <div class="form-group row align-items-center">
                <label for="title" class="control-label col-sm-2 text-right">Naslov</label>
                <div class="col-sm-6">
                    <input type="text" name="title" class="form-control" id="title" value="{{ $model->title }}">
    </div>
</div>

<div class="form-group row align-items-center">
    <label for="url" class="control-label col-sm-2 text-right">URL</label>
    <div class="col-sm-6">
        <input type="text" name="url" class="form-control" id="url" value="{{ $model->url }}">
    </div>
</div> --}}

<div class="form-group row align-items-center">
    <label for="order" class="control-label col-sm-2 text-right">Poredak</label>
    <div id="order" class="col-sm-6">
        <div class="row">
            <div class="col-md-3">
                <select name="order" id="order" class="form-control">
                    <option value=""></option>
                    <option value="before">Prije</option>
                    <option value="after">Poslije</option>
                    <option value="child">Dijete od</option>
                </select>
            </div>
            <div class="col-md-9">
                <select name="orderPage" id="orderPage" class="form-control">
                    <option value=""></option>
                    @foreach ($orderPages as $page)
                    <option value="{{$page->id}}">{!! $page->present()->paddedTitle !!}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
</div>

<div class="form-group row align-items-center">
    <label for="content" class="control-label col-sm-2 text-right">Sadržaj</label>
    <div class="col-sm-6">
        <textarea type="text" id="ck-content-edit" name="content" class="form-control"
            id="content">{{$model->content}}</textarea>
    </div>
</div>

<div class="form-group row align-items-center">
    <label for="imageGroup" class="control-label col-sm-2 text-right">Slika</label>
    <div id="imageGroup" class="col-sm-6">
        <div class="row align-items-center">
            <div class="col-sm-7">
                {{-- <input type="file" class="form-control" id="image" name="image"> --}}
                <div class="float-left">
                    <div class="adjusted-file-input">
                        <input type="button" value="Odaberite datoteku" />
                        <input type="file" name="image" id="image" />
                        <input type="text" />
                    </div>
                </div>
            </div>
            <div class="col-sm-5">
                <div class="float-right">
                    <img id="preview-image" src="{{asset('storage/' . $model->image)}}" alt=""
                        style="max-height: 200px; max-width: 200px;"> </div>
            </div>
        </div>
    </div>
</div>

<div class="form-group row align-items-center">
    <div class="col-sm-2 text-right">
        <input type="submit" class="btn btn-success" value="Uredi stranicu">
    </div>
</div>
</form>
</div>
</div>

@endsection

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

<script type="text/javascript">
    $(document).ready(function(){
        $('.adjusted-file-input input[type="file"]').change(function(e){
            $(this).siblings('input[type="text"]').val(e.target.files[0].name);
        });
    });
</script>

@push('scripts-after')
<script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('ck-content-edit');
</script>
@endpush