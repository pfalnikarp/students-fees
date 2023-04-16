<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $payments = Payment::all();
        $students = Student::all();

        return View::make('payments.create', ['payments=>$payments', 'students'=>$students]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

       $request->validate([
            'payment_id' => ['required', 'unique:payments', 'max:255'],
            'ref_no' => ['required'],
            'amt_paid' => ['required'],

        ]);
        $result = $request->all();

        if (!($request->has('balance')))
        {
            Redirect::back()->withErrors(['msg' => 'Balance amount should not be blank']);
        }
        $payment = new Payment();
        $payment->payment_id = $result['payment_id'];
        $payment->ref_no     =  $result['ref_no'];
        $payment->student_id =  $result['student_id'];
        $payment->balance    =  $result['balance'];
        $payment->amt_paid   =  $result['amt_paid'];
        $payment->paid       =  $result['paid'];
        $payment->year       =  $result['year'];

        $payment->save();
    }

    /**
     * Display the specified resource.
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Payment $payment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payment $payment)
    {
        //
    }

    public function selectStudent(Request $request)
    {
        $student_id = $request->student_id;
        $student =  Student::find($student_id);
        $fees_paid = Payment::where('student_id','=', $student_id)->sum('amt_paid');
        return  $student->fees -  $fees_paid;
    }
}
