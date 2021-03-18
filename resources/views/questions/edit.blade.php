<?php 
    $html_options = '';

    for ($i = 1; $i <= 4; $i++)
    {
        $html_options .= '<div class="card bg-white shadow" style="margin-bottom: 10px;">
                        <div class="card-body">
                            <b> Option '. $i .'</b>: <span style="cursor: pointer;" onclick="showOrHide(\'searching'. $i .'\', 1)">Search Now</span>
                            <div id="searching' . $i .'" class="card bg-secondary" style="padding: 10px;margin-bottom: 10px;display: none;">
                                <input id="search'. $i .'" name="search'. $i .'" class="form-control" type="search" placeholder="Search" onkeyup="searchNow('. $i .')">
                                <div id="results'. $i .'"></div>
                            </div>
                            <table>
                                <tr>
                                    <td style="width: 100%;">
                                        <textarea name="option'. $i .'" id="option1" class="form-control">' . $answers[$i-1] . '</textarea>
                                    </td>
                                    <td>
                                        <span class="btn btn-success" onclick="setOption('. $i .')">Done</span>
                                        <span class="btn btn-danger" onclick="clearOption('. $i .')">Clear</span>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>';
    }

?>
@extends('layouts.app', ['title' => __('Question Details')])

@section('content')
    @include('partials.header', [
        'title' => __('Question: ' . $question->title),
        'description' => __('Answer: ' . $question->answer),
    ])   

    <div class="container-fluid mt--7">
        
        <form method="post" action="{{ route('questions.store') }}">
            @csrf
            <div class="row">
                <div class="col-xl-6 order-xl-1">
                    <div class="card bg-secondary shadow">
                        <div class="card-header bg-white border-0">
                            <div class="row align-items-center">
                                <h2 class="mb-0">Question Format</h2>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="pl-lg-4">
                                
                                <div class="card bg-white shadow" style="margin-bottom: 10px;">
                                    <div class="card-body">
                                        <div class="card bg-secondary" style="padding: 10px;margin-bottom: 10px;">
                                            <b>Question Category</b><br>
                                            <select class="form-control custom-select" name="category" required>
                                            @foreach ($categories as $category )
                                                <option value="{{ $category->id }}"{{ ( $category->id == $question->category) ? ' selected' : '' }}> {{ $category->title }} </option>  
                                            @endforeach
                                            </select>
                                            @if ($errors->has('category'))
                                                <span class="invalid-feedback" style="display: block;" role="alert">
                                                    <strong>{{ $errors->first('category') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="card bg-secondary" style="padding: 10px;">
                                            <b>Question Level</b><br>
                                            <select class="form-control custom-select" name="level" required>
                                            @foreach ($levels as $index => $level )
                                                <option value="{{ $index }}"{{ ( $index == $question->level) ? ' selected' : '' }}> {{ $level }} </option>  
                                            @endforeach
                                            </select>
                                            @if ($errors->has('level'))
                                                <span class="invalid-feedback" style="display: block;" role="alert">
                                                    <strong>{{ $errors->first('level') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="card bg-white shadow">
                                    <div class="card-body">
                                        <div class="card bg-secondary" style="padding: 10px;margin-bottom: 10px;">
                                            <b>The Question</b><br>
                                            <textarea name="title1" id="input-title1" class="form-control" required>{{ $question->title }}</textarea>
                                        </div>
                                        <div class="card bg-secondary" style="padding: 10px;">
                                            <b>The Answer</b><br>
                                            <textarea name="answer1" id="input-answer1" class="form-control" required>{{ $question->answer }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-6 order-xl-1">
                    <div class="card bg-secondary shadow">
                        <div class="card-header bg-white border-0">
                            <div class="row align-items-center">
                                <h2 class="mb-0">Question Options</h2>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="pl-lg-4">
                              <?php echo $html_options ?>
                            </div>
                        </div>
                    </div>
                </div>
                          
            </div>

            <div class="row">
                <div class="col-12 text-center">
                    <button type="submit" class="btn btn-success mt-4">{{ __('Create Question') }}</button>
                </div>
            </div>
        </form>  
        
        @include('layouts.footers.auth')
    </div>
@endsection

@push('js_scripts')
    @once        
        <script type="text/javascript">
        function searchNow(option) {                
            var format = $('#format').val();
            var query = $('#search' + option).val();

            $.ajax({            
                url:"{{ route('words.find') }}",        
                type:"GET",            
                data:{'findQry': format + ':' + query + ':' + option},
                
                success:function (data) {                
                    $('#results' + option).html(data);
                }
            });
        };

        function setValue(elem, data)
        {
            var optionelem = document.getElementById('option' + elem);
            optionelem.value = data;
        }

        function setOption(option)
        {
            showOrHide('searching' + option, 0);
            $('#results' + option).html('');
        }

        function clearOption(option)
        {
            document.getElementById('search' + option).value = '';
            document.getElementById('option' + option).value = '';
        }

        function showOrHide(elem, show)
        {
            if (show == 1)
                $('#' + elem).slideDown(400); 
            else
                $('#' + elem).slideUp(400);
        }

        </script>    
    @endonce
@endpush