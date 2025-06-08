<section class="chat-window" style="display: none" id="invite">
    <h2>Group invite list</h2>
    <nav class="chat-actions">
        @if(!isset($invitations) || $invitations->isEmpty())
            <p>No invitations at the moment.</p>
        @else
            @foreach($invitations as $invite)
                <span class="group-name">{{ $invite->conversation->title ?? 'Untitled Group' }}</span>
                <p>from <span class="group-name">{{$invite->sender->name}}</span></p>
                <button class="invite-btn" data-group-id="{{ $invite->conversation_id }}" data-sender-id="{{ $invite->sender_id }}" data-recipient-id="{{ $invite->recipient_id }}">
                    accept
                </button>
                <button class="reject-btn" data-group-id="{{ $invite->id }}">
                    reject
                </button>
            @endforeach
        @endif
    </nav>
</section>
