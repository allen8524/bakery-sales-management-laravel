@extends('main')

@section('content')

  <div class="d-flex justify-content-between align-items-center mb-3">
    <div class="d-flex align-items-center gap-2">
      <i class="fa fa-exclamation-triangle text-danger"></i>
      <span class="fw-bold">재고 소진</span>

      @if(($soldOutCount ?? 0) > 0)
        <span class="fw-semibold text-danger ms-1">
          상품 {{ $soldOutCount }}개 재고가 모두 소진되었습니다.
        </span>
      @else
        <span class="fw-semibold text-success ms-1">
          재고가 완전히 소진된 상품은 없습니다.
        </span>
      @endif
    </div>
  </div>

  <div class="row g-3 mb-4">
    @forelse($soldOut ?? [] as $item)
      <div class="col-6 col-md-3">
        <div class="stock-card h-100 border rounded-3 p-2 text-center">
          <div class="ratio ratio-1x1 mb-2">
            @if(!empty($item->pic))
              <img src="{{ asset('storage/product_img/' . $item->pic) }}" alt="{{ $item->name }}"
                class="img-fluid rounded-3 object-fit-cover">
            @else
              <div class="d-flex align-items-center justify-content-center rounded-3 bg-light">
                <span class="text-muted small">이미지 없음</span>
              </div>
            @endif
          </div>

          <div class="small fw-semibold mb-1 text-truncate" title="{{ $item->name }}">
            {{ $item->name }}
          </div>

          <div class="small">
            <span class="text-danger fw-bold">재고 소진</span>
          </div>
        </div>
      </div>
    @empty
      <div class="col-12">
        <div class="alert alert-success mb-0">
          재고가 완전히 소진된 상품은 없습니다.
        </div>
      </div>
    @endforelse
  </div>

  <div class="d-flex justify-content-between align-items-center mb-3">
    <div class="d-flex align-items-center gap-2">
      <i class="fa fa-bell text-warning"></i>
      <span class="fw-bold">곧 재고 소진 예정 제품</span>

      @if(($lowStockCount ?? 0) > 0)
        <span class="fw-semibold text-warning ms-1">
          상품 {{ $lowStockCount }}개 재고가 5개 미만입니다.
        </span>
      @else
        <span class="fw-semibold text-success ms-1">
          곧 소진될 상품은 없습니다.
        </span>
      @endif
    </div>
  </div>

  <div class="row g-3">
    @forelse($lowStock ?? [] as $item)
      <div class="col-6 col-md-3">
        <div class="stock-card h-100 border rounded-3 p-2 text-center">
          <div class="ratio ratio-1x1 mb-2">
            @if(!empty($item->pic))
              <img src="{{ asset('storage/product_img/' . $item->pic) }}" alt="{{ $item->name }}"
                class="img-fluid rounded-3 object-fit-cover">
            @else
              <div class="d-flex align-items-center justify-content-center rounded-3 bg-light">
                <span class="text-muted small">이미지 없음</span>
              </div>
            @endif
          </div>

          <div class="small fw-semibold mb-1 text-truncate" title="{{ $item->name }}">
            {{ $item->name }}
          </div>

          <div class="small">
            <span class="text-danger fw-bold">
              재고 {{ (int) $item->jaego }}개 남음
            </span>
          </div>
        </div>
      </div>
    @empty
      <div class="col-12">
        <div class="alert alert-success mb-0">
          재고 5개 미만인 상품은 없습니다.
        </div>
      </div>
    @endforelse
  </div>

  <div class="row g-2 mt-3 align-items-stretch">
    <div class="col-lg-8">
      <div class="bc-panel h-100">
        <div class="bc-panel-inner">

          {{-- 상단: 제목 + 디지털 시계 --}}
          <div class="bc-header">
            <div class="bc-title">
              <span class="bc-title-main">오늘의 영업 일정</span>
              <span class="bc-title-sub">현재 시각과 7일</span>
            </div>
            <div class="bc-clock-wrap">
              <span id="bcHour" class="bc-clock-hour">00</span>
              <span class="bc-clock-colon">:</span>
              <span id="bcMinute" class="bc-clock-minute">00</span>
              <span id="bcAmPm" class="bc-clock-ampm">AM</span>
            </div>
          </div>

          {{-- 가운데: 오늘 날짜 + 요일 --}}
          <div class="bc-today-line">
            <div class="bc-today-left">
              <span id="bcTodayFull" class="bc-today-date">2025.01.01</span>
              <span id="bcDayName" class="bc-today-dow ms-2">WEDNESDAY</span>
            </div>
            <div class="bc-today-right">
              <span class="badge rounded-pill bg-light text-muted">TODAY</span>
            </div>
          </div>

          {{-- 하단: 7일 스트립 (JS가 #bcWeekRow 안을 채움) --}}
          <div class="bc-week-strip" id="bcWeekRow"></div>

        </div>
      </div>
    </div>

    <div class="col-lg-4 d-flex align-items-stretch">
      <div class="bc-calc w-100">
        <div class="bc-calc-display" id="bcCalcDisplay">0</div>
        <div class="bc-calc-grid">
          <button class="bc-btn bc-btn-fn" data-key="AC">AC</button>
          <button class="bc-btn bc-btn-op" data-key="/">÷</button>
          <button class="bc-btn bc-btn-op" data-key="*">×</button>
          <button class="bc-btn bc-btn-op" data-key="-">−</button>

          <button class="bc-btn" data-key="7">7</button>
          <button class="bc-btn" data-key="8">8</button>
          <button class="bc-btn" data-key="9">9</button>
          <button class="bc-btn bc-btn-op" data-key="+">+</button>

          <button class="bc-btn" data-key="4">4</button>
          <button class="bc-btn" data-key="5">5</button>
          <button class="bc-btn" data-key="6">6</button>
          <button class="bc-btn bc-btn-eq" data-key="=">=</button>

          <button class="bc-btn" data-key="1">1</button>
          <button class="bc-btn" data-key="2">2</button>
          <button class="bc-btn" data-key="3">3</button>
          <button class="bc-btn" data-key="0">0</button>

          <button class="bc-btn" data-key=".">.</button>
        </div>
      </div>
    </div>
  </div>

@endsection