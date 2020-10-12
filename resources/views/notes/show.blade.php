<!DOCTYPE html>
<html>
<head>
    <title>Note Taking App</title>
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
</head>
<body>
<div class="container">

    <nav class="navbar navbar-inverse">
        <div class="navbar-header">
            <a class="navbar-brand" href="{{ URL::to('notes') }}">Notes</a>
        </div>
        <ul class="nav navbar-nav">
            <li><a href="{{ URL::to('notes') }}">View all notes</a></li>
            <li><a href="{{ URL::to('notes/create') }}">Create a note</a>
        </ul>
    </nav>
    <div class="jumbotron text-align-left">
        <p>
            {{ $note->content }}
        </p>
    </div>
</div>
</body>
</html>
