<!DOCTYPE html>
<html>
<head>
    <title>Post Published</title>
</head>
<body>
    <h1>Hey Mr, {{ $post->user->name }}</h1>
    <p>A new post has been created with this title: <strong> {{ $post->title }}</strong></p>
</body>
</html>
