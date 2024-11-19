<!DOCTYPE html>
<html>
<head>
    <title>Post Published</title>
</head>
<body>
    <h1>Hey Mr, {{ $post->user->name }}</h1>
    <p> your Post has been updated with title <strong> {{ $post->title }}</strong></p>
</body>
</html>
