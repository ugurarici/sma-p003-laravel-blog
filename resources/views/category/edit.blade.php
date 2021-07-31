@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ __('Edit Category') }}

                </div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <form action="{{ route('categories.update', $category) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="inpName">{{ __('Category Name') }}</label>
                            <input type="text" name="name" class="form-control" id="inpName"
                                value="{{ $category->name }}">
                        </div>
                        <button type="submit" class="btn btn-primary">{{ __('Update Category') }}</button>
                    </form>
                    <hr>
                    <form action="{{ route('categories.destroy', $category) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">{{ __('Delete Category') }}</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
