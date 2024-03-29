@extends('layouts.app', ['title' => __('Category Details')])

@section('content')
    @include('partials.header', [
        'title' => __('Edit Category: ') . $category->title,
        'description' => $category->description,
    ])   

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-4 order-xl-2 mb-5 mb-xl-0">
                
            </div>
            <div class="col-xl-8 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-body">
                        <form method="post" action="{{ route('categories.update', $category) }}" autocomplete="off" enctype="multipart/form-data">
                            @csrf
                            
                            <div class="card-header border-0">
                                <div class="row align-items-center">
                                     <div class="col-8"> </div>
                                    <div class="col-4 text-right">
                                        <a href="{{ route('categories.index') }}" class="btn btn-sm btn-primary">Back to Categories</a>
                                    </div>
                                </div>
                            </div>

                            @if (session('status'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('status') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            <div class="pl-lg-4">                                
                                <div class="form-group{{ $errors->has('title') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-title">{{ __('Category Name') }}</label>
                                    <input type="text" name="title" id="input-title" class="form-control form-control-alternative{{ $errors->has('title') ? ' is-invalid' : '' }}" value="{{ $category->title }}">

                                    @if ($errors->has('title'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('title') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                
                                <div class="form-group{{ $errors->has('description') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-description">{{ __('Category Description (Optional)') }}</label>
                                    <textarea name="meaning" id="input-meaning" class="form-control form-control-alternative{{ $errors->has('meaning') ? ' is-invalid' : '' }}" style="height: 100px">{{ $category->description }}</textarea>

                                    @if ($errors->has('description'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('description') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                
                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4">{{ __('Save Changes') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        @include('layouts.footers.auth')
    </div>
@endsection
