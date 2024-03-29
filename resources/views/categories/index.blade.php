@extends('layouts.app', ['title' => __('Word Profile')])

@section('content')
    @include('partials.header', [
        'title' => __('Trivia Categories'),
    ])   

<div class="container-fluid mt--7">
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col-4">
                            <h2 class="mb-0">Makundi ya Maswali</h2>
                        </div>
                        <div class="col-4">
                            {!! $categories->links() !!}
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{ route('categories.create') }}" class="btn btn-sm btn-primary">Add a Category</a>
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
                                <th scope="col"></th>
                                <th scope="col">Category</th>
                                <th scope="col">Number</th>
                                <th scope="col">Description</th>
                                <th scope="col">Active</th>
                                <th scope="col">Word Count</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                             @foreach ($categories as $category)
                            <tr>
                                <td><img src="{{ url($category->icon) }}" width="50"></td>
                                <td valign="top">{{ $category->title }}</td>
                                <td align="middle">{{ $category->number }}</td>
                                <td style="white-space: normal;">{{ $category->description }}</td>
                                <td align="middle">{{ $category->active == 1 ? 'YES' : 'NO' }}</td>
                                <td align="middle">{{ $category->words }}</td>
                                <td class="text-right">
                                    <div class="dropdown">
                                        <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                            <a class="dropdown-item" href="{{ route('categories.edit', $category->id) }}">Edit</a>
                                            <a class="dropdown-item" href="{{ route('categories.delete', $category->id) }}" onclick="return confirm('Are you sure you want to delete: {{ $category->title }} from the system? \nBe careful, this action can not be reversed.')">Delete</a>
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
                        {!! $categories->links() !!}
                        
                    </nav>
                </div>
            </div>
        </div>
    </div>
        
        @include('layouts.footers.auth')
    </div>
@endsection
