@csrf
<div class="mb-3">
  <label class="form-label">이름</label>
  <input type="text" name="name" value="{{ old('name', $worker->name ?? '') }}" class="form-control" maxlength="20" required>
  @error('name')<div class="text-danger small">{{ $message }}</div>@enderror
</div>
<div class="mb-3">
  <label class="form-label">전화(숫자만)</label>
  <input type="text" name="phone" value="{{ old('phone', $worker->phone ?? '') }}" class="form-control" maxlength="11">
  @error('phone')<div class="text-danger small">{{ $message }}</div>@enderror
</div>
<div class="mb-3">
  <label class="form-label">성별</label>
  <select name="gender" class="form-select">
    <option value="">선택</option>
    <option value="남자" @selected(old('gender', $worker->gender ?? '')==='남자')>남자</option>
    <option value="여자" @selected(old('gender', $worker->gender ?? '')==='여자')>여자</option>
  </select>
  @error('gender')<div class="text-danger small">{{ $message }}</div>@enderror
</div>
