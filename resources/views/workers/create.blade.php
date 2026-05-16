@extends('main')
@section('title','Worker 등록')
@section('content')
<div class="container py-4">
  <h3 class="mb-3">Worker 등록</h3>
  <form action="{{ route('workers.store') }}" method="post">
    @include('workers._form')
    <div class="d-flex gap-2">
      <button class="btn btn-primary">저장</button>
      <a class="btn btn-secondary" href="{{ route('workers.index') }}">목록</a>
    </div>
  </form>
</div>
@endsection
