@foreach($posts as $post)
    <div>
        <p>{{ $post->body }}</p>
        <form action="/posts/{{ $post->id }}/like" method="post" style="display: inline">
            @csrf
            <input type="submit" name="like" value="like">
            <span>{{ $post->likes  }} likes</span>
        </form>
        <form action="/posts/{{ $post->id }}/dislike" method="post" style="display: inline">
            @csrf
            <input type="submit" name="dislike" value="dislike">
            <span>{{ $post->dislikes  }} dislikes</span>
        </form>
    </div>
@endforeach
