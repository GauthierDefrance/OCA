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
    <h1>Home page</h1>

    @guest()
    <section>
        <h2>Welcome on OCA</h2>
        <p>In order to begin your adventure you should sign in !</p>
    </section>
    @endguest

    @auth()
    <section>
        <h2>Welcome back {{ Auth::user()->name }} !</h2>
        <p>Content of the section</p>
    </section>
    @endauth

    <section>
        <h2>New articles</h2>
        <p>Content of the section</p>

        <div class="card-container">
            <a href="URL" class="card">
                <h3>Carte 1</h3>
                <p>Description de la carte 1.</p>
            </a>
            <a href="URL" class="card">
                <h3>Carte 2</h3>
                <p>Description de la carte 2.</p>
            </a>
            <a href="URL" class="card">
                <h3>Carte 3</h3>
                <p>Description de la carte 3.</p>
            </a>
            <a href="URL" class="card">
                <h3>Carte 4</h3>
                <p>Description de la carte 4. </p>
            </a>
        </div>

    </section>

@endsection
<!-- End Main -->


<!-- Footer -->
@section("footer")
@endsection
<!-- End Main -->
