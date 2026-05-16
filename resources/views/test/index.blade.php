@extends('main')
@section('content')

<br>
<div class="alert mycolor1" role="alert">Test</div>

<script>
function find_text() {
    form1.action = "{{ route('test.index') }}";
    form1.submit();
}
</script>

<form name="form1" action="">
<div class="row">
    <div class="col-6" align="left">
        <div class="input-group input-group-sm">
            <span class="input-group-text">검색</span>
            <input type="text" name="text1" size="12" value="{{ $text1 }}" class="form-control"
                   onkeydown="if (event.keyCode == 13) { find_text(); }" placeholder="회사명/전화">
            <button type="button" class="btn btn-sm mycolor1" onclick="find_text();">검색</button>
        </div>
    </div>
    <div class="col-6" align="right">
        <a href="{{ route('test.create') }}" class="btn btn-sm mycolor1">추가</a>
    </div>
</div>
</form>

<table class="table table-sm table-bordered mymargin5">
    <tr class="mycolor2 text-center">
        <td width="8%">번호</td>
        <td>회사명</td>
        <td width="16%">전화번호</td>
        <td width="14%">창립일</td>
        <td width="12%">분류</td>
    </tr>
@foreach ($list as $row)
@php
    // 전화 포맷팅(10~11자리만 하이픈)
    $tel = preg_match('/^\d{10,11}$/', $row->cotel ?? '') ?
        (strlen($row->cotel)==11
            ? substr($row->cotel,0,3)."-".substr($row->cotel,3,4)."-".substr($row->cotel,7,4)
            : substr($row->cotel,0,2)."-".substr($row->cotel,2,4)."-".substr($row->cotel,6,4)
        )
        : ($row->cotel ?? '');
    $start = $row->startday ? \Illuminate\Support\Carbon::parse($row->startday)->format('Y-m-d') : '';
    $kind  = $a_cokind[$row->cokind] ?? '';
@endphp
    <tr>
        <td class="text-center">{{ $row->id }}</td>
        <td>
            <a href="{{ route('test.show', $row->id) }}">
                {{ $row->coname }}
            </a>
        </td>
        <td class="text-center">{{ $tel }}</td>
        <td class="text-center">{{ $start }}</td>
        <td class="text-center">{{ $kind }}</td>
    </tr>
@endforeach
</table>

<div class="row">
    <div class="col">
        {{ $list->links('mypagination') }}
    </div>
</div>

@endsection
