@extends('Layout/isDetail')

@section('content')
    <div class="card mx-2 mb-2">
        <div class="container-fluid">
            <div class="card-body">
            <h4>Edit {{ $title }}</h4>
                @if (count($errors) > 0)
                    <div class="alert alert-danger alert-dismissible fade show pb-0" role="alert">
                        <ul>
                            @foreach ($errors->all() as $error)
                                {{ $error }}
                            @endforeach
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </ul>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="card mx-2 mb-2">
        <div class="container-fluid">
            <div class="card-body">
                <form method="POST" action={{ route('article_update_action') }}>
                    @csrf
                    <input type="hidden" name="id" value={{ $article->id }} />
                    <div class="mb-"2>
                        <label class="form-label">Title</label>
                        <input type="text" class="form-control" name="title" value="{{$article->title}}">
                        <div class="form-text text-danger mb-2">*Title minimum 10 characters or letters</div>
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Description</label>
                        <textarea class="form-control mb-2" placeholder="Description" name="description" style="height: 100px">{{$article->description}}</textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tag</label>
                        <input type="text" class="form-control" name="tag" value="{{$article->tag}}">
                    </div>
                    <button type="submit" class="btn btn-primary" style="width: 110px">Edit Article</button>
                </form>
                <a href="/dashboard"><button class="btn btn-danger mt-2" style="width: 110px">Cancel</button></a>
            </div>
        </div>
    </div>
@endsection