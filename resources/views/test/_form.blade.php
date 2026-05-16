@php($row = $row ?? null)
@csrf
<div class="mb-3">
  <label class="form-label">회사명</label>
  <input type="text" name="coname" class="form-control"
         value="{{ old('coname', $row->coname ?? '') }}" required>
</div>

<div class="mb-3">
  <label class="form-label">회사전화</label>
  <input type="text" name="cotel" class="form-control"
         value="{{ old('cotel', $row->cotel ?? '') }}" placeholder="숫자만(예: 01022223333)">
  <div class="form-text">빈칸이면 기본값 01022223333이 저장됩니다.</div>
</div>

<div class="mb-3">
  <label class="form-label">창립일</label>
  <input type="date" name="startday" class="form-control"
         value="{{ old('startday', isset($row->startday) ? $row->startday->format('Y-m-d') : '') }}">
</div>

<div class="mb-3">
  <label class="form-label">회사분류</label>
  <select name="cokind" class="form-select">
    @foreach($a_cokind as $k => $v)
      <option value="{{ $k }}" @selected(old('cokind', $row->cokind ?? 0)==$k)>{{ $v }}</option>
    @endforeach
  </select>
</div>

@if ($errors->any())
  <div class="alert alert-danger">
    @foreach ($errors->all() as $e)
      <div>{{ $e }}</div>
    @endforeach
  </div>
@endif
