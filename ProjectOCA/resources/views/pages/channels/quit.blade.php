@extends("layouts.base")

<!-- Head -->
@section("title", __("pages.quit.page_name"))
@section("meta_desc", __("pages.quit.page_description"))
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

@endsection
<!-- End Header -->



<!-- Main -->
@section("main")
    <h1>@lang("pages.quit.title")</h1>

    <section>
        <h2>@lang("pages.quit.confirm")</h2>

        <form method="POST" action="/api/channels/{{$id}}/quit-confirm-channel">
            @csrf
            <p>@lang("pages.quit.sure") <strong>{{$name}}</strong> ?</p>
            <button type="submit" class="btn btn-danger">@lang("pages.quit.proceed")</button>
        </form>
    </section>
@endsection
<!-- End Main -->


<!-- Footer -->
@section("footer")
@endsection
<!-- End Main -->
