@extends('main')

@section('title','Worker 목록')
@section('content')
<div class="container py-4">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="mb-0">Worker</h3>
    <a class="btn btn-primary btn-sm" href="{{ route('workers.create') }}">새로 등록</a>
  </div>

  <form method="get" class="row g-2 mb-3">
    <div class="col-auto">
      <input type="text" name="q" value="{{ $q }}" class="form-control form-control-sm" placeholder="이름/전화/성별">
    </div>
    <div class="col-auto">
      <button class="btn btn-outline-secondary btn-sm">검색</button>
    </div>
  </form>

  @if(session('ok')) <div class="alert alert-success py-2">{{ session('ok') }}</div> @endif

  <div class="table-responsive">
    <table class="table table-sm align-middle">
      <thead class="table-light">
        <tr>
          <th style="width:80px">ID</th>
          <th>이름</th>
          <th>전화</th>
          <th>성별</th>
          <th style="width:160px"></th>
        </tr>
      </thead>
      <tbody>
        @forelse($workers as $w)
        <tr>
          <td>{{ $w->id }}</td>
          <td><a href="{{ route('workers.show',$w) }}">{{ $w->name }}</a></td>
          <td>{{ $w->phone }}</td>
          <td>{{ $w->gender }}</td>
          <td class="text-end">
            <a class="btn btn-outline-primary btn-sm" href="{{ route('workers.edit',$w) }}">수정</a>
            <form action="{{ route('workers.destroy',$w) }}" method="post" class="d-inline"
                  onsubmit="return confirm('삭제할까요?');">
              @csrf @method('DELETE')
              <button class="btn btn-outline-danger btn-sm">삭제</button>
            </form>
          </td>
        </tr>
        @empty
        <tr><td colspan="5" class="text-center text-muted">데이터 없음</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>

  {{ $workers->links() }}
</div>
@endsection
