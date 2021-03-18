<div class="header pb-8 pt-5 pt-lg-8 d-flex align-items-center" style="background-image: url(../argon/img/theme/profile-cover.jpg); background-size: cover; background-position: center top;">
    <!-- Mask -->
    <span class="mask bg-gradient-default opacity-8"></span>
    <!-- Header container -->
    <div class="container-fluid d-flex align-items-center">
        <div class="row">
            <div class="col-md-12 {{ $class ?? '' }}">
                <h4 class="display-3 text-white">{{ $title }}</h4>
                @if (isset($description) && $description)
                    <p class="text-white mt-0 mb-5">{{ $description }}</p>
                @endif
                
                @if (session('status'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('status') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

            </div>
        </div>
    </div>
</div> 