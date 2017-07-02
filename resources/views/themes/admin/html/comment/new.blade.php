<form class="col s12" onsubmit="return false">
    {{csrf_field()}}
    <input type="hidden" name="type" value="{{$commentable_type}}">
    <input type="hidden" name="id" value="{{$commentable_id}}">

    <div class="input-field">
        <textarea name="comment" class="materialize-textarea" id="comment"></textarea>
        <label for="comment">Comment</label>
    </div>

    <br>
    <button class="btn waves-effect waves-light" type="button" name="action">
        Add comment
        <i class="material-icons left">add_circle</i>
    </button>
</form>