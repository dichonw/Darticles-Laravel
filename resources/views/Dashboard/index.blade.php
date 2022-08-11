@extends('Layout/isUser')

@section('content')
    <div class="card mx-2 mb-2">
        <div class="card-body">
            <div class="container-fluid">
                <h4>{{ $title }}</h4>
                <div class="row">
                    <div class="col-6">
                        <div class="card bg-success text-light">
                            <div class="card-body">
                                <h5 class="card-title">Total Admins</h5>
                                <h3 class="card-text">{{ $total_users }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card bg-secondary text-light">
                            <div class="card-body">
                                <h5 class="card-title">Total Articles</h5>
                                <h3 class="card-text">{{ $articles->total() }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
        </div> 
    </div>
    <div class="card mx-2 mb-2">
        <div class="card-body">
            <div class="container-fluid">
                @if ( session()->get('flash_message') )
                    <div class="alert {{ session()->get('flash_type') }}" role="alert">
                        {{ session()->get('flash_message') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
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
                <div class="input-group-sm mb-2">
                    <h5>Add New Article</h5>
                    <form method="POST" action={{ route('article_add_action') }}>
                        @csrf
                        <input type="text" class="form-control mb-2" placeholder="Title" name="title" value="{{old('title')}}" />
                        <div class="form-text text-danger mb-2">*Title minimum 10 characters or letters</div>
                        <textarea class="form-control mb-2" placeholder="Description" name="description" style="height: 100px">{{old('description')}}</textarea>
                        <input type="text" class="form-control mb-2" placeholder="Tag" name="tag" value="{{old('tag')}}" />
                        <button class="btn btn-primary" type="submit">Create New Article</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="card mx-2 mb-2">
        <div class="card-body">
            <div class="container-fluid">
                <h5>List Of Articles</h5>
                <div class="table-responsive">
                    <table class="table table-striped table-hover table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Title</th>
                                <th scope="col">Description</th>
                                <th scope="col">Tag</th>
                                <th scope="col">Created at</th>
                                <th scope="col">Updated</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            @foreach ($articles as $article)
                            <tr>
                                <th scope="row">{{ $no }}</th>
                                <td>{{ $article->title }}</td>
                                <td>{{ $article->description }}</td>
                                <td><button class="btn btn-outline-primary">{{ $article->tag }}</button></td>
                                <td>{{ $article->created_at->format('d/m/Y H:i:s') }}</td>
                                @if ( $article->updated_at != $article->created_at )
                                        <td>Yes, at {{ $article->updated_at->format('d/m/Y H:i:s') }}</td>
                                @else
                                        <td>No</td>
                                @endif
                                <td>
                                    <div>
                                        <a class="btn btn-success text-light mb-1" style="width: 80px;" href="/article/edit/{{ $article->id }}">Edit</a>
                                        <form method="POST" action={{ route('article_delete_action') }}>
                                            @csrf
                                            <input type="hidden" name="id" value={{ $article->id }} />
                                            <button class="btn btn-danger mb-1" type="submit" style="width: 80px;">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            <?php $no++; ?>
                            @endforeach
                        </tbody>  
                    </table>
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
    </div>
@endsection