
<!DOCTYPE html>
<html>
<head>
    <title>Note Taking App</title>
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
    <script>function truncate(str) {
        let n = 200;
        let s = (str.length > n) ? str.substr(0, n-1) + '&hellip;' : str;
        document.write(s);
        }
    </script>
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

    <h1>All the notes</h1>

    <!-- will be used to show any messages -->
    @if (Session::has('message'))
        <div class="alert alert-info">{{ Session::get('message') }}</div>
    @endif

    <table class="table table-striped table-bordered">
        <thead>
        <tr>
        </tr>
        </thead>
        <tbody>
        @foreach($notes as $key => $value)
            <tr>
                <td >
                    <a href="{{ URL::to('notes/' . $value->id) }}">
                        <script>
                            var jsString = "<?php
                                echo str_replace(array("\n","\r","\r\n"),'',$value->content);?>";
                            truncate(jsString);
                        </script>
                    </a>

                </td>
                <td>
                    <a class="btn btn-small btn-info" href="{{ URL::to('notes/' . $value->id) }}">View this note</a>
                    <a class="btn btn-small btn-info" href="{{ URL::to('notes/' . $value->id . '/edit') }}">Edit this note</a>

                    {{ Form::open(array('url' => 'notes/' . $value->id)) }}
                    {{ Form::hidden('_method', 'DELETE') }}
                    {{ Form::submit('Delete this note', array('class' => 'btn btn-warning')) }}
                    {{ Form::close() }}

                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

</div>
</body>
</html>
