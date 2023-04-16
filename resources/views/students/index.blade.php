<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" >
</head>
<body>
<div class="container mt-2">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Students List</h2>
            </div>
            <div class="pull-right mb-2">
                <a class="btn btn-success" href="{{ route('students.create') }}"> Create Student</a>
            </div>
        </div>
    </div>
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>S.No</th>
            <th>Student Name</th>
            <th>Student Email</th>
            <th>Student Profile Pict</th>
            <th width="280px">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($students as $t)
            <tr>
                <td>{{ $t->id }}</td>
                <td>{{ $t->name }}</td>
                <td>{{ $t->email }}</td>
                <td><img src="{{ asset('/uploads/'.$t->profile_pic) }}" alt="" title=""></td>
                <td>
                    <form action="{{ route('students.destroy',$t->id) }}" method="Post">
                        <a class="btn btn-primary" href="{{ route('students.edit',$t->id) }}">Edit</a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {!! $students->links() !!}
</div>
</body>
</html>
