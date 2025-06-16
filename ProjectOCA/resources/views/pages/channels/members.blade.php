@extends("layouts.base")

<!-- Head -->
@section("title", __("pages.members.page_name"))
@section("meta_desc", __("pages.members.page_description"))
@section("meta_author","I am the author.")

@push("styles")
    @vite(["resources/css/main.css",'resources/css/members.css',])
@endpush

@push("scripts")
    @vite(["resources/js/channels/KickUser.js",])
@endpush
<!-- End Head -->



<!-- Header -->
@section("header")

@endsection
<!-- End Header -->



<!-- Main -->
@section("main")
    <h1 class="group-members__title">@lang("pages.members.title")</h1>
    <section class="group-members">
        <h2 class="group-members__heading">@lang("pages.members.members_of_group") : {{ $conversationName }}</h2>
        <p class="group-members__desc">{{ $conversationDescription }}</p>
        <p id="error" class="group-members__error"></p>
        <ul class="group-members__list">
            @foreach ($members as $member)
                <li class="group-members__item">
                    <span>{{ $member->name }} ({{ $member->email }})</span>
                    <span>
                    @if ($member->pivot->isModerator)
                            <strong class="group-members__badge"> - @lang("pages.members.moderator")</strong>
                        @endif
                        @if ($isModerator && !$member->pivot->isModerator && $member->id !== auth()->id())
                            <button class="kick-btn" data-user-id="{{ $member->id }}">@lang("pages.members.kick")</button>
                        @else
                            <button class="kick-btn" disabled>@lang("pages.members.kick")</button>
                        @endif
                </span>
                </li>
            @endforeach
        </ul>
        <input type="hidden" id="conversation-id" value="{{ $conversationId }}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
    </section>
@endsection
<!-- End Main -->


<!-- Footer -->
@section("footer")
@endsection
<!-- End Main -->
