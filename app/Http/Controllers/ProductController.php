<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Gubun;

class ProductController extends Controller
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
		
		return view('product.index', $data);
    }

	public function getlist( $text1 )
	{
		$result = Product::leftjoin('gubuns', 'products.gubuns_id', '=', 'gubuns.id')->
		select('products.*','gubuns.name as gubuns_name')->
			where('products.name', 'like', '%' . $text1 . '%')->
			orderby('products.name','asc')->
			paginate(8)->appends( ['text1' => $text1] );
			
		return $result;
	}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
		$data['list']=$this->getlist_gubun();
		
		$data['tmp'] = $this->qstring();
        return view('product.create', $data);
    }
	
	public function getlist_gubun()
	{
		$result = Gubun::orderby('name')->get();
		return $result;
	}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
		$row = new Product;
		$this->save_row($request, $row);
		
		$tmp = $this->qstring();
		return redirect('product' . $tmp);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
		$data['tmp'] = $this->qstring();
        $data['row'] = Product::leftjoin('gubuns','products.gubuns_id','=','gubuns.id')->
			select('products.*', 'gubuns.name as gubun_name')->
			where('products.id','=',$id)->first();
		;
		return view('product.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
		$data['list']=$this->getlist_gubun();
		
		$data['tmp'] = $this->qstring();	
        $data['row'] = Product::find( $id );
		return view('product.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
		$row = Product::findOrFail($id);
		$this->save_row($request, $row);
		
		$tmp = $this->qstring();
		return redirect('product' . $tmp);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $row = Product::findOrFail($id);
		$this->deleteProductImage($row->pic);
		$row->delete();
		
		$tmp = $this->qstring();
		return redirect('product' . $tmp);
    }
	
	public function save_row(Request $request, $row)
	{
		$request->validate([
			'gubuns_id' => 'required|numeric',
			'name' => 'required|max:20',
			'price' => 'required|numeric',
			'pic' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048'
		],
		[
			'gubuns_id.required' => '구분명은 필수입력입니다.',
			'name.required' => '이름은 필수입력입니다.',
			'price.required' => '단가는 필수입력입니다.',
			'name.max'      => '이름은 20자 이내입니다.'
		]);

		$row->gubuns_id = $request->input('gubuns_id');
		$row->name = $request->input('name');
		$row->price = $request->input('price');
		$row->jaego = $request->input('jaego');
		
		if ($request->hasFile('pic')) {
			$this->deleteProductImage($row->pic);

			$pic = $request->file('pic');

			$path = $pic->store('product_img', 'public');
			$row->pic = basename($path);
		}
		
		$row->save();
	}

	private function deleteProductImage($pic)
	{
		if (!$pic) {
			return;
		}

		Storage::disk('public')->delete('product_img/' . basename($pic));
	}
	
	public function qstring()
	{
		$text1 = request("text1") ? request('text1') : "";
		$page = request("page") ? request('page') : "1";
		
		$tmp = $text1 ? "?text1=$text1&page=$page" : "?page=$page";
		
		return $tmp;
		
	}

	public function jaego()
{
    DB::statement('drop table if exists temps;');
    DB::statement(' create table temps (
        id int not null auto_increment,
        products_id int,
        jaego int default 0,
        primary key(id) ); ');
    DB::statement('update products set jaego=0;');
    DB::statement('insert into temps (products_id, jaego)
        select products_id, sum(numi)-sum(numo)
        from jangbus
        group by products_id;');
    DB::statement('update products join temps
        on products.id=temps.products_id
        set products.jaego=temps.jaego;');

    return redirect('product');
}

}
