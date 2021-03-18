<?php
    $varContents = $question->meaning;
    $varContents = str_replace("\\", "", $varContents);
    $varContents = str_replace('"', '', $varContents);
    $varContents = str_replace(',', ', ', $varContents);
    $varContents = str_replace('  ', ' ', $varContents);

    $varMeaning = explode("|", $varContents);
?>
@extends('layouts.app', ['title' => __('Question Profile')])

@section('content')
    @include('partials.header', [
        'title' => __('Neno') . ': '. $question->title,
    ])   

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-6">
                @foreach ($varMeaning as $meaning)
                    <div class="card bg-white shadow" style="margin-bottom: 10px;">
                        <div class="card-body">
                        <?php 
                            $varExtra = explode(":", $meaning);
                            if (sizeof($varExtra) == 2) {
                                echo " ~ " . $varExtra[0] . "<br><i>Mfano:</i> " . $varExtra[1];
                            }
                            else 
                                echo " ~ " . $meaning;
                        ?>
                        </div>
                    </div>
                @endforeach
                
            @if (isset($question->synonyms) && $question->synonyms)
                <?php
                    $varSynonyms = explode(",", $question->synonyms); 
                ?>
                <div class="card bg-white shadow">
                    <h3 style="margin: 10px 30px; ">VISAWE (<?php echo sizeof($varSynonyms); ?>)</h3>
                    <div class="card-body">
                        @foreach ($varSynonyms as $synonym)
                            {{ $synonym }}, 
                        @endforeach
                    </div>
                </div>
            @endif
            </div>
            <div class="col-xl-6">
                <div class="card bg-white shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-6">
                                <h2 class="mb-0">QUESTIONS</h2>
                            </div>

                            <div class="col-6 text-right">
                                <a href="{{ route('questions.create') }}" class="btn btn-sm btn-primary">NEW QUESTION</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        
                    </div>
                </div>
            </div>
            
        </div>
        
        @include('layouts.footers.auth')
    </div>
@endsection
