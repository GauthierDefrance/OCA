<section class="chat-window" style="display: none" id="invite">
    <h2>Group invite list</h2>
    <nav class="chat-actions">
        @if(!isset($invitations) || $invitations->isEmpty())
            <p>No invitations at the moment.</p>
        @else
            @foreach($invitations as $invite)
                <button class="invite-btn" data-group-id="{{ $invite->id }}">
                    {{ $invite->title ?? 'Untitled Group' }}
                </button>
            @endforeach
        @endif
    </nav>
</section>
