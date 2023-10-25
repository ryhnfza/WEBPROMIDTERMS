@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <h2 class="mb-3">{{ $post->title }}</h2>
            <p>{{ $post->content }}</p>
            
            <h3 class="mt-5 mb-3">Comments:</h3>
            @foreach($post->comments as $comment)
                <div class="card mb-3">
                    <div class="card-body">
                        {{ $comment->body }} - By {{ $comment->user->name }}
                    </div>
                </div>
            @endforeach

            <!-- Form untuk menambahkan komentar -->
            <div class="card mt-5">
                <div class="card-header">Add Comment</div>
                <div class="card-body">
                    <form action="{{ route('comments.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="post_id" value="{{ $post->id }}">
                        <div class="form-group">
                            <textarea name="body" class="form-control" rows="3" placeholder="Your comment..."></textarea>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary">Add Comment</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
