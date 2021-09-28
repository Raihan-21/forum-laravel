@extends('layouts.app')
@section('content')
<div class="container home d-flex flex-column align-items-center justify-content-center" id="home">
    <h1 class="animate mt-3" id="homeheader">Stuck!</h1>
    <p class="animate">Join our community!</p>
    <p class="animate">Find a solution for your problems or</p>
    <p class="mb-5 animate">Contribute to others by giving answers!</p>
    <a href="/discussions" class="animate">Go to Forum</a>
</div>
<script type="application/javascript">
    var animate = document.querySelectorAll('.animate')
    window.addEventListener('load', function(){
        animate.forEach(item => {
            setTimeout(function(){
                item.classList.add('appear')
            }, 1000)
            
        })
    })
</script>
@endsection
