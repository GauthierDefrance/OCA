@extends("layouts.base")

<!-- Head -->
@section("title", __("pages.connect.page_name"))
@section("meta_desc",__("pages.connect.page_description"))
@section("meta_author","I am the author.")

@push("styles")
    @vite(["resources/css/main.css",])
@endpush

@push("scripts")
    <script src="{{ asset('js/connect/LoginButton.js') }}" defer></script>
    @vite(["resources/js/connect/LoginButton.js",])
@endpush
<!-- End Head -->



<!-- Header -->
@section("header")
@endsection
<!-- End Header -->



<!-- Main -->
@section("main")
    <h1>@lang("pages.connect.title")</h1>
    <div class="button-box">
        <button id="button-login">@lang("pages.connect.Login")</button>
        <button id="button-register">@lang("pages.connect.Register")</button>
    </div>

    <section class="form-box" id="section-login">
        <h2>@lang("pages.connect.Login")</h2>

        <form action="/connect/login" method="POST" id="LoginForm">
            @csrf
            <div>
                <label for="login-email">@lang("pages.connect.LabelMail")</label>
                @error('email')
                <div class="error">@lang("pages.connect.LoginError")</div>
                @enderror
                <input name="email" id="login-email" type="email" placeholder="@lang("pages.connect.PlaceholderEmail")" required/>
            </div>

            <div>
                <label for="login-password">@lang("pages.connect.LabelPassword")</label>
                <input name="password" id="login-password" type="password" placeholder="" minlength="6" maxlength="24" required/>
            </div>

            <input type="submit" value="@lang("pages.connect.Confirm")"/>
        </form>
    </section>

    <section class="form-box" id="section-register">
        <h2>@lang("pages.connect.Register")</h2>

        <form action="/connect/register" method="POST" id="RegisterForm">
            @csrf
            <div>
                <label for="username">@lang("pages.connect.LabelUsername")</label>
                @error('username')
                <div class="error">{{ $message }}</div>
                @enderror
                <input name="username" id="username" type="text" placeholder="@lang("pages.connect.PlaceholderUsername")" minlength="6" maxlength="24" required/>
            </div>

            <div>
                <label for="email-register">@lang("pages.connect.LabelMail")</label>
                @error('email')
                <div class="error">{{ $message }}</div>
                @enderror
                <input name="email" id="email-register"  type="email" placeholder="@lang("pages.connect.PlaceholderEmail")" required/>
            </div>

            <div>
                <label for="firstpassword">@lang("pages.connect.LabelPassword")</label>
                @error('password')
                <div class="error">{{ $message }}</div>
                @enderror
                <input name="password" id="firstpassword" type="password" placeholder="" minlength="6" maxlength="24" required/>
            </div>

            <div>
                <label for="secondpassword">@lang("pages.connect.LabelPasswordConfirm")</label>
                @error('password_confirmation')
                <div class="error">{{ $message }}</div>
                @enderror
                <input name="password_confirmation" id="secondpassword" type="password" placeholder="" minlength="6" maxlength="24" required/>
            </div>

            <input type="submit" value="@lang("pages.connect.Confirm")"/>
        </form>
    </section>
@endsection
<!-- End Main -->


<!-- Footer -->
@section("footer")
@endsection
<!-- End Main -->
