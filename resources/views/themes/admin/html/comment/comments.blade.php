@if ($comments->isEmpty())
    No comments
@else
    <div class="row">
        @foreach($comments as $comments)
            <div class="col s12">
                <div class="card grey lighten-4">
                    <div class="card-content">
                        {{$comments->text}}
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif