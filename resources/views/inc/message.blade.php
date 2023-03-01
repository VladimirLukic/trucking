@if (count($errors) > 0)
    @foreach ($errors->all() as $error)
        <div class="alert alert-danger">
            {{ $error }}
        </div>
    @endforeach
@endif

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

{{-- <script type="module" src="../js/script.js"></script> --}}

<script>
    const timeout = setTimeout(function(){
    const alert = document.querySelector(".alert");
    (alert)? alert.style.display = 'none':'';
}, 3000);

</script>