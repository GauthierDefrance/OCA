<section class="chat-window" id="chat" style="display: none" data-user-name="{{ auth()->user()->name }}">
    <h2>@lang("component.chat.title")</h2>
    <nav class="chat-actions">
        <span class="group-name" id="group-name">@lang("component.chat.group_name")</span>

        <a id="list-group" href="#">
            <img src="/icons/group.svg" alt="Charts" width="24" height="24" class="icon"/>
            @lang("component.chat.members")
        </a>

        <a id="add-group" href="/channels/{id}/add-channel">
            <img src="/icons/user-plus.svg" alt="Charts" width="24" height="24" class="icon"/>
            @lang("component.chat.add")
        </a>

        <a id="leave-group" href="/channels/{id}/quit-channel">
            <img src="/icons/door-open.svg" alt="Charts" width="24" height="24" class="icon"/>
            @lang("component.chat.leave")
        </a>
    </nav>

    <div class="messages" id="message-block">
        @if(!empty($messageContent))
            {{ $messageContent }}
        @endif
    </div>

    <form class="message-sender" action="api/channels/" method="POST">
        @csrf
        <input type="text" name="message" placeholder="@lang("component.chat.write")" required autocomplete="off" />
        <button type="submit">
            <img src="/icons/send.svg" alt="Charts" width="24" height="24" class="icon"/>
        </button>
    </form>

</section>
