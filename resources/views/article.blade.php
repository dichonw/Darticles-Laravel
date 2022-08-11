@extends('Layout/isDetail')

@section('content')
    <div class="card border-0">
        <div class="card-body">
            <div class="container-fluid">
                <div class="container-fluit px-2">
                    <h3 class="pb-2">{{ $title }}</h3>
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title text-primary">{{ $article->title }} 
                                <button type="button" class="btn btn-outline-secondary btn-sm">{{ $article->tag }}</button>
                                <button type="button" class="btn btn-outline-primary btn-sm">{{$article->created_at->format('d/m/Y')}}</button>
                            </h5>
                            <p class="card-text">{{ $article->description }}</p>
                            @if ( $article->updated_at != $article->created_at )
                                <div class="form-text text-secondary text-end mb-2">
                                *Article has been edited at {{$article->updated_at->format('d/m/Y')}}
                                </div>
                            @endif
                        </div>
                    </div>
                    <a type="button" class="btn btn-primary" href="/">kembali</a>
                </div>
            </div>
        </div>
    </div>
    
@endsection


