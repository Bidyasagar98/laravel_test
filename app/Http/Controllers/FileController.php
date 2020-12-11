<?php
namespace App\Http\Controllers;
require  '../vendor/autoload.php';
use \CloudConvert\Api;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Validator;
use Redirect;

class FileController extends Controller
{

    public function upload()
    {
    	return view('FileUpload');
    	
    }
    public function save(Request $req)
    {
    	$pgArray = $req->all();
    	$validator = Validator::make($pgArray,
    		[
    			'txtName' 			=> 'bail|max:15|required|regex:/^[.A-Za-z ]+$/',
    			'file1' 			=> 'required|mimetypes:application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document'
    		],[
    			'txtName.regex'		=> 'Name is Invalid Format',
                'txtName.max'       => 'Name (E) should not be greater than :max character',
				'txtName.required'	=> 'Name cannot be left blank',
                'file1.required'    =>  'Document Required',
                'file1.mimetypes' 	=>  'Invalid File Format',
            ]
    	);

    	if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }else{

            $name = $req->input('txtName');
            $original_name = $req->file('file1')->getClientOriginalName();

            Storage::disk('local')->put($original_name, $req->file('file1')->get());
        
        $path = storage_path('app/').$original_name;
    	// echo($path);exit;

		    $api = new Api("qAoPH0gI4APGH6y2SoYpaNouR9Ar3ELuHhAJHgHeXUINEsy0D6Rnf255Rol8hYVh");

		    	$api->convert([
		    		"inputformat" => "docx",
		    		"outputformat" => "pdf",
		    		"input" => "upload",
		    		"file" => fopen($path, 'r'),
		    	])
		    	->wait()
		    	->download(storage_path('app/'));

                return redirect()->back()->withSuccess($name.', your file converted successFully. Go "Storage/app" to get your file.');
    	}


    	# code...
    }
}

