@extends('main')
@section('content')
<br>
<div class="alert mycolor1" role="alert">Test 상세</div>

@php
    $tel = preg_match('/^\d{10,11}$/', $row->cotel ?? '') ?
        (strlen($row->cotel)==11
            ? substr($row->cotel,0,3)."-".substr($row->cotel,3,4)."-".substr($row->cotel,7,4)
            : substr($row->cotel,0,2)."-".substr($row->cotel,2,4)."-".substr($row->cotel,6,4)
        )
        : ($row->cotel ?? '');
@endphp

<table class="table table-sm table-bordered mymargin5">
    <tr>
        <td width="20%" class="mycolor2">번호</td>
        <td width="80%" align="left">{{ $row->id }}</td>
    </tr>
    <tr>
        <td class="mycolor2">회사명</td>
        <td align="left">{{ $row->coname }}</td>
    </tr>
    <tr>
        <td class="mycolor2">회사전화</td>
        <td align="left">{{ $tel }}</td>
    </tr>
    <tr>
        <td class="mycolor2">창립일</td>
        <td align="left">{{ $row->startday? \Illuminate\Support\Carbon::parse($row->startday)->format('Y-m-d') : '' }}</td>
    </tr>
    <tr>
        <td class="mycolor2">회사분류</td>
        <td align="left">{{ $a_cokind[$row->cokind] ?? '' }}</td>
    </tr>
</table>

<div align="center">
    <a href="{{ route('test.edit', $row->id) }}" class="btn btn-sm mycolor1">수정</a>

    <form action="{{ route('test.destroy', $row->id) }}" method="post" style="display:inline"
          onsubmit="return confirm('정말 삭제할까요?');">
        @csrf
        @method('DELETE')
        <button class="btn btn-sm mycolor1" type="submit">삭제</button>
    </form>

    <a href="javascript:history.back();" class="btn btn-sm mycolor1">이전화면</a>
</div>

@endsection
