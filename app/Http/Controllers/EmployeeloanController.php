<?php

namespace App\Http\Controllers;

use Excel;
use Validator;
use Auth;
use PDF;
use DB;
use Session;
use Input;
use Request;
use DateTime;
use Hash;
use Carbon\Carbon;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Str;

class EmployeeloanController extends Controller
{
    public function index(){
    	if (Request::ajax()) {
	        $data = \App\Employee_loan::latest()->get();
	        return Datatables::of($data)
	        ->editColumn('date', function($data){
	        	return Carbon::parse($data->date)->toFormattedDateString();
	        })
	        ->editColumn('employee_id', function($data){
	        	return $data->employee->FullName;
	        })
	        ->editColumn('loan_id', function($data){
	        	return $data->loan->name;
	        })
            ->addColumn('action', function($data){
				$btn = '<center>
            		<a href="#edit'.$data->id.'" class="btn btn-primary btn-sm" data-toggle="modal"><i class="fa fa-edit"></i></a>
            		<a href="#delete'.$data->id.'" class="btn btn-danger btn-sm" data-toggle="modal"><i class="fa fa-trash"></i></a>
            	</center>';
				return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
	    }
    	$employees = \App\Employee::orderBy('lastname')->get()->pluck('FullName','id');
    	$loans = \App\Loan::orderBy('name')->get()->pluck('name','id');
    	$employee_loans = \App\Employee_loan::get();
    	return view('admin.employee-loans.index',compact('employees','loans','employee_loans'));
    }

    public function store(){
    	$validator = Validator::make(Request::all(), [
    		'date'						=>	'required',
		    'employee_id'				=>	'required',
		    'loan_id'					=>	'required',
		    'amount'					=>	'required|numeric|between:0,9999999.99',
		    'deducted_amount'			=>	'required|numeric|between:0,9999999.99',
		    'date_started'				=>	'required',
		    'date_ended'				=>	'required',
		],
		[
			'date.required'     		=>	'Date Required',
		    'employee_id.required'     	=>	'Please Select Employee',
		    'loan_id.required'			=>	'Please Select Loan Type',
		    'amount.required'     		=>	'Loan Amount Required',
		    'deducted_amount.required'  =>	'Deducted Amount Required',
		    'date_started.required'     =>	'Deduction Date Started Required',
		    'date_ended.required'     	=>	'Deduction Date End Required',
		]);

		if ($validator->fails()) {
            foreach($validator->errors()->all() as $error) {
	            toastr()->warning($error);
	        }
	        return redirect()->back()
	       	->withInput();
		}

		\App\Employee_loan::create(Request::all());
		toastr()->success('Employee Loan Created Successfully', config('global.system_name'));
    	return redirect()->back();
    }

    public function update($id){
    	$employee_loan = \App\Employee_loan::find($id);
    	$validator = Validator::make(Request::all(), [
    		'date'						=>	'required',
		    'employee_id'				=>	'required',
		    'loan_id'					=>	'required',
		    'amount'					=>	'required|numeric|between:0,9999999.99',
		    'deducted_amount'			=>	'required|numeric|between:0,9999999.99',
		    'date_started'				=>	'required',
		    'date_ended'				=>	'required',
		],
		[
			'date.required'     		=>	'Date Required',
		    'employee_id.required'     	=>	'Please Select Employee',
		    'loan_id.required'			=>	'Please Select Loan Type',
		    'amount.required'     		=>	'Loan Amount Required',
		    'deducted_amount.required'  =>	'Deducted Amount Required',
		    'date_started.required'     =>	'Deduction Date Started Required',
		    'date_ended.required'     	=>	'Deduction Date End Required',
		]);

		if ($validator->fails()) {
            foreach($validator->errors()->all() as $error) {
	            toastr()->warning($error);
	        }
	        return redirect()->back()
	       	->withInput();
		}

		$employee_loan->update(Request::all());
		toastr()->success('Employee Loan Updated Successfully', config('global.system_name'));
    	return redirect()->back();
    }

    public function delete($id){
    	$employee_loan = \App\Employee_loan::find($id);
    	$employee_loan->delete();
    	toastr()->success('Employee Loan Deleted Successfully', config('global.system_name'));
    	return redirect()->back();
    }

}
