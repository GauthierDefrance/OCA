<section class="chat-window" id="block" style="display: none">
    <h2>Block Menu</h2>
    <nav class="chat-actions">
        <form action="/block-email" method="POST" class="block-form">
            <label for="email-to-block">Email à bloquer</label>
            <input type="email" id="email-to-block" name="email-to-block" placeholder="Entrez l'email à bloquer" required>
            <button type="submit">Bloquer</button>
        </form>
    </nav>
    <section id="banned-list">
        <!-- Les emails bloqués s'afficheront ici -->
    </section>
</section>
