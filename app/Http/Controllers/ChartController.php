<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Jangbu;

class ChartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
		$text1 = $request->input('text1');
		if (!$text1) $text1=date("Y-m-d", strtotime('-1 month'));

		$text2 = $request->input('text2');
		if (!$text2) $text2=date("Y-m-d");
		
		$data['text1'] = $text1;
		$data['text2'] = $text2;

		$list = $this->getlist($text1, $text2);
		
		$str_label="";
		$str_data="";
		foreach($list as $row)
		{
			$str_label .= "'$row->gubuns_name', ";
			$str_data  .= $row->cnumo . ', ';
		}
		$data["str_label"]=$str_label;
		$data["str_data"]=$str_data;
		
		return view('chart.index', $data);
    }

	public function getlist($text1, $text2)
	{
		$result = Jangbu::leftJoin('products', 'jangbus.products_id', '=', 'products.id')->
			leftJoin('gubuns','products.gubuns_id','=','gubuns.id')->
			select('gubuns.name as gubuns_name', DB::raw('count(jangbus.numo) as cnumo'))->
				whereBetween('jangbus.writeday', array($text1, $text2))->
				where('jangbus.io','=',1)->
				orderBy('cnumo','desc')->
				groupBy('gubuns.name')->
				limit(900)->
				paginate(900)->appends(['text1'=>$text1,'text2'=>$text2,]);

		return $result;
	}		
}
?>