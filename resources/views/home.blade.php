@extends('Layout/isUser')

@section('content')
    <div class="card border-0">
        <div class="card-body pt-0">
            <div class="container-fluid">
                <div class="container-fluit px-2">
                        <h3 class="pb-2">{{ $title }}</h3>
                        @foreach ($articles as $article)
                            <div class="card mb-2">
                                <div class="card-body">
                                    <h5 class="card-title text-primary">{{ $article->title }} 
                                        <button type="button" class="btn btn-outline-secondary btn-sm">{{ $article->tag }}</button>
                                        <button type="button" class="btn btn-outline-primary btn-sm">{{$article->created_at->format('d/m/Y')}}</button>
                                    </h5>
                                    <p class="card-text">{{ Str::limit($article->description, 80) }}</p>
                                    <a href="/article/{{$article->id}}">
                                        <button type="button" class="btn btn-primary btn-sm">Read more > </button>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                        <div class="d-flex">
                            <div class="p-2 w-100">
                                {{ $articles->links() }}
                            </div>
                        <div class="p-2 flex">
                        <div class="input-group">
                            <span class="input-group-text">Total Articles</span>
                            <input type="text" class="form-control"  disabled value="{{ $articles->total() }} ">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


