<section class="chat-window" style="display: none" id="invite" data-user-id="{{ auth()->user()->id }}">
    <h2>Group invite list</h2>
    <nav class="chat-actions" id="invitations-container">
        @if(!isset($invitations) || $invitations->isEmpty())
            <p>No invitations at the moment.</p>
        @else
            @foreach($invitations as $invite)
                <div class="group-invite">
                    <span class="group-name">{{ $invite->conversation->title ?? 'Untitled Group' }}</span>
                    <p>from <span class="group-name">{{$invite->sender->name}}</span></p>
                    <button class="invite-btn" data-group-id="{{ $invite->conversation_id }}" data-sender-id="{{ $invite->sender_id }}" data-recipient-id="{{ $invite->recipient_id }}">
                        accept
                    </button>
                    <button class="reject-btn" data-group-id="{{ $invite->conversation_id }}" data-sender-id="{{ $invite->sender_id }}" data-recipient-id="{{ $invite->recipient_id }}">
                        reject
                    </button>
                </div>
            @endforeach
        @endif
    </nav>
</section>
