@extends("layouts.base")

<!-- Head -->
@section("title","Home")
@section("meta_desc","This is the description.")
@section("meta_author","I am the author.")

@push("styles")
    @vite(["resources/css/main.css",])
@endpush

@push("scripts")

@endpush
<!-- End Head -->



<!-- Header -->
@section("header")

@endsection
<!-- End Header -->



<!-- Main -->
@section("main")
    <h1>Members group list</h1>
    <section>
        <h2>Membres du groupe : {{ $conversationName }}</h2>
        <p>{{$conversationDescription}}</p>
        <ul>
            @foreach ($members as $member)
                <li>
                    {{ $member->name }} ({{ $member->email }})
                    @if ($member->pivot->isModerator)
                        <strong> - Modérateur</strong>
                    @endif

                    @if ($isModerator && $member->id !==auth()->id())
                    <button data-set-conversation-id="{{ $conversationId }}" data-set-id="{{$member->id}}">Kick</button>
                    @endif
                </li>
            @endforeach
        </ul>
    </section>
@endsection
<!-- End Main -->


<!-- Footer -->
@section("footer")
@endsection
<!-- End Main -->
