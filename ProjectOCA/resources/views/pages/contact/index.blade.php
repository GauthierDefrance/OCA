@extends("layouts.base")

<!-- Head -->
@section("title","Home")
@section("meta_desc","This is the description.")
@section("meta_author","I am the author.")

@push("styles")
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
@endpush

@push("scripts")
<!--- <script src="/js/app.js" defer></script> le defer est important ! --->

@endpush
<!-- End Head -->



<!-- Header -->
@section("header")
@endsection
<!-- End Header -->



<!-- Main -->
@section("main")
    <h1>Contact</h1>
    <section>
        <h2>List of contacts</h2>
        <ul>
            <li>Github : <a href="https://github.com/GauthierDefrance">My github</a></li>
            <li>Youtube : <a href="https://www.youtube.com/channel/UCqEoerAn-IwdS9IKSzLvdpA">My channel</a></li>
            <li>Gmail : No-email</li>
        </ul>
    </section>
@endsection
<!-- End Main -->


<!-- Footer -->
@section("footer")
@endsection
<!-- End Main -->
