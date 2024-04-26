<?php

namespace App\Http\Controllers;

use App\Exports\ExportCollectFees;
use Stripe\Stripe;
use App\Models\User;
use App\Models\ClassModel;
use App\Models\SettingModel;
use Illuminate\Http\Request;
use App\Models\StudentAddFeesModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;

class FeesColeectionController extends Controller
{
    public function collect_fees(Request $request)
    {
        $data['getClass'] = ClassModel::getClass();

        if(!empty($request->all()))
        {
            $data['getRecord'] = User::getCollectionFeesStudent();
        }
        $data['header_title'] = "Collect Fees";
        return view('admin.fees_collection.collect_fees',$data);
    }

    public function collect_fees_report()
    {
        $data['getClass'] = ClassModel::getClass();
        $data['getRecord'] = StudentAddFeesModel::getRecord();

        $data['header_title'] = "Collect Fees Report";
        return view('admin.fees_collection.collect_fees_report',$data);
    }
    public function export_collect_fees_report(Request $request)
    {
        return Excel::download(new ExportCollectFees, 'CollectFeesReport_'.date('d-m-Y').'.xls');
    }

    public function collect_fees_add($student_id)
    {
        $data['getFees'] = StudentAddFeesModel::getFees($student_id);
        $getStudent = User::getSingleClass($student_id);
        $data['getStudent'] = $getStudent;
        $data['paid_amount'] = StudentAddFeesModel::getPaidAmount($student_id, $getStudent->class_id);
        $data['header_title'] = "Add Collect Fees";
        return view('admin.fees_collection.add_collect_fees',$data);
    }
    public function collect_fees_insert(Request $request, $student_id)
    {
        $getStudent = User::getSingleClass($student_id);
        $paid_amount = StudentAddFeesModel::getPaidAmount($student_id, $getStudent->class_id);
        if(!empty($request->amount))
        {
        $RemainingAmount = $getStudent->amount - $paid_amount;
            if($RemainingAmount >= $request->amount)
            {
            $remaining_amount_user = $RemainingAmount - $request->amount;
            $payment = new StudentAddFeesModel;
            $payment->student_id = $student_id;
            $payment->class_id = $getStudent->class_id;
            $payment->paid_amount = $request->amount;
            $payment->total_amount = $RemainingAmount;
            $payment->remaining_amount = $remaining_amount_user;
            $payment ->payment_type = $request->payment_type;
            $payment->remark = $request->remark;
            $payment->created_by = Auth::user()->id;
            $payment->is_payment = 1;
            $payment->save();
            return redirect()->back()->with('success','Fees Successfully Added');
            }
            else
            {
                return redirect()->back()->with('error','Your paid amount is greater than remaining amount');
            }
        }
        else
        {
            return redirect()->back()->with('error','Your paid amount should be more than 1 dollar');
        }
    }

    public function CollectFeesStudent()
    {
        $student_id = Auth::user()->id;
        $data['getFees'] = StudentAddFeesModel::getFees($student_id);
        $getStudent = User::getSingleClass($student_id);
        $data['getStudent'] = $getStudent;
        $data['paid_amount'] = StudentAddFeesModel::getPaidAmount($student_id, Auth::user()->class_id);
        $data['header_title'] = "Fees Collection";
        return view('student.my_fees_collection',$data);
    }

    public function CollectFeesStudentPayment(Request $request)
    {
        $getStudent = User::getSingleClass(Auth::user()->id);
        $paid_amount = StudentAddFeesModel::getPaidAmount(Auth::user()->id, Auth::user()->class_id);

        if(!empty($request->amount))
        {
            $RemainingAmount = $getStudent->amount - $paid_amount;
            if($RemainingAmount >= $request->amount)
            {
                $remaining_amount_user = $RemainingAmount - $request->amount;
                $payment = new StudentAddFeesModel;
                $payment->student_id = Auth::user()->id;
                $payment->class_id = Auth::user()->class_id;
                $payment->paid_amount = $request->amount;
                $payment->total_amount = $RemainingAmount;
                $payment->remaining_amount = $remaining_amount_user;
                $payment ->payment_type = $request->payment_type;
                $payment->remark = $request->remark;
                $payment->created_by = Auth::user()->id;
                $payment->is_payment = 1;


                $getSetting = SettingModel::getSingle();

               if($request->payment_type == 'paypal')
               {

               }
               else if($request->payment_type == 'stripe')
               {
                $setPublicKey = $getSetting->stripe_key;
                $setApiKey = $getSetting->stripe_secret;

                Stripe::setApiKey($setApiKey);
                $finalprice = $request->amount * 100;

                $session = \Stripe\Checkout\Session::create([
                  'customer_email' => Auth::user()->email,
                  'payment_method_types' => ['card'],
                  'line_items' => [[
                    'name' => "Student Fees",
                    'description' => 'Student Fees',
                    'images' => [url('assets/img/logo-2x.png')],
                    'amount' => intval($finalprice),
                    'currency' => 'usd',
                    'quantity' => 1,
                  ]],

                  'success_url' => url('student/stripe/payment-success'),
                  'cancel_url' => url('student/stripe/payment-error'),
                ]);

                $payment->stripe_session_id = $session['id'];
                $payment->save();

                $data['session_id'] = $session['id'];
                Session::put('stripe_session_id', $session['id']);
                $data['setPublicKey'] = $setPublicKey;

                return view('stripe_charge', $data);

               }
               $payment->save();
               return redirect()->back()->with('success', 'Add payment success');
            }
            else
            {
                return redirect()->back()->with('error', 'Your amount go to greater than remaining Amount');
            }
        }
        else
        {
            return redirect()->back()->with('error','You need to add amount at least $1');
        }
    }

