@extends("layouts.base")

<!-- Head -->
@section("title","Home")
@section("meta_desc","This is the description.")
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

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <section class="form-box" id="section-login">
        <h2>Input your mail</h2>

        @if($errors->any())
            <div class="errors">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="/connect/email_sender" method="POST" id="CheckForm">
            @csrf
            <div>
                <label for="login-email">Your email</label>
                <input name="email" id="login-email" type="email" placeholder="@lang("loginforms.PlaceholderEmail")" required/>
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
