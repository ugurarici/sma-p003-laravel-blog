@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ __('Edit Post') }}

                </div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <form action="{{ route('posts.update', $post) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="slcCategory">{{ __('Post Category') }}</label>
                            <select class="custom-select" name="category_id">
                                @foreach($categories as $category)
                                <option value="{{ $category->id }}" @if($post->category_id==$category->id) selected
                                    @endif
                                    >{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="inpTitle">{{ __('Post Title') }}</label>
                            <input type="text" name="title" class="form-control" id="inpTitle"
                                value="{{ $post->title }}">
                            @error('title')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="txtContent">{{ __('Post Content') }}</label>
                            <textarea name="content" class="form-control"
                                id="txtContent">{{ $post->content }}</textarea>
                            @error('content')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">{{ __('Update Post') }}</button>
                    </form>
                    <hr>
                    <form action="{{ route('posts.destroy', $post) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">{{ __('Delete Post') }}</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
