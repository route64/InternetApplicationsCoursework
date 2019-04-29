<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DateTime;
use Illuminate\Support\Facades\Hash;
use DB;
use App\Users;
use App\Staff;

class newStaffController extends Controller
{
	public function registerNewStaff() {
		request()->validate([
         'password' => ['required', 'string', 'min:8', 'confirmed'],
         'address' => ['required','string', 'max:255'],
         'post_code' => ['required', 'string', 'max:10'],
         'phone_no' => ['required', 'numeric','digits_between: 11, 15'],
		]);
		
		$title = request()->title;
		$first_name = request()->first_name;
		$surname = request()->surname;
		$address = request()->address;
		$post_code = request()->post_code;
		$phone_no = request()->phone_no;
		$role = request()->role;
		$pay_scale = request()->pay_scale;
		$DOB = request()->dob;
		//$start_date = request()->start_date;
		
		$name = $first_name .' '. $surname;
		/**To create a unique username for members of staff, take their surname, and put the first letter of
			their first name on the end, then add a number based on whether anyone else has the same surname and first
			character of first name.
		*/
		$usernameNumber = mt_rand(0, 100);
		$username = $surname . substr($first_name, 0, 1). $usernameNumber;
		if(DB::table('users')->where('username', $username)->get() == []) {
			$usernameNumber = $usernameNumber + mt_rand(0, 100);
			$username = $surname . substr($first_name, 0, 1). $usernameNumber;
		}
		//email = username + sanctuary email address
		$email = $username . "@aston-sanctuary.ac.uk";
		try{
		DB::table('users')->insert([
			'title'=>$title,
			'name'=> $name,
			'username' => $username,
			'email'=>$email,
			'password' => Hash::make(request()->password),
			'address'=>$address,
			'created_at'=>new DateTime(),
			'type'=>'STAFF',
			'post_code'=>$post_code,
			'phone_no'=>$phone_no
		]);
		
		$user_id = DB::table('users')->where('username', $username)->first()->id;
		
		DB::table('staff')->insert([
			'username'=>$username,
			'role'=>$role,
			'pay_scale'=>$pay_scale,
			'user_id'=>$user_id,
			'DOB' =>$DOB,
			'start_date'=>request()->start,
			'created_at'=>new DateTime(),
		]);
		
		DB::table('images')->insert([
			'ref_type'=>'STAFF',
			'ref_id' => DB::table('staff')->where('username', $username)->first()->user_id,
			'image_location'=> "../resources/images/People/cartoon-dog.jpg",
			'source' => 'Image from Pixels',
			'created_at' => new DateTime(),
		]);
		
		$message = "New Staff Member Registered. Username: ".$username;
		}
		catch (Exception $e){
			$message = "Unable To Add New User. Try Again.";
		}
		return back()->with('message', $message);
	}
}

?>
