<section class="chat-window" style="display: none" id="invite" data-user-id="{{ auth()->user()->id }}">
    <h2>@lang("component.invite.title")</h2>
    <nav class="chat-actions" id="invitations-container">
        @if(!isset($invitations) || $invitations->isEmpty())
            <p>@lang("component.invite.no_invitation")</p>
        @else
            @foreach($invitations as $invite)
                <div class="group-invite">
                    <span class="group-name">{{ $invite->conversation->title ?? __("component.invite.untitled_group") }}</span>
                    <p>from <span class="group-name">{{$invite->sender->name}}</span></p>
                    <button class="invite-btn" data-group-id="{{ $invite->conversation_id }}" data-sender-id="{{ $invite->sender_id }}" data-recipient-id="{{ $invite->recipient_id }}">
                        @lang("component.invite.accept_invitation")
                    </button>
                    <button class="reject-btn" data-group-id="{{ $invite->conversation_id }}" data-sender-id="{{ $invite->sender_id }}" data-recipient-id="{{ $invite->recipient_id }}">
                        @lang("component.invite.reject_invitation")
                    </button>
                </div>
            @endforeach
        @endif
    </nav>
</section>
