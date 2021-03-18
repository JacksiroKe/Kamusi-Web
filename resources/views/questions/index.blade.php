@extends('layouts.app', ['title' => __('Question Profile')])

@section('content')
    @include('partials.header', [
        'title' => __('Trivia Questions'),
    ])   

<div class="container-fluid mt--7">
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col-3">
                            <h2 class="mb-0">Questions</h2>
                        </div>

                        <div class="col-6" id="paginate_1">
                        {!! $questions->links() !!}
                        </div>
                        
                    </div>
                </div>

                <div class="table-responsive" id="results">
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col"></th>
                                <th scope="col">Question</th>
                                <th scope="col">Answer</th>
                                <th scope="col">Option 1</th>
                                <th scope="col">Option 2</th>
                                <th scope="col">Option 3</th>
                                <th scope="col">Option 4</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                             @foreach ($questions as $question)
                             <tr>
                                <td align="right">{{ $question->id }}.</td>
                                <td valign="top">
                                    <?php echo substr($question->title, 0, 30); ?>
                                </td>
                                <td onclick="window.location.href='{{ route('questions.view', $question->id) }}'" style="cursor: pointer;">
                                    <?php echo substr($question->answer, 0, 30); ?>
                                </td>
                                <td onclick="window.location.href='{{ route('questions.view', $question->id) }}'" style="cursor: pointer;">
                                    <?php echo substr($question->option1, 0, 30); ?>
                                </td>
                                <td onclick="window.location.href='{{ route('questions.view', $question->id) }}'" style="cursor: pointer;">
                                    <?php echo substr($question->option2, 0, 30); ?>
                                </td>
                                <td onclick="window.location.href='{{ route('questions.view', $question->id) }}'" style="cursor: pointer;">
                                    <?php echo substr($question->option3, 0, 30); ?>
                                </td>
                                <td onclick="window.location.href='{{ route('questions.view', $question->id) }}'" style="cursor: pointer;">
                                    <?php echo substr($question->option4, 0, 30); ?>
                                </td>
                                <td class="text-right">
                                    <div class="dropdown">
                                        <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                            <a class="dropdown-item" href="{{ route('questions.edit', $question->id) }}">Edit Question</a>
                                            <a class="dropdown-item" href="#" onclick="return confirm('Are you sure you want to delete: {{ $question->title }} from the system? \nBe careful, this action can not be reversed.')">Delete Question</a>
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
                        {!! $questions->links() !!}
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
                    url:"{{ route('questions.search') }}",        
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
