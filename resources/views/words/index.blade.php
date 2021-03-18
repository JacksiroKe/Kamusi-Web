@extends('layouts.app', ['title' => __('Word Profile')])

@section('content')
    @include('partials.header', [
        'title' => __('Swahili Words'),
    ])   

<div class="container-fluid mt--7">
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col-3">
                            <h2 class="mb-0">Maneno</h2>
                        </div>

                        <div class="col-6" id="paginate_1">
                        {!! $words->links() !!}
                        </div>
                        
                        <div class="col-3 text-right">
                            <a href="{{ route('words.create') }}" class="btn btn-sm btn-primary">Add a Word</a>
                        </div>
                    </div>
                </div>

                <div class="table-responsive" id="results">
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col"></th>
                                <th scope="col">Word</th>
                                <th scope="col">Meaning</th>
                                <th scope="col">Synonyms</th>
                                <th scope="col">Conjugation</th>
                                <th scope="col">Searched</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                             @foreach ($words as $word)
                             <tr>
                                <td align="right">{{ $word->id }}.</td>
                                <td onclick="window.location.href='{{ route('words.view', $word->id) }}'" style="cursor: pointer;" valign="top">{{ $word->title }}</td>
                                <td onclick="window.location.href='{{ route('words.view', $word->id) }}'" style="cursor: pointer;white-space: normal;">{{ $word->meaning }}</td>
                                <td onclick="window.location.href='{{ route('words.view', $word->id) }}'" style="cursor: pointer;white-space: normal;">{{ $word->synonyms }}</td>
                                <td onclick="window.location.href='{{ route('words.view', $word->id) }}'" style="cursor: pointer;white-space: normal;">{{ $word->conjugation }}</td>
                                <td align="right"></td>
                                <td class="text-right">
                                    <div class="dropdown">
                                        <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                            <a class="dropdown-item" href="{{ route('words.edit', $word->id) }}">Edit Word</a>
                                            <a class="dropdown-item" href="#" onclick="return confirm('Are you sure you want to delete: {{ $word->title }} from the system? \nBe careful, this action can not be reversed.')">Delete Word</a>
                                            <a class="dropdown-item" href="{{ route('questions.create', $word->id) }}">Create a Question</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    
                </div>
                
                <div class="card-footer py-4">
                    <div id="paginate_2">
                        {!! $words->links() !!}
                    </div>
                    <nav class="d-flex justify-content-end" aria-label="...">
                        
                    </nav>
                </div>
            </div>
        </div>
    </div>
        
        @include('layouts.footers.auth')
    </div>
@endsection

@push('js_scripts')
    @once
        <script type="text/javascript">
        $(document).ready(function () {        
            $('#search').on('keyup',function() {
                var query = $(this).val(); 
                $.ajax({            
                    url:"{{ route('words.search') }}",        
                    type:"GET",            
                    data:{'searchQry': query},
                    
                    success:function (data) {                
                        $('#results').html(data);
                        $('#paginate_1').html('');
                        $('#paginate_2').html('');
                    }
                })
            });
        });
        </script>    
    @endonce
@endpush
