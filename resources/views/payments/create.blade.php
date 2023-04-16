<!DOCTYPE html>
<html>
<head>
    <title>Student Creation Form</title>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha256-aAr2Zpq8MZ+YA/D6JtRD3xtrwpEz2IqOS+pWD/7XKIw=" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha256-OFRAJNoaD8L3Br5lglV7VyLRf0itmoBzWUoM+Sji4/8=" crossorigin="anonymous"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        input#balance
        {
            color: red;
        }
        .receipt {
            display: none;
        }
    </style>
</head>
<body>
<div class="container">

    <nav class="navbar navbar-inverse">
        <div class="navbar-header">
            <a class="navbar-brand" href="{{ URL::to('payments') }}">Student Payments</a>
        </div>
        <ul class="nav navbar-nav">
            <li><a href="{{ URL::to('payments') }}">View All students</a></li>
            <li><a href="{{ URL::to('payments/create') }}">Create Student</a>
        </ul>
    </nav>

    <h1>Payment Entry</h1>

    <!-- if there are creation errors, they will show here -->

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div>{{$error}}</div>
        @endforeach
    @endif


    {{ Form::open(array('url' => 'payments', 'id'=>"payment-screen" ,)) }}
    @csrf
    <div class="form-group">
        {{ Form::label('payment_id', 'Payment ID') }}
        {{ Form::text('payment_id') }}
    </div>

    <div class="form-group">
        {{ Form::label('student_id', 'Select Student') }}
        <select class= "sel-student" name = "student_id">
            @foreach($students as $s)
             <option value = "{{ $s->id }}">{{ $s->name }}. {{ $s->course }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        {{ Form::label('ref_no', 'Ref No') }}
        {{ Form::text('ref_no') }}
    </div>

    <div class="form-group">
        {{ Form::label('amt_paid', 'Amount Paid') }}
        {{ Form::number('amt_paid',null,['class' => 'form-control','step'=>'any']) }}
    </div>

    <div class="form-group">
        {{ Form::label('balance', 'Balance') }}
        {{ Form::number('balance',null,['class' => 'form-control','readonly', 'value' => 0])  }}
    </div>

    <div class="form-group">
        {{ Form::label('paid', 'Paid') }}
        {{ Form::select('paid', [ 0=> "Not Paid", 1=>"Paid"]) }}
    </div>

    <div class="form-group">
        {{ Form::label('year', 'Year') }}
        {{ Form::select('year', [ 2023=> "2023", 2024=>"2024"])  }}
    </div>

    {{ Form::submit('Create Payment', array('class' => 'btn btn-primary')) }}

    <button class="receipt" > PAYMENT RECEIPT</button>

    {{ Form::close() }}

</div>
<script type="text/javascript">
    $(function (){
        $("input#balance").val(0);

        $(document).on("change", ".sel-student", function(e){

            let  formData = { student_id : $(this).find(":selected").val() };
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            url = "{{ route('select.student') }}";


            $.ajax({
                type:"POST",
                async: true,
                datatype:"JSON",
                url: url,
                data: formData,
                success: function (result)
                {
                    $("input#balance").val(result);
                }
            })


        });

        $(document).on("input", "input#amt_paid", function(e){
            if ($("input#balance").val() - $("input#amt_paid").val() == 0)
            {
                $(".receipt").show();
            }
            else {
                $(".receipt").hide();
            }
        });
    });
</script>
</body>
</html>
