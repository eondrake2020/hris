<?php

namespace App\Http\Controllers;

use App\Bank;

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

class BankController extends Controller
{
    public function index(){
    	if (Request::ajax()) {
	        $data = Bank::latest()->get();
	        return Datatables::of($data)
            ->addColumn('action', function($data){
				$btn = '<center>
            		<a href="#edit'.$data->id.'" class="btn btn-primary btn-sm" data-toggle="modal"><i class="fa fa-edit"></i></a>
            	</center>';
				return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
	    }
	    $banks = Bank::orderBy('name')->get();
    	return view('admin.banks.index',compact('banks'));
    }

    public function store(){
    	$validator = Validator::make(Request::all(), [
		    'name'						=>	'required|unique:banks',
		],
		[
		    'name.required'     		=>	'Bank Name Required',
		]);

		if ($validator->fails()) {
            foreach($validator->errors()->all() as $error) {
	            toastr()->warning($error);
	        }
	        return redirect()->back()
	       	->withInput();
		}

		Bank::create([
			'name'			=>		Request::get('name'),
		]);

		toastr()->success('Bank Created Successfully', config('global.system_name'));
    	return redirect()->back();
    }

    public function update($id){
		$bank = Bank::find($id);
		$validator = Validator::make(Request::all(), [
		    'name'						=>	"required|unique:banks,name,$bank->id,id",
		],
		[
		    'name.required'     		=>	'Bank Name Required',
		]);

		if ($validator->fails()) {
            foreach($validator->errors()->all() as $error) {
	            toastr()->warning($error);
	        }
	        return redirect()->back()
	       	->withInput();
		}

		$bank->update([
			'name'			=>		Request::get('name'),
		]);

		toastr()->success('Bank Updated Successfully', config('global.system_name'));
    	return redirect()->back();
    }
}
