@extends("layouts.base")

<!-- Head -->
@section("title",  __("pages.connect.page_name"))
@section("meta_desc", __("pages.connect.email_sender_desc"))
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
        <h2>@lang("pages.connect.input_email")</h2>

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
                <label for="login-email">@lang("pages.connect.your_email")</label>
                <input name="email" id="login-email" type="email" placeholder="@lang("pages.connect.PlaceholderEmail")" required/>
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
