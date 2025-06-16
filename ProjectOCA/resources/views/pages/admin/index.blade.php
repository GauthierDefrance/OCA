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
    <h1>Admin</h1>
    <section class="flex-account-box">
        <section class="account-section">
            <h2>Bannir un utilisateur</h2>
            <form action="{{ route('admin.ban') }}" method="POST">
                @csrf
                <label for="ban_user_email">Email de l'utilisateur à bannir :</label>
                <input type="text" name="email" id="ban_user_email" required>
                <button type="submit">Bannir l'utilisateur</button>
            </form>
        </section>

        <section class="account-section">
            <h2>Dé-Bannir un utilisateur</h2>
            <form action="{{ route('admin.unban') }}" method="POST">
                @csrf
                <label for="unban_user_email">Email de l'utilisateur à dé-bannir :</label>
                <input type="text" name="email" id="unban_user_email" required>
                <button type="submit">Dé-bannir l'utilisateur</button>
            </form>
        </section>

        <section class="account-section">
            <h2>Supprimer un compte</h2>
            <form action="{{ route('admin.delete') }}" method="POST">
                @csrf
                <label for="delete_user_email">Email de l'utilisateur à supprimer :</label>
                <input type="text" name="email" id="delete_user_email" required>
                <button type="submit">Supprimer le compte</button>
            </form>
        </section>

        <section class="account-section">
            <h2>Créer un article</h2>
            <form action="{{ route('articles.create') }}" method="POST">
                @csrf

                <label for="title">Titre :</label>
                <input type="text" id="title" name="title" required>

                <label for="summary">Résumé :</label>
                <textarea id="summary" name="summary" required style="padding: 0.6rem 0.8rem; margin-bottom: 1.2rem; font-size: 1rem; border: 1.5px solid #ccc; border-radius: 6px; transition: border-color 0.3s ease; width: 100%; box-sizing: border-box;"></textarea>

                <label for="view_path">Fichier Blade lié :</label>
                <input type="text" id="view_path" name="view_path" placeholder="articles_list.NameOfTheArticles" required>

                <button type="submit">Créer l'article</button>
            </form>
        </section>
    </section>
@endsection

<!-- End Main -->


<!-- Footer -->
@section("footer")
@endsection
<!-- End Main -->
