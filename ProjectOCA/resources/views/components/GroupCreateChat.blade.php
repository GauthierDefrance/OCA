<section class="chat-window" style="display: none" id="creategroup">
    <h2>Create a new group</h2>
<form action="{{ route('api.create_group') }}" method="POST" class="group-create-form">
    @csrf
    <h3>Create a New Group</h3>

    <label for="title">Group Title <span style="color:red;">*</span></label><br/>
    <input type="text" id="title" name="title" required maxlength="64" placeholder="Enter group title" />

    <br/><br/>

    <label for="description">Description</label><br/>
    <textarea id="description" name="description" rows="4" maxlength="255" placeholder="Describe your group (optional)"></textarea>

    <br/><br/>
    <input type="hidden" name="redirect_after" value="1" />
    <button type="submit">Create Group</button>
</form>
</section>
