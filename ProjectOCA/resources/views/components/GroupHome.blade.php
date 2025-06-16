<section class="chat-window" id="home">
    <h2>@lang("component.home.title")</h2>
    <nav class="chat-actions">
        <span class="group-name">
           <img src="/icons/group.svg" alt="Charts" width="24" height="24" class="icon"/> @lang("component.home.account_name") : <span id="account-name">{{ auth()->user()->name }}</span>
        </span>
    </nav>

</section>
