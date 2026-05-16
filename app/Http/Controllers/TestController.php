<?php

namespace App\Http\Controllers;

use App\Models\Test;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index(Request $request)
    {
        $text1 = $request->input('text1', '');

        $list = Test::query()
            ->when($text1, function ($q) use ($text1) {
                $q->where(function ($w) use ($text1) {
                    $w->where('coname', 'like', "%{$text1}%")
                      ->orWhere('cotel', 'like', "%{$text1}%");
                });
            })
            ->orderByDesc('id')
            ->paginate(10)
            ->withQueryString();

        return view('test.index', [
            'list' => $list,
            'text1' => $text1,
            'a_cokind' => Test::COKIND,
        ]);
    }

    public function create()
    {
        return view('test.create', [
            'a_cokind' => Test::COKIND,
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'coname'   => ['required','string','max:20'],
            'cotel'    => ['nullable','string','max:11'],
            'startday' => ['nullable','date'],
            'cokind'   => ['required','integer','min:0','max:'.(count(Test::COKIND)-1)],
        ]);

        Test::create($data);

        return redirect()->route('test.index')->with('success', '등록되었습니다.');
    }

    public function show(Test $test)
    {
        return view('test.show', [
            'row' => $test,
            'a_cokind' => Test::COKIND,
        ]);
    }

    public function edit(Test $test)
    {
        return view('test.edit', [
            'row' => $test,
            'a_cokind' => Test::COKIND,
        ]);
    }

    public function update(Request $request, Test $test)
    {
        $data = $request->validate([
            'coname'   => ['required','string','max:20'],
            'cotel'    => ['nullable','string','max:11'],
            'startday' => ['nullable','date'],
            'cokind'   => ['required','integer','min:0','max:'.(count(Test::COKIND)-1)],
        ]);

        $test->update($data);

        return redirect()->route('test.index')->with('success', '수정되었습니다.');
    }

    public function destroy(Test $test)
    {
        $test->delete();
        return redirect()->route('test.index')->with('success', '삭제되었습니다.');
    }
}
