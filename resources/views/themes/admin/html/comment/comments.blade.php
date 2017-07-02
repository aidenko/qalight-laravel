@if ($comments->isEmpty())
    No comments
@else
    <div class="row">
        @foreach($comments as $comment)
            <div class="col s12">
                <div class="card grey lighten-4" data-comment-id="{{$comment->id}}">
                    <div class="card-content">
                        <span class="card-title">{{$comment->user->name}}, {{$comment->created_at}}</span>
                        {{$comment->text}}
                    </div>
                    <div class="card-action">
                        <button class="btn-flat">
                            <i class="material-icons left">mode_edit</i>Edit
                        </button>
                        <button class="btn-flat">
                            <i class="material-icons left">delete</i>
                            Delete
                        </button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif