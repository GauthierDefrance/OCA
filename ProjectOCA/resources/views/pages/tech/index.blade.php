@extends("layouts.base")

<!-- Head -->
@section("title", __("pages.tech.page_name"))
@section("meta_desc", __("pages.tech.page_description"))
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
    <h1>@lang("pages.tech.title")</h1>

    <section>
        <h2>@lang("pages.tech.tests")</h2>

        <p><strong>@lang("pages.tech.user_ip") :</strong> {{ $ip }}</p>
        <p><strong>@lang("pages.tech.web_navigator") :</strong> {{ $userAgent }}</p>

        <p><strong>@lang("pages.tech.country") :</strong> {{ $gps['country'] ?? __("pages.tech.unknow") }}</p>
        <p><strong>@lang("pages.tech.city") :</strong> {{ $gps['city'] ??__("pages.tech.unknow") }}</p>
        <p><strong>@lang("pages.tech.lat") :</strong> {{ $gps['latitude'] ?? __("pages.tech.not_available") }}</p>
        <p><strong>@lang("pages.tech.long") :</strong> {{ $gps['longitude'] ?? __("pages.tech.not_available")}}</p>

    </section>
@endsection
<!-- End Main -->


<!-- Footer -->
@section("footer")
@endsection
<!-- End Main -->
