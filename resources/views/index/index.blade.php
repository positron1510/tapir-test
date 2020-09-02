@extends('layouts.layout')

@section('content')
    @foreach($advertisements as $adv)
        <div class="card mb-3">
            <div class="card-body">
                <div class="media">
                    <img src="{{ $adv->photo }}" alt="" width="350" class="mr-3">
                    <div class="media-body">
                        <h5 class="card-title">{{ $adv->title }}</h5>
                        <p class="card-text">{{ $adv->description }}</p>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    {!! $pagination !!}
@endsection
