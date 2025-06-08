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
    <h1>Leave the group?</h1>

    <section>
        <h2>Confirm</h2>

        <form method="POST" action="/api/channels/{{$id}}/quit-confirm-channel">
            @csrf
            <p>Are you sure you want to leave the group <strong>{{$name}}</strong> ?</p>
            <button type="submit" class="btn btn-danger">Yes, leave</button>
        </form>
    </section>
@endsection
<!-- End Main -->


<!-- Footer -->
@section("footer")
@endsection
<!-- End Main -->
