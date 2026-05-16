<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Member;


class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function check(Request $request)
    {
		$uid = $request->input('uid');
		$pwd = $request->input('pwd');
		
		$row = Member::where('uid','=',$uid)->first();
		if($row && Hash::check($pwd, $row->pwd))
		{
			$request->session()->put('uid',$row->uid);
			$request->session()->put('rank',$row->rank);
			$request->session()->regenerate();

			return redirect()->route('home');
		}			
		
		return redirect()
			->route('home')
			->with('login_error', '아이디 또는 비밀번호가 올바르지 않습니다.');
    }
	
	public function logout(Request $request)
	{
		$request->session()->forget('uid');
		$request->session()->forget('rank');
		$request->session()->regenerateToken();
		
		return redirect()->route('home');
	}
}
?>
