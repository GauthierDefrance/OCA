@extends("layouts.base")

<!-- Head -->
@section("title", __("pages.account.page_name"))
@section("meta_desc", __("pages.account.page_description"))
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
    <h1>@lang("pages.account.title")</h1>

    <section class="flex-account-box">
        <section class="account-section">
            <h2>@lang("pages.account.change_username")</h2>
            <form method="POST" action="{{ url('/account/change-username') }}">
                @csrf
                <label for="username">@lang("pages.account.new_username"):</label>
                <input type="text" name="username" id="username" minlength="3" maxlength="24" required>
                <button type="submit">@lang("pages.account.update_username")</button>
            </form>
        </section>

        <section class="account-section">
            <h2>@lang("pages.account.change_password")</h2>
            <form method="POST" action="{{ url('/account/change-password') }}">
                @csrf
                <label for="password">@lang("pages.account.new_password"):</label>
                <input type="password" name="password" id="password" required>

                <label for="password_confirmation">@lang("pages.account.confirm_password"):</label>
                <input type="password" name="password_confirmation" id="password_confirmation" required>

                <button type="submit">@lang("pages.account.update_password")</button>
            </form>
        </section>
    </section>
@endsection
<!-- End Main -->


<!-- Footer -->
@section("footer")
@endsection
<!-- End Main -->
