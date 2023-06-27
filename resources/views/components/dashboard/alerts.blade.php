@if(Session::has('success'))
<div class="alert bg-primary alert-dismissible mb-2" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button>
    {{ Session::get('success') }}
</div>
@endif

@if(Session::has('error'))
<div class="alert bg-danger alert-dismissible mb-2" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button>
    {{ Session::get('error') }}
</div>
@endif

@if ($errors->any())
    @foreach ($errors->all() as $error)
        <div class="alert bg-danger alert-dismissible mb-2" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            {{ $error }}
        </div>
    @endforeach
@endif

