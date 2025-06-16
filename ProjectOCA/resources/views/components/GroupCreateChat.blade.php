<section class="chat-window" style="display: none" id="creategroup">
    <h2>@lang("component.create.title")</h2>
<form action="{{ route('api.create_group') }}" method="POST" class="group-create-form">
    @csrf
    <label for="title">@lang("component.create.group_title") <span style="color:red;">*</span></label>
    <input type="text" id="title" name="title" required maxlength="64" placeholder="@lang("component.create.enter_group_title")" />


    <label for="description">@lang("component.create.group_description")</label>
    <textarea id="description" name="description" rows="4" maxlength="255" placeholder="@lang("component.create.group_desc_placeholder")"></textarea>

    <input type="hidden" name="redirect_after" value="1" />
    <button type="submit">@lang("component.create.create_group")</button>
</form>
</section>
