@extends("layouts.base")

<!-- Head -->
@section("title","Home")
@section("meta_desc","This is the description.")
@section("meta_author","I am the author.")

@push("styles")
    @vite(["resources/css/main.css",])
@endpush

@push("scripts")
    @vite(["resources/js/connect/LoginButton.js",])
@endpush
<!-- End Head -->



<!-- Header -->
@section("header")
@endsection
<!-- End Header -->



<!-- Main -->
@section("main")

    <div class="button-box">
        <button id="button-login">@lang("loginforms.Login")</button>
        <button id="button-register">@lang("loginforms.Register")</button>
    </div>

    <section class="form-box" id="section-login">
        <h2>@lang("loginforms.Login")</h2>

        <form action="/connect/login" method="POST" id="LoginForm">
            @csrf
            <div>
                <label for="login-email">@lang("loginforms.LabelMail")</label>
                @error('email')
                <div class="error">@lang("loginforms.LoginError")</div>
                @enderror
                <input name="email" id="login-email" type="email" placeholder="@lang("loginforms.PlaceholderEmail")" required/>
            </div>

            <div>
                <label for="login-password">@lang("loginforms.LabelPassword")</label>
                <input name="password" id="login-password" type="password" placeholder="" minlength="6" maxlength="24" required/>
            </div>

            <input type="submit" value="@lang("loginforms.Confirm")"/>
        </form>
    </section>

    <section class="form-box" id="section-register">
        <h2>@lang("loginforms.Register")</h2>

        <form action="/connect/register" method="POST" id="RegisterForm">
            @csrf
            <div>
                <label for="username">@lang("loginforms.LabelUsername")</label>
                @error('username')
                <div class="error">{{ $message }}</div>
                @enderror
                <input name="username" id="username" type="text" placeholder="@lang("loginforms.PlaceholderUsername")" minlength="6" maxlength="24" required/>
            </div>

            <div>
                <label for="email-register">@lang("loginforms.LabelMail")</label>
                @error('email')
                <div class="error">{{ $message }}</div>
                @enderror
                <input name="email" id="email-register"  type="email" placeholder="@lang("loginforms.PlaceholderEmail")" required/>
            </div>

            <div>
                <label for="firstpassword">@lang("loginforms.LabelPassword")</label>
                @error('password')
                <div class="error">{{ $message }}</div>
                @enderror
                <input name="password" id="firstpassword" type="password" placeholder="" minlength="6" maxlength="24" required/>
            </div>

            <div>
                <label for="secondpassword">@lang("loginforms.LabelPasswordConfirm")</label>
                @error('password_confirmation')
                <div class="error">{{ $message }}</div>
                @enderror
                <input name="password_confirmation" id="secondpassword" type="password" placeholder="" minlength="6" maxlength="24" required/>
            </div>

            <input type="submit" value="@lang("loginforms.Confirm")"/>
        </form>
    </section>
@endsection
<!-- End Main -->


<!-- Footer -->
@section("footer")
@endsection
<!-- End Main -->
