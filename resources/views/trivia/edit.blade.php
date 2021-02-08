@extends('layouts.app', ['title' => __('Trivia Details')])

@section('content')
    @include('partials.header', [
        'title' => __('Edit Trivia: ') . $trivia->title,
        'meaning' => $trivia->meaning,
    ])   

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-4 order-xl-2 mb-5 mb-xl-0">
                
            </div>
            <div class="col-xl-8 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-body">
                        <form method="post" action="{{ route('trivia.update', $trivia) }}" autocomplete="off" enctype="multipart/form-data">
                            @csrf
                            
                            <div class="card-header border-0">
                                <div class="row align-items-center">
                                     <div class="col-8"> </div>
                                    <div class="col-4 text-right">
                                        <a href="{{ route('trivia.index') }}" class="btn btn-sm btn-primary">Back to Trivia</a>
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
                                    <label class="form-control-label" for="input-title">{{ __('Trivia Name') }}</label>
                                    <input type="text" name="title" id="input-title" class="form-control form-control-alternative{{ $errors->has('title') ? ' is-invalid' : '' }}" value="{{ $trivia->title }}">

                                    @if ($errors->has('title'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('title') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                
                                <div class="form-group{{ $errors->has('meaning') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-meaning">{{ __('Trivia Meaning (Optional)') }}</label>
                                    <input type="text" name="meaning" id="input-meaning" class="form-control form-control-alternative{{ $errors->has('meaning') ? ' is-invalid' : '' }}" value="{{ $trivia->meaning }}">

                                    @if ($errors->has('meaning'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('meaning') }}</strong>
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
