
@if(Session::has('success'))

<div class="alert alert-success alert-dismissible fade in" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
            aria-hidden="true">×</span>
    </button>
    {{ Session::get('success') }}
</div>
 
@endif

@if(Session::has('failed'))

<div class="alert alert-danger alert-dismissible fade in" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
            aria-hidden="true">×</span>
    </button>
    {{ Session::get('failed') }}
</div>
 
@endif

@if ($errors->any())

<div class="alert alert-danger alert-dismissible fade in" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
            aria-hidden="true">×</span>
    </button>
    @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach
</div>
 
@endif