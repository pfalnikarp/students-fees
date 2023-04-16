<!DOCTYPE html>
<html>
<head>
    <title>Student Creation Form</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha256-aAr2Zpq8MZ+YA/D6JtRD3xtrwpEz2IqOS+pWD/7XKIw=" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha256-OFRAJNoaD8L3Br5lglV7VyLRf0itmoBzWUoM+Sji4/8=" crossorigin="anonymous"></script>

</head>
<body>
<div class="container">

    <nav class="navbar navbar-inverse">
        <div class="navbar-header">
            <a class="navbar-brand" href="{{ URL::to('students') }}">Student Alert</a>
        </div>
        <ul class="nav navbar-nav">
            <li><a href="{{ URL::to('students') }}">View All students</a></li>
            <li><a href="{{ URL::to('students/create') }}">Create Student</a>
        </ul>
    </nav>

    <h1>Create Student</h1>

    <!-- if there are creation errors, they will show here -->


    {{ Form::open(array('url' => 'students', 'enctype'=>"multipart/form-data")) }}
    @csrf
    <div class="form-group">
        {{ Form::label('name', 'Name') }}
        {{ Form::text('name') }}
    </div>

    <div class="form-group">
        {{ Form::label('dob', 'Date of Birth') }}
        {{ Form::date('dob') }}
    </div>

    <div class="form-group">
        {{ Form::label('gender', 'Gender') }}
        {{ Form::select('gender', array('Male' => 'Male', '1' => 'Female') ) }}
    </div>

    <div class="form-group">
        {{ Form::label('profile_pic', 'Profile Picture') }}
        {{ Form::file('profile_pic') }}
    </div>

    <div class="form-group">
        {{ Form::label('course', 'Course') }}
        {{ Form::text('course') }}
    </div>

    <div class="form-group">
        {{ Form::label('fees', 'fees') }}
        {{ Form::text('fees') }}
    </div>

    {{ Form::submit('Create Student', array('class' => 'btn btn-primary')) }}

    {{ Form::close() }}

</div>
</body>
</html>
