@extends("layouts.base")

<!-- Head -->
@section("title","Home")
@section("meta_desc","This is the description.")
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
    <h1>Invitations envoyées</h1>

    @if($invitations->isEmpty())
        <p>Aucune invitation envoyée pour le moment.</p>
    @else
        <ul>
            @foreach ($invitations as $invitation)
                <li>
                    {{ $invitation->recipient->email ?? 'Email inconnu' }}
                    — Statut : {{ ucfirst($invitation->status) }}
                </li>
            @endforeach
        </ul>
    @endif
    <h2>Envoyer une nouvelle invitation</h2>
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
        <label for="recipient_email" style="color: black">Email de l'utilisateur à inviter :</label><br>
        <input type="email" name="recipient_email" id="recipient_email" required><br><br>

        <input type="hidden" name="redirect" value="1">
        <button type="submit" class="btn btn-primary">Envoyer l'invitation</button>
    </form>

@endsection

<!-- End Main -->


<!-- Footer -->
@section("footer")
@endsection
<!-- End Main -->
