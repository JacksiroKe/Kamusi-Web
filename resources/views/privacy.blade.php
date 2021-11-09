@extends('layouts.app', ['class' => 'bg-default'])

@section('content')
    @include('layouts.headers.guest')

    <div class="container mt--8 pb-5">
        <div class="row justify-content-center">
            <div class="col-lg-12 col-md-7">
                <div class="card bg-secondary shadow border-0">
                    <div class="card-body px-lg-5 py-lg-5">
                        <div class="text-center text-muted mb-4">
                            <h1>Privacy Statement</h1>
                            <hr>
                            <h3>Mobile App: Kamusi ya Kiswahili</h3>
                            <h3>Developer: Jackson Siro</h3>
                        </div>                        
                    
                        <div class="text-darker mb-4">
                            <h2>The Policy in a Nutshell</h2>
                            <div class="card-body">
                            We only collect the minimum amount of personal information that is necessary to get the job done. We strive to treat it carefully and to be good stewards of your trust.<br><br>Details are below.
                            </div>
                        </div>                        
                    
                        <div class="text-darker mb-4">
                            <h2>Information Kamusi ya Kiswahili collects</h2>
                            <div class="card-body">
                                At the moment there is no information we are collecting from the users.
                            </div>
                            
                        </div>

                </div>                
            </div>            
        </div>
        
    </div>
    
@endsection
