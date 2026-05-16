@extends('main')
@section('title','Worker 수정')

@section('content')
<div class="container py-4">
  <h3 class="mb-3">Worker 수정</h3>

  <form name="form1" method="post" action="{{ route('workers.update', $worker->id) }}">
    @csrf
    @method('PUT')

    <table class="table table-sm table-bordered mymargin5">
      <tr>
        <td width="20%" class="mycolor2">번호</td>
        <td width="80%" align="left">{{ $worker->id }}</td>
      </tr>
      <tr>
        <td class="mycolor2"><font color="red">*</font> 이름</td>
        <td align="left">
          <input type="text" name="name" value="{{ old('name', $worker->name) }}" class="form-control form-control-sm" required maxlength="20">
        </td>
      </tr>
      <tr>
        <td class="mycolor2">전화</td>
        <td align="left">
          <input type="text" name="phone" value="{{ old('phone', $worker->phone) }}" class="form-control form-control-sm" maxlength="11" placeholder="숫자만">
        </td>
      </tr>
      <tr>
        <td class="mycolor2">성별</td>
        <td align="left">
          <select name="gender" class="form-select form-select-sm">
            <option value="">선택</option>
            <option value="남자" @selected(old('gender', $worker->gender)==='남자')>남자</option>
            <option value="여자" @selected(old('gender', $worker->gender)==='여자')>여자</option>
          </select>
        </td>
      </tr>
    </table>

    <div class="d-flex gap-2">
      <button class="btn btn-primary btn-sm">수정</button>
      <a href="{{ route('workers.index') }}" class="btn btn-secondary btn-sm">목록</a>
    </div>
  </form>
</div>
@endsection
