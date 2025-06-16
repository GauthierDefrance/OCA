<section class="chat-window" id="block" style="display: none">
    <h2>@lang("component.block.title")</h2>
    <p id="error-block"></p>
    <nav class="chat-actions" style="background-color: white">
        <form action="/block-email" method="POST" class="block-form">
            @csrf
            <label for="email-to-block">@lang("component.block.email_to_block")</label>
            <input type="email" id="email-to-block" name="email-to-block" placeholder="@lang("component.block.input_to_block")" required>
            <button type="submit" id="block-btn">@lang("component.block.block")</button>
        </form>
    </nav>
    <section id="banned-list">
        <h3>@lang("component.block.title")</h3>
        @forelse ($blockedUsers as $blockedUser)
            <div class="blocked-user">
                <p>{{ $blockedUser->name }}</p>
                <p>{{ $blockedUser->email }}</p>
                <button class="unblock-btn" data-blocked-user-id="{{ $blockedUser->id }}">Unblock</button>
            </div>
        @empty
            <p>@lang("component.block.no_user_blocked")</p>
        @endforelse
    </section>
</section>
