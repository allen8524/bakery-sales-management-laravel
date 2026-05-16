@extends('main')
@section('title','Worker 상세')
@section('content')
<div class="container py-4">
  <h3 class="mb-3">Worker 상세</h3>
  <div class="card">
    <div class="card-body">
      <dl class="row mb-0">
        <dt class="col-sm-2">ID</dt><dd class="col-sm-10">{{ $worker->id }}</dd>
        <dt class="col-sm-2">이름</dt><dd class="col-sm-10">{{ $worker->name }}</dd>
        <dt class="col-sm-2">전화</dt><dd class="col-sm-10">{{ $worker->phone }}</dd>
        <dt class="col-sm-2">성별</dt><dd class="col-sm-10">{{ $worker->gender }}</dd>
      </dl>
    </div>
  </div>
  <div class="mt-3 d-flex gap-2">
    <a class="btn btn-secondary" href="{{ route('workers.index') }}">목록</a>
    <a class="btn btn-outline-primary" href="{{ route('workers.edit',$worker) }}">수정</a>
  </div>
</div>
@endsection
