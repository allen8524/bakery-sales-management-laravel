<?php

namespace App\Http\Controllers;

use App\Models\Worker;
use Illuminate\Http\Request;

class WorkerController extends Controller
{
    public function index(Request $request)
    {
        $q = trim($request->input('q', ''));
        $workers = Worker::query()
            ->when($q, fn($qq) => $qq->where(function($w) use($q){
                $w->where('name','like',"%{$q}%")
                  ->orWhere('phone','like',"%{$q}%")
                  ->orWhere('gender','like',"%{$q}%");
            }))
            ->orderByDesc('id')
            ->paginate(10)
            ->withQueryString();

        return view('workers.index', compact('workers','q'));
    }

    public function create()
    {
        return view('workers.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'   => ['required','string','max:20'],
            'phone'  => ['nullable','regex:/^\d{10,11}$/'],
            'gender' => ['nullable','in:남자,여자'],
        ]);
        Worker::create($data);
        return redirect()->route('workers.index')->with('ok','등록 완료');
    }

    public function show(Worker $worker)
    {
        return view('workers.show', compact('worker'));
    }

    public function edit(Worker $worker)
    {
        return view('workers.edit', compact('worker'));
    }

    public function update(Request $request, Worker $worker)
    {
        $data = $request->validate([
            'name'   => ['required','string','max:20'],
            'phone'  => ['nullable','regex:/^\d{10,11}$/'],
            'gender' => ['nullable','in:남자,여자'],
        ]);
        $worker->update($data);
        return redirect()->route('workers.index')->with('ok','수정 완료');
    }

    public function destroy(Worker $worker)
    {
        $worker->delete();
        return redirect()->route('workers.index')->with('ok','삭제 완료');
    }
}
