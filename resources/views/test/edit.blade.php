@extends('main')
@section('content')
<br>
<div class="alert mycolor1" role="alert">Test 수정</div>

<form name="form1" method="post" action="{{ route('test.update', $row->id) }}">
@csrf
@method('PUT')

<table class="table table-sm table-bordered mymargin5">
    <tr>
        <td width="20%" class="mycolor2">번호</td>
        <td width="80%" align="left">{{ $row->id }}</td>
    </tr>
    <tr>
        <td class="mycolor2"><font color="red">*</font> 회사명</td>
        <td align="left">
            <input type="text" name="coname" value="{{ old('coname',$row->coname) }}" class="form-control form-control-sm" required>
        </td>
    </tr>
    <tr>
        <td class="mycolor2"><font color="red">*</font> 회사전화</td>
        <td align="left">
            <input
                type="text"
                name="cotel"
                value="{{ old('cotel',$row->cotel) }}"
                class="form-control form-control-sm"
                placeholder="숫자만 (예: 01012345678)"
                inputmode="numeric"
                pattern="\d{11}"
                maxlength="11"
                required
            >
            <small id="cotel-msg" class="text-danger d-none">전화번호는 숫자 11자리로 입력하세요.</small>
        </td>
    </tr>
    <tr>
        <td class="mycolor2">창립일</td>
        <td align="left">
            <input type="date" name="startday" value="{{ old('startday', optional($row->startday)->format('Y-m-d')) }}" class="form-control form-control-sm">
        </td>
    </tr>
    <tr>
        <td class="mycolor2">회사분류</td>
        <td align="left">
            <select name="cokind" class="form-select form-select-sm">
                @foreach($a_cokind as $k=>$v)
                    <option value="{{ $k }}" @selected(old('cokind',$row->cokind)==$k)>{{ $v }}</option>
                @endforeach
            </select>
        </td>
    </tr>
</table>

<div align="center">
    <button type="submit" class="btn btn-sm mycolor1">저장</button>
    <a href="javascript:history.back();" class="btn btn-sm mycolor1">이전화면</a>
</div>
</form>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.forms.form1;
    const cotel = form.cotel;
    const msg = document.getElementById('cotel-msg');

    cotel.addEventListener('input', function(e) {
        const onlyDigits = e.target.value.replace(/\D/g, '');
        e.target.value = onlyDigits.slice(0, 11);
        if (msg) msg.classList.add('d-none');
    });

    form.addEventListener('submit', function(e) {
        const v = (cotel.value || '').trim();
        if (v.length === 0) {
            e.preventDefault();
            if (msg) { msg.textContent = '회사전화는 필수입니다.'; msg.classList.remove('d-none'); }
            cotel.focus();
            return;
        }
        if (v.length !== 11) {
            e.preventDefault();
            if (msg) { msg.textContent = '전화번호는 숫자 11자리로 입력하세요(예: 01012345678).'; msg.classList.remove('d-none'); }
            cotel.focus();
        }
    });
});
</script>
@endsection
