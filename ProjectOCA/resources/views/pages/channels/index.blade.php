@extends("layouts.base")

<!-- Head -->
@section("title", __("pages.channels.page_name"))
@section("meta_desc", __("pages.channels.page_description"))
@section("meta_author","I am the author.")

@push("styles")
    @vite(["resources/css/main.css",])
@endpush

@push("scripts")
    @vite(["resources/js/echo.js",
            "resources/js/channels/MenuMover.js",
            "resources/js/channels/ChatLoader.js",
            "resources/js/channels/MessageSender.js",
            "resources/js/channels/InvitationScripts.js",
            "resources/js/channels/BlockScript.js",
           ])
@endpush
<!-- End Head -->



<!-- Header -->
@section("header")
@endsection
<!-- End Header -->



<!-- Main -->
@section("main")
    <h1>@lang("pages.channels.title")</h1>
    <section class="chat-container">
        <section class="sidebar-menu">
            <h2 class="menu-title">@lang("pages.channels.sidebar-menu-title")</h2>
            <hr/>
            <nav class="menu-links">
                <button id="home-btn">
                    <img src="/icons/house-user.svg" alt="Home" width="24" height="24" class="icon"/>
                    @lang("pages.channels.home-btn")
                </button>

                <button id="creategroup-btn">
                    <img src="/icons/address-book.svg" alt="Create a new chat" width="24" height="24" class="icon"/>
                    @lang("pages.channels.creategroup-btn")
                </button>

                <button id="invite-btn">
                    <img src="/icons/envelope.svg" alt="Your invitations" width="24" height="24" class="icon"/>
                    @lang("pages.channels.invitation-btn")
                </button>

                <button id="block-btn">
                    <img src="/icons/ban-hammer.svg" alt="Block" width="24" height="24" class="icon"/>
                    @lang("pages.channels.block-btn")
                </button>
            </nav>

            <hr/>

            <nav class="menu-links" id="channels">
                @foreach($groups as $group)
                    <button data-group-id="{{$group->id}}" class="group-selector-button" value="{{ url('api/channels', ['id' => $group->id]) }}">{{ $group->title ?? __("pages.channels.group_without_title") }}</button>
                @endforeach

                @if($groups->isEmpty())
                    <p>@lang("pages.channels.no_group_found")</p>
                @endif
            </nav>
        </section>

        @include("components.GroupHome")
        @include("components.GroupCreateChat")
        @include("components.GroupInvite")
        @include("components.GroupBlock")
        @include("components.GroupChat")

    </section>
@endsection
<!-- End Main -->


<!-- Footer -->
@section("footer")
@endsection
<!-- End Main -->
