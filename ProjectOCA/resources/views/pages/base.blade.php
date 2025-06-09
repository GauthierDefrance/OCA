@extends("layouts.base")

<!-- Head -->
@section("title","Home")
@section("meta_desc","This is the description.")
@section("meta_author","I am the author.")

@push("styles")
    @vite(["resources/css/main.css",])
@endpush

@push("scripts")
<!--- <script src="/js/app.js" defer></script> le defer est important ! --->

@endpush
<!-- End Head -->



<!-- Header -->
@section("header")
    This is the header
@endsection
<!-- End Header -->



<!-- Main -->
@section("main")
    This is the main section
@endsection
<!-- End Main -->


<!-- Footer -->
@section("footer")
    This is the foot of the page
@endsection
<!-- End Main -->
