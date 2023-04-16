<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;


class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::paginate(10);
        return View::make('students.index', ['students' => $students]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return View::make('students.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $input = $request->all();

        $fileName = time().'.'.$request->profile_pic->extension();

        $request->profile_pic->move(public_path('uploads'), $fileName);



        $student = new Student();
        $student->name = $input['name'];
        $student->dob  = $input['dob'];
        $student->gender = $input['gender'];
        $student->profile_pic = $fileName;
        $student->course = $input['course'];
        $student->fees = $input['fees'];
        $student->save();

        $user = new User;
        $user->name = $input['name'];
        $user->email =  trim($input['name'] . '@bigbong.in');
        $user->password =  Hash::make('123456');
        $user->type = 'student';
        $user->save();

        $students = Student::paginate(10);
        return View::make('students.index', ['students' => $students]);

    }
    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStudentRequest $request, Student $student)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        //
    }
}
