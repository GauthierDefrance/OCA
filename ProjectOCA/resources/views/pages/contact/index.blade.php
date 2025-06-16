@extends("layouts.base")

<!-- Head -->
@section("title", __("pages.contact.page_name"))
@section("meta_desc", __("pages.contact.page_description"))
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
    <h1>@lang("pages.contact.title")</h1>
    <section>
        <h2>@lang("pages.contact.contacts_list")</h2>
        <p>@lang("pages.contact.text")</p>
        <ul class="list-container">
            <li>
                <img src="/icons/github.svg" alt="Github Logo" width="24" height="24" class="icon">
                Github : <a href="https://github.com/GauthierDefrance">@lang("pages.contact.github")</a>
            </li>
            <li>
                <img src="/icons/youtube.svg" alt="Github Logo" width="24" height="24" class="icon">
                Youtube : <a href="https://www.youtube.com/channel/UCqEoerAn-IwdS9IKSzLvdpA">@lang("pages.contact.youtube")</a>
            </li>
            <li>
                <img src="/icons/gmail.svg" alt="Github Logo" width="24" height="24" class="icon">
                Gmail : @lang("pages.contact.gmail")
            </li>
        </ul>
    </section>
@endsection
<!-- End Main -->


<!-- Footer -->
@section("footer")
@endsection
<!-- End Main -->
