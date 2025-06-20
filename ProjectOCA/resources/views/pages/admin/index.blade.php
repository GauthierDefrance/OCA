@extends("layouts.base")

<!-- Head -->
@section("title", __("pages.admin.title"))
@section("meta_desc", __("pages.admin.meta_desc"))
@section("meta_author", __("pages.admin.meta_author"))

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
    <h1>@lang('pages.admin.admin')</h1>
    <section class="flex-account-box">
        <section class="account-section">
            <h2>@lang('pages.admin.ban_user_title')</h2>
            <form action="{{ route('admin.ban') }}" method="POST">
                @csrf
                <label for="ban_user_email">@lang('pages.admin.ban_user_email_label')</label>
                <input type="text" name="email" id="ban_user_email" required>
                <button type="submit">@lang('pages.admin.ban_user_button')</button>
            </form>
        </section>

        <section class="account-section">
            <h2>@lang('pages.admin.unban_user_title')</h2>
            <form action="{{ route('admin.unban') }}" method="POST">
                @csrf
                <label for="unban_user_email">@lang('pages.admin.unban_user_email_label')</label>
                <input type="text" name="email" id="unban_user_email" required>
                <button type="submit">@lang('pages.admin.unban_user_button')</button>
            </form>
        </section>

        <section class="account-section">
            <h2>@lang('pages.admin.delete_account_title')</h2>
            <form action="{{ route('admin.delete') }}" method="POST">
                @csrf
                <label for="delete_user_email">@lang('pages.admin.delete_account_email_label')</label>
                <input type="text" name="email" id="delete_user_email" required>
                <button type="submit">@lang('pages.admin.delete_account_button')</button>
            </form>
        </section>

        <section class="account-section">
            <h2>@lang('pages.admin.create_article_title')</h2>
            <form action="{{ route('articles.create') }}" method="POST">
                @csrf

                <label for="title">@lang('pages.admin.article_title_label')</label>
                <input type="text" id="title" name="title" required>

                <label for="summary">@lang('pages.admin.article_summary_label')</label>
                <textarea id="summary" name="summary" required style="padding: 0.6rem 0.8rem; margin-bottom: 1.2rem; font-size: 1rem; border: 1.5px solid #ccc; border-radius: 6px; transition: border-color 0.3s ease; width: 100%; box-sizing: border-box;"></textarea>

                <label for="view_path">@lang('pages.admin.article_view_path_label')</label>
                <input type="text" id="view_path" name="view_path" placeholder="@lang('pages.admin.article_view_path_placeholder')" required>

                <button type="submit">@lang('pages.admin.create_article_button')</button>
            </form>
        </section>
    </section>
@endsection
<!-- End Main -->

<!-- Footer -->
@section("footer")
@endsection
<!-- End Footer -->
