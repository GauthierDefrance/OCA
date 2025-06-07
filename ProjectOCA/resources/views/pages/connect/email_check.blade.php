@extends("layouts.base")

<!-- Head -->
@section("title","Home")
@section("meta_desc","This is the description.")
@section("meta_author","I am the author.")

@push("styles")
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
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

    <section class="form-box" id="section-login">
        <h2>Check your Mail</h2>

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
                <label for="login-email">Your email</label>
                <input name="email" id="login-email" type="email" placeholder="@lang("loginforms.PlaceholderEmail")" required/>
            </div>

            <div>
                <label for="login-code">Your code</label>
                <input name="code" id="login-code" type="text" placeholder="xxxxxxxxxx" minlength="10" maxlength="10" required/>
            </div>

            <input type="submit" value="@lang("loginforms.Confirm")"/>
        </form>

        <a href="{{ route("connect.ask_check_email") }}">Give me a new link !</a>
    </section>
@endsection
<!-- End Main -->


<!-- Footer -->
@section("footer")
@endsection
<!-- End Main -->
