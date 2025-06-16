@extends("layouts.base")

<!-- Head -->
@section("title", __("pages.home.page_name"))
@section("meta_desc", __("pages.home.page_description"))
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
    <h1>
        @lang("pages.home.title")
    </h1>
    @guest()
    <section>
        <h2>@lang("pages.home.guest_title")</h2>
        <p>@lang("pages.home.guest_text")</p>
    </section>
    @endguest

    @auth()
    <section>
        <h2>@lang("pages.home.client_title") {{ Auth::user()->name }} !</h2>
        <p>@lang("pages.home.client_text")</p>
    </section>
    @endauth

    <section>
        <h2>@lang("pages.home.new_articles_title")</h2>
        <p>@lang("pages.home.articles_description")</p>

        <div class="card-container">
            @foreach($articles as $article)
                <a href="{{ route('articles.show', ['article' => $article->id]) }}" class="card">
                    <h3>{{ $article->title }}</h3>
                    <p>{{ $article->summary }}</p>
                </a>
            @endforeach
        </div>

    </section>

@endsection
<!-- End Main -->


<!-- Footer -->
@section("footer")
@endsection
<!-- End Main -->
