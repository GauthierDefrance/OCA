@extends("layouts.base")

<!-- Head -->
@section("title", __("pages.add.page_name"))
@section("meta_desc", __("pages.add.page_description"))
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
    <h1>@lang("pages.add.title")</h1>
    <section>
        <h2>@lang("pages.add.send_new_invite")</h2>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if($errors->any())
            <div class="alert alert-danger">
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form class="form-box" method="POST" action="{{ url("api/channels/{$conversation->id}/add-member") }}">
            @csrf
            <label for="recipient_email" style="color: black">@lang("pages.add.email") :</label><br>
            <input type="email" name="recipient_email" id="recipient_email" required><br><br>

            <input type="hidden" name="redirect" value="1">
            <button type="submit" class="btn btn-primary">@lang("pages.add.send")</button>
        </form>
    </section>

    <section>
        <h2>@lang("pages.add.invite_list")</h2>
        @if($invitations->isEmpty())
            <p>@lang("pages.add.no_invite_found")</p>
        @else
            <ul class="list-container">
                @foreach ($invitations as $invitation)
                    <li>
                        {{ $invitation->recipient->email ?? __("pages.add.unknow") }}
                    </li>
                @endforeach
            </ul>
        @endif
    </section>

@endsection

<!-- End Main -->


<!-- Footer -->
@section("footer")
@endsection
<!-- End Main -->
