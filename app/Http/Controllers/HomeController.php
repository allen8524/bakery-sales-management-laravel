<?php

namespace App\Http\Controllers;

use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        // 제품 기본 정보만 가져오기
        $products = Product::select('id', 'name', 'pic', 'jaego')->get();

        // 1) 재고 소진 (재고 <= 0)
        $soldOutAll = $products
            ->filter(function ($p) {
                $current = (int)($p->jaego ?? 0);
                return $current <= 0;
            })
            ->sortBy('name')
            ->values();

        $soldOut      = $soldOutAll->take(8);   // 카드에 보여줄 것만
        $soldOutCount = $soldOutAll->count();   // 소진된 상품 개수

        // 2) 곧 소진 (0 < 재고 < 5)
        $lowStockAll = $products
            ->filter(function ($p) {
                $current = (int)($p->jaego ?? 0);
                return $current > 0 && $current < 5;   // 5개 미만
            })
            ->sortBy('jaego')                   // 재고 적은 순서
            ->values();

        $lowStock      = $lowStockAll->take(8);
        $lowStockCount = $lowStockAll->count();

        return view('home', [
            'soldOut'      => $soldOut,
            'soldOutCount' => $soldOutCount,
            'lowStock'     => $lowStock,
            'lowStockCount'=> $lowStockCount,
        ]);
    }
}
