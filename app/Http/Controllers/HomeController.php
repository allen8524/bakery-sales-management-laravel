<?php

namespace App\Http\Controllers;

use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::select('id', 'name', 'pic', 'jaego')->get();

        $soldOutAll = $products
            ->filter(function ($p) {
                $current = (int) ($p->jaego ?? 0);
                return $current <= 0;
            })
            ->sortBy('name')
            ->values();

        $soldOut = $soldOutAll->take(8);
        $soldOutCount = $soldOutAll->count();

        $lowStockAll = $products
            ->filter(function ($p) {
                $current = (int) ($p->jaego ?? 0);
                return $current > 0 && $current < 5;
            })
            ->sortBy('jaego')
            ->values();

        $lowStock = $lowStockAll->take(8);
        $lowStockCount = $lowStockAll->count();

        return view('home', [
            'soldOut' => $soldOut,
            'soldOutCount' => $soldOutCount,
            'lowStock' => $lowStock,
            'lowStockCount' => $lowStockCount,
        ]);
    }
}
