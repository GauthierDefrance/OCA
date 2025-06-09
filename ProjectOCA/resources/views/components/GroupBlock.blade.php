<section class="chat-window" id="block" style="display: none">
    <h2>Block Menu</h2>
    <p id="error-block"></p>
    <nav class="chat-actions" style="background-color: white">
        <form action="/block-email" method="POST" class="block-form">
            @csrf
            <label for="email-to-block">Email à bloquer</label>
            <input type="email" id="email-to-block" name="email-to-block" placeholder="Entrez l'email à bloquer" required>
            <button type="submit" id="block-btn">Bloquer</button>
        </form>
    </nav>
    <section id="banned-list">
        <h3>Blocked list</h3>
        @forelse ($blockedUsers as $blockedUser)
            <div class="blocked-user">
                <p>{{ $blockedUser->name }}</p>
                <p>{{ $blockedUser->email }}</p>
                <button class="unblock-btn" data-blocked-user-id="{{ $blockedUser->id }}">Unblock</button>
            </div>
        @empty
            <p>Aucun utilisateur bloqué.</p>
        @endforelse
    </section>
</section>
