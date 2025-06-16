@extends("layouts.base")

<!-- Head -->
@section("title",  __("pages.connect.page_name"))
@section("meta_desc", __("pages.connect.email_checker_desc"))
@section("meta_author","I am the author.")

@push("styles")
    @vite(["resources/css/main.css",])
@endpush

@push("scripts")
    <script src="{{ asset('js/LoginButton.js') }}" defer></script>
@endpush
<!-- End Head -->



<!-- Header -->
@section("header")
@endsection
<!-- End Header -->



<!-- Main -->
@section("main")
    <h1>@lang("pages.connect.title")</h1>
    <section class="form-box" id="section-login">
        <h2>@lang("pages.connect.email_check_title")</h2>

        @if($errors->any())
            <div class="errors">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="/connect/check_email" method="POST" id="CheckForm">
            @csrf
            <div>
                <label for="login-email">@lang("pages.connect.your_email")</label>
                <input name="email" id="login-email" type="email" placeholder="@lang("pages.connect.PlaceholderEmail")" required/>
            </div>

            <div>
                <label for="login-code">@lang("pages.connect.your_code")</label>
                <input name="code" id="login-code" type="text" placeholder="xxxxxxxxxx" minlength="10" maxlength="10" required/>
            </div>

            <input type="submit" value="@lang("pages.connect.Confirm")"/>
        </form>

        <a href="{{ route("connect.ask_check_email") }}">@lang("pages.connect.ask_for_link")</a>
    </section>
@endsection
<!-- End Main -->


<!-- Footer -->
@section("footer")
@endsection
<!-- End Main -->
