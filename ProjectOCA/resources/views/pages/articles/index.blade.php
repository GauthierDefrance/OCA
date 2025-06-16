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
@endsection
<!-- End Header -->



<!-- Main -->
@section("main")
    <h1>Articles</h1>
    <section class="article-list">
        @forelse($articles as $article)
            <article class="article-card">
                <h2>{{ $article->title }}</h2>
                <p><strong>Publié le :</strong> {{ \Carbon\Carbon::parse($article->published_at)->format('d/m/Y') }}</p>
                <p>{{ $article->summary }}</p>
                <a href="{{ route('articles.show', ['article' => $article->id]) }}">Lire l'article complet</a>
            </article>
        @empty
            <p>Aucun article disponible pour le moment.</p>
        @endforelse
    </section>
@endsection
<!-- End Main -->


<!-- Footer -->
@section("footer")
@endsection
<!-- End Main -->
