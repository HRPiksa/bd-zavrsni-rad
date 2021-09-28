@extends('layouts.frontend.main')

@section('title', 'Algebra Cook - Home page')

@section('content')

<div class="container">
    <div class="pg-container">
        <div class="pg-image">
            @if (isset($page->image))
            <img src="{{ asset('storage/' . $page->image) }}" class="pg-img" />
            @endif
        </div>

        <div class="pg-text border border-success rounded-lg m-2">
            {!!$page->content!!}
        </div>
    </div>
</div>

@endsection