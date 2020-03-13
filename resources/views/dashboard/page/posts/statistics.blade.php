@extends('@admin::dashboard.entity')

@section('content')
    <h2>Statistics page</h2>
    <p>Post ID: {{ $post->id }}</p>
    <p>Tags count: {{ $post->tags()->count() }}</p>
    <p>Videos count: {{ $post->videos()->count() }}</p>
    
    <a href="javascript:" class="button">Delete this post</a>
@endsection
