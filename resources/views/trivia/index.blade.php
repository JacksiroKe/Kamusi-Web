@extends('layouts.app', ['title' => __('Trivia Profile')])

@section('content')
    @include('partials.header', [
        'title' => __('Site Trivias'),
    ])   

<div class="container-fluid mt--7">
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">Site Trivias</h3>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{ route('trivia.create') }}" class="btn btn-sm btn-primary">Add a Trivia</a>
                        </div>
                    </div>
                </div>
                
                <div class="col-12"></div>

                @if (session('status'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('status') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Location</th>
                                <th scope="col">Email</th>
                                <th scope="col">Mobile</th>
                                <th scope="col">Creation Date</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                             @foreach ($trivia as $trivial)
                            <tr>
                                <td>{{ $trivial->name }}, {{ $trivial->title }}</td>
                                <td>{{ $trivial->town }}, {{ $trivial->country }}</td>
                                <td>
                                    <a href="mailto:#">{{ $trivial->email }}</a>
                                </td>
                                <td>
                                    <a href="mobile:#">{{ $trivial->mobile }}</a>
                                </td>
                                <td>{{ $trivial->created_at }}</td>
                                <td class="text-right">
                                    <div class="dropdown">
                                        <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                            <a class="dropdown-item" href="{{ route('trivia.edit', $trivial->id) }}">Edit</a>
                                            <a class="dropdown-item" href="">Delete</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer py-4">
                    <nav class="d-flex justify-content-end" aria-label="...">
                        
                    </nav>
                </div>
            </div>
        </div>
    </div>
        
        @include('layouts.footers.auth')
    </div>
@endsection