    public function PaymentSuccessStripe(Request $request)
    {
       $getSetting = SettingModel::getSingle();
       $setPublicKey = $getSetting->stripe_key;
       $setApiKey = $getSetting->stripe_secret;

       $trans_id = Session::get('stripe_session_id');
       $getFee = StudentAddFeesModel::where('stripe_session_id', '=', $trans_id)->first();

       \Stripe\Stripe::setApiKey($setApiKey);
       $getData = \Stripe\Checkout\Session::retrieve($trans_id);

        if(!empty($getData->id) && ($getData->id == $trans_id) && !empty($getFee) && $getData->status == 'complete' && $getData->payment_status == 'paid')
        {
            $getFee->is_payment = 1;
            $getFee->payment_data = json_encode($request->all());
            $getFee->save();
            Session::forget('stripe_session_id', 2145);
            return redirect('student/fees_collection')->with('success','Your Payment Successful');
        }
        else
        {
            return redirect('student/fees_collection')->with('error','Due to some error Please try again');
        }
    }

    public function PaymentSuccess(Request $request)
    {
       if(!empty($request->item_number) && !empty($request->st) && $request->st == 'Completed')
       {
        $fees = StudentAddFeesModel::getSingle($request->item_number);
        if(!empty($fees))
        {
            $fees->is_payment = 1;
            $fees->payment_data = json_encode($request->all());
            return redirect('student/fees_collection')->with('success','Your Payment Successful');
        }
        else
        {
            return redirect('student/fees_collection')->with('error','Due to some error Please try again');
        }
       }
    }

    public function PaymentError()
    {
        return redirect('student/fees_collection')->with('error', 'Due to some error please try again');
    }

    public function CollectFeesStudentParent($student_id, Request $request)
    {
        // $getStudent = User::getSingle($student_id);
        // $data['getStudent'] = $getStudent;
        $data['getFees'] = StudentAddFeesModel::getFees($student_id);
        $getStudent = User::getSingleClass($student_id);
        $data['getStudent'] = $getStudent;
        $data['paid_amount'] = StudentAddFeesModel::getPaidAmount($student_id, $getStudent->class_id);
        $data['header_title'] = "Fees Collection";
        return view('parent.my_fees_collection',$data);
    }

    public function CollectFeesStudentPaymentParent($student_id,Request $request)
    {
        $getStudent = User::getSingleClass($student_id);
        $paid_amount = StudentAddFeesModel::getPaidAmount($student_id, $getStudent->class_id);

        if(!empty($request->amount))
        {
            $RemainingAmount = $getStudent->amount - $paid_amount;
            if($RemainingAmount >= $request->amount)
            {
                $remaining_amount_user = $RemainingAmount - $request->amount;
                $payment = new StudentAddFeesModel;
                $payment->student_id = $getStudent->id;
                $payment->class_id = $getStudent->class_id;
                $payment->paid_amount = $request->amount;
                $payment->total_amount = $RemainingAmount;
                $payment->remaining_amount = $remaining_amount_user;
                $payment ->payment_type = $request->payment_type;
                $payment->remark = $request->remark;
                $payment->created_by = Auth::user()->id;
                $payment->is_payment = 1;


                $getSetting = SettingModel::getSingle();

               if($request->payment_type == 'paypal')
               {

               }
               else if($request->payment_type == 'stripe')
               {
                $setPublicKey = $getSetting->stripe_key;
                $setApiKey = $getSetting->stripe_secret;

                Stripe::setApiKey($setApiKey);
                $finalprice = $request->amount * 100;

                $session = \Stripe\Checkout\Session::create([
                  'customer_email' => Auth::user()->email,
                  'payment_method_types' => ['card'],
                  'line_items' => [[
                    'name' => "Student Fees",
                    'description' => 'Student Fees',
                    'images' => [url('assets/img/logo-2x.png')],
                    'amount' => intval($finalprice),
                    'currency' => 'usd',
                    'quantity' => 1,
                  ]],

                  'success_url' => url('student/stripe/payment-success'),
                  'cancel_url' => url('student/stripe/payment-error'),
                ]);

                $payment->stripe_session_id = $session['id'];
                $payment->save();

                $data['session_id'] = $session['id'];
                Session::put('stripe_session_id', $session['id']);
                $data['setPublicKey'] = $setPublicKey;

                return view('stripe_charge', $data);

               }
               $payment->save();
               return redirect()->back()->with('success', 'Add payment success');
            }
            else
            {
                return redirect()->back()->with('error', 'Your amount go to greater than remaining Amount');
            }
        }
        else
        {
            return redirect()->back()->with('error','You need to add amount at least $1');
        }
    }

    public function PaymentSuccessParent($student_id,Request $request)
    {
       if(!empty($request->item_number) && !empty($request->st) && $request->st == 'Completed')
       {
        $fees = StudentAddFeesModel::getSingle($request->item_number);
        if(!empty($fees))
        {
            $fees->is_payment = 1;
            $fees->payment_data = json_encode($request->all());
            return redirect('parent/my_student/fees_collection/'.$student_id)->with('success','Your Payment Successful');
        }
        else
        {
            return redirect('parent/my_student/fees_collection/'.$student_id)->with('error','Due to some error Please try again');
        }
       }
    }

    public function PaymentErrorParent($student_id)
    {
        return redirect('parent/my_student/fees_collection/'.$student_id)->with('error', 'Due to some error please try again');
    }

}