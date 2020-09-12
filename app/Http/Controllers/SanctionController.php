<?php

namespace App\Http\Controllers;

use App\Sanction;

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

class SanctionController extends Controller
{
    public function index(){
    	if (Request::ajax()) {
	        $data = Sanction::latest()->get();
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
	    $sanctions = Sanction::orderBy('name')->get();
    	return view('admin.sanctions.index',compact('sanctions'));
    }

    public function store(){
    	$validator = Validator::make(Request::all(), [
		    'name'						=>	'required|unique:sanctions',
		],
		[
		    'name.required'     		=>	'Sanction Name Required',
		]);

		if ($validator->fails()) {
            foreach($validator->errors()->all() as $error) {
	            toastr()->warning($error);
	        }
	        return redirect()->back()
	       	->withInput();
		}

		Sanction::create([
			'name'			=>		Request::get('name'),
		]);

		toastr()->success('Sanction Created Successfully', config('global.system_name'));
    	return redirect()->back();
    }

    public function update($id){
		$sanction = Sanction::find($id);
		$validator = Validator::make(Request::all(), [
		    'name'						=>	"required|unique:sanctions,name,$sanction->id,id",
		],
		[
		    'name.required'     		=>	'Sanction Name Required',
		]);

		if ($validator->fails()) {
            foreach($validator->errors()->all() as $error) {
	            toastr()->warning($error);
	        }
	        return redirect()->back()
	       	->withInput();
		}

		$sanction->update([
			'name'			=>		Request::get('name'),
		]);

		toastr()->success('Sanction Updated Successfully', config('global.system_name'));
    	return redirect()->back();
    }
}
