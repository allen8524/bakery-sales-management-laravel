<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gubun;
use Response;

class AjaxController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
		$data['tmp'] = $this->qstring();
		
		$text1 = request('text1');
		$data['text1'] = $text1;
		
		$data['list'] = $this->getlist($text1);
		
		return view('ajax.index', $data);
    }

	public function getlist( $text1 )
	{
		$result = Gubun::where('name', 'like', '%' . $text1 . '%')->orderby('name','asc')->paginate(6)->appends( ['text1' => $text1] );
		return $result;
	}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
		$row = new Gubun;
		$this->save_row($request, $row);
		
		return response()->json($row);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
		$row = Gubun::find($id);
		$this->save_row($request, $row);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Gubun::find($id)->delete();
    }
	
	public function save_row(Request $request, $row)
	{
		$request->validate([
			'name' => 'required|max:20'
		],
		[
			'name.required' => '이름은 필수입력입니다.',
			'name.max'      => '이름은 20자 이내입니다.',
		]);

		$row->name = $request->input('name');
		
		$row->save();
	}
	
	public function qstring()
	{
		$text1 = request("text1") ? request('text1') : "";
		$page = request("page") ? request('page') : "1";
		
		$tmp = $text1 ? "?text1=$text1&page=$page" : "?page=$page";
		
		return $tmp;
		
	}
}
