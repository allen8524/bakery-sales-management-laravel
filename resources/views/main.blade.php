<!doctype html>
<html lang="ko">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>판매관리</title>

  <link href="{{ asset('my/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('my/css/my.css') }}" rel="stylesheet">
  <script src="{{ asset('my/js/jquery-3.7.1.min.js') }}"></script>
  <script src="{{ asset('my/js/bootstrap.bundle.min.js') }}"></script>

  <script src="{{ asset('/my/js/moment-with-locales.min.js') }}"></script>
  <script src="{{ asset('/my/js/bootstrap5-datetimepicker.min.js') }}"></script>
  <link href="{{ asset('/my/css/bootstrap5-datetimepicker.min.css') }}" rel="stylesheet">
  <link href="{{ asset('my/css/all.min.css') }}" rel="stylesheet">
</head>
<body class="bakery-body">

<div class="bakery-layout d-flex">

  <aside class="bakery-sidebar">
    <a href="{{ url('/') }}" class="bakery-sidebar-brand text-decoration-none">
      <span class="bakery-brand-icon">
        <i class="fa fa-birthday-cake" aria-hidden="true"></i>
      </span>
      <span class="bakery-brand-title">La Petite Blanc</span>
    </a>

    <div class="bakery-sidebar-section">판매관리</div>
    <ul class="bakery-sidebar-nav">
      <li>
        <a href="{{ route('jangbui.index') }}"
           class="bakery-sidebar-link {{ request()->routeIs('jangbui.*') ? 'active' : '' }}">
          <i class="fa fa-box-open"></i>
          <span>매입</span>
        </a>
      </li>
      <li>
        <a href="{{ route('jangbuo.index') }}"
           class="bakery-sidebar-link {{ request()->routeIs('jangbuo.*') ? 'active' : '' }}">
          <i class="fa fa-shopping-bag"></i>
          <span>매출</span>
        </a>
      </li>
      <li>
        <a href="{{ route('gigan.index') }}"
           class="bakery-sidebar-link {{ request()->routeIs('gigan.*') ? 'active' : '' }}">
          <i class="fa fa-calendar-alt"></i>
          <span>기간조회</span>
        </a>
      </li>
    </ul>

    <div class="bakery-sidebar-section">통계</div>
    <ul class="bakery-sidebar-nav">
      <li>
        <a href="{{ route('best.index') }}"
           class="bakery-sidebar-link {{ request()->routeIs('best.*') ? 'active' : '' }}">
          <i class="fa fa-star"></i>
          <span>BEST제품</span>
        </a>
      </li>
      <li>
        <a href="{{ route('crosstab.index') }}"
           class="bakery-sidebar-link {{ request()->routeIs('crosstab.*') ? 'active' : '' }}">
          <i class="fa fa-table"></i>
          <span>월별제품별현황</span>
        </a>
      </li>
      <li>
        <a href="{{ route('chart.index') }}"
           class="bakery-sidebar-link {{ request()->routeIs('chart.*') ? 'active' : '' }}">
          <i class="fa fa-chart-pie"></i>
          <span>종류별 분포도</span>
        </a>
      </li>
    </ul>

    <div class="bakery-sidebar-section">기초정보</div>
    <ul class="bakery-sidebar-nav">
      <li>
        <a href="{{ route('gubun.index') }}"
           class="bakery-sidebar-link {{ request()->routeIs('gubun.*') ? 'active' : '' }}">
          <i class="fa fa-tags"></i>
          <span>구분</span>
        </a>
      </li>
      <li>
        <a href="{{ route('product.index') }}"
           class="bakery-sidebar-link {{ request()->routeIs('product.*') ? 'active' : '' }}">
          <i class="fa fa-bread-slice"></i>
          <span>제품</span>
        </a>
      </li>
      @if (session()->get("rank")==1)
        <li>
          <a href="{{ route('member.index') }}"
             class="bakery-sidebar-link {{ request()->routeIs('member.*') ? 'active' : '' }}">
            <i class="fa fa-user-friends"></i>
            <span>사용자</span>
          </a>
        </li>
      @endif
    </ul>

    <div class="bakery-sidebar-section">기타</div>
    <ul class="bakery-sidebar-nav">
      <li>
        <a href="{{ route('picture.index') }}"
           class="bakery-sidebar-link {{ request()->routeIs('picture.*') ? 'active' : '' }}">
          <i class="fa fa-image"></i>
          <span>사진</span>
        </a>
      </li>
      <li>
        <a href="{{ route('ajax.index') }}"
           class="bakery-sidebar-link {{ request()->routeIs('ajax.*') ? 'active' : '' }}">
          <i class="fa fa-bolt"></i>
          <span>비동기 조회</span>
        </a>
      </li>
    </ul>
    
    <div class="bakery-sidebar-footer">
      @if (!session()->exists("uid"))
        <button type="button"
                class="btn btn-sm btn-outline-light w-100"
                data-bs-toggle="modal" data-bs-target="#exampleModal">
          <i class="fa fa-sign-in-alt"></i> 로그인
        </button>
      @else
        <div class="mb-2 small text-muted">
          <i class="fa fa-circle text-success"></i>
          <span class="ms-1">{{ session('uid') }}님 접속중</span>
        </div>
        <a href="{{ route('login.logout') }}" class="btn btn-sm btn-outline-light w-100">
          <i class="fa fa-sign-out-alt"></i> 로그아웃
        </a>
      @endif
    </div>
    <div class="mb-2 text-center">
      <span class="badge rounded-pill bg-light border text-muted px-3 py-2">
        <i class="fa fa-keyboard me-1"></i>
        좌우 방향키를 입력해보세요!
      </span>
    </div>
  </aside>

  <div class="bakery-main flex-grow-1 d-flex flex-column">

    <header class="bakery-topbar d-flex align-items-center justify-content-between">
      <div class="d-flex align-items-center gap-2">
        <button class="btn btn-link p-0 bakery-topbar-toggle" id="btnSidebarToggle" type="button">
          <i class="fa fa-bars"></i>
        </button>
        <span class="bakery-topbar-title">베이커리 판매관리 프로그램</span>
      </div>

      <div class="d-flex align-items-center gap-2">
        @if (session()->exists("uid"))
          <span class="small text-muted d-none d-sm-inline">{{ session('uid') }}님</span>
        @endif
      </div>
    </header>

    <main class="bakery-main-inner">
      @if (session('login_error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          {{ session('login_error') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif

      @php
        $heroImages = [
          'my/img/bakery_banner1.png',
          'my/img/bakery_banner2.png',
          'my/img/bakery_banner3.png',
        ];
      @endphp

      <div class="bakery-hero mb-3 js-bakery-hero" data-interval="4000">
        @foreach($heroImages as $idx => $path)
          <img src="{{ asset($path) }}"
               class="img-fluid bakery-hero-img {{ $idx === 0 ? 'is-active' : '' }}"
               alt="베이커리 이미지 {{ $idx+1 }}">
        @endforeach
      </div>

      <div class="content-card shadow-sm rounded-3 p-3 mb-4 bg-white">
        @yield("content")
      </div>
    </main>

  </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1"
     aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">

      <div class="modal-header mycolor1">
        <h5 class="modal-title" id="exampleModalLabel">로그인</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body bg-bakery-cream">
        <form name="form_login" method="post" action="{{ route('login.check') }}">
          @csrf
          <table class="table table-borderless mymargin5 mb-0">
            <tr>
              <td width="30%"><h6 class="mb-1">아이디</h6></td>
              <td width="70%"><input type="text" name="uid" class="form-control form-control-sm"></td>
            </tr>
            <tr>
              <td><h6 class="mb-1">암&nbsp;호</h6></td>
              <td><input type="password" name="pwd" class="form-control form-control-sm"></td>
            </tr>
          </table>
        </form>
      </div>

      <div class="modal-footer bakery-modal-footer">
        <button type="button" class="btn btn-sm mycolor1"
                onclick="document.forms['form_login'].submit();">확인</button>
        <button type="button" class="btn btn-sm btn-light" data-bs-dismiss="modal">닫기</button>
      </div>

    </div>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const hero = document.querySelector('.js-bakery-hero');
    if (hero) {
      const slides = hero.querySelectorAll('.bakery-hero-img');
      if (slides.length > 1) {
        const interval = Number(hero.dataset.interval || 5000);
        let index = 0;
        setInterval(function () {
          slides[index].classList.remove('is-active');
          index = (index + 1) % slides.length;
          slides[index].classList.add('is-active');
        }, interval);
      }
    }

    const btnTop = document.querySelector('.js-scroll-top');
    const btnBottom = document.querySelector('.js-scroll-bottom');

    if (btnTop) {
      btnTop.addEventListener('click', function () {
        window.scrollTo({
          top: 0,
          behavior: 'smooth'
        });
      });
    }

    if (btnBottom) {
      btnBottom.addEventListener('click', function () {
        window.scrollTo({
          top: document.documentElement.scrollHeight,
          behavior: 'smooth'
        });
      });
    }
  });
</script>

<script>
  (function () {
    function pad2(n) {
      n = parseInt(n, 10);
      return (n < 10 ? '0' : '') + n;
    }

    function initDashboard() {
      var hourEl   = document.getElementById('bcHour');
      var minuteEl = document.getElementById('bcMinute');
      var ampmEl   = document.getElementById('bcAmPm');
      var dayNameEl= document.getElementById('bcDayName');
      var todayEl  = document.getElementById('bcTodayFull');
      var weekRow  = document.getElementById('bcWeekRow');

      function updateClock() {
        if (typeof moment === 'undefined' || !hourEl) return;
        var now = moment();
        hourEl.textContent   = pad2(now.hour());
        minuteEl.textContent = pad2(now.minute());
        ampmEl.textContent   = now.format('A');
        dayNameEl.textContent= now.format('dddd').toUpperCase();
        todayEl.textContent  = now.format('YYYY.MM.DD');
      }

      function buildWeek() {
        if (typeof moment === 'undefined' || !weekRow) return;
        weekRow.innerHTML = '';
        for (var i = 0; i < 7; i++) {
          var d = moment().add(i, 'days');
          var div = document.createElement('div');
          div.className = 'bc-day-card';
          div.innerHTML =
            '<div class="bc-day-name">' + d.format('ddd').toUpperCase() + '</div>' +
            '<div class="bc-day-date">' + d.format('D') + '</div>';
          weekRow.appendChild(div);
        }
      }

      if (typeof moment !== 'undefined') {
        buildWeek();
        updateClock();
        setInterval(updateClock, 30000);
      }

      var calcDisplay = document.getElementById('bcCalcDisplay');
      var calcButtons = document.querySelectorAll('.bc-calc-grid .bc-btn');
      var calcExpr    = '';
      var calcJustEq  = false;

      function safeEvalExpr(expr) {
        var safe = expr.replace(/[^0-9+\-*\/.]/g, '');
        if (!safe) return 0;
        try {
          return Function('return ' + safe)();
        } catch (e) {
          return 'Err';
        }
      }

      function handleCalcKey(key) {
        if (!calcDisplay) return;

        if (key === 'AC') {
          calcExpr   = '';
          calcJustEq = false;
          calcDisplay.textContent = '0';
          return;
        }

        if (key === '=') {
          if (!calcExpr) return;
          var result = safeEvalExpr(calcExpr);
          calcDisplay.textContent = result === 'Err' ? 'Error' : result;
          calcExpr   = result === 'Err' ? '' : String(result);
          calcJustEq = true;
          return;
        }

        if ('0123456789.'.indexOf(key) !== -1) {
          if (calcJustEq) {
            calcExpr   = '';
            calcJustEq = false;
          }
          calcExpr += key;
          calcDisplay.textContent = calcExpr || '0';
          return;
        }

        if ('+-*/'.indexOf(key) !== -1) {
          calcJustEq = false;
          if (!calcExpr) return;
          var last = calcExpr.slice(-1);
          if ('+-*/'.indexOf(last) !== -1) {
            calcExpr = calcExpr.slice(0, -1) + key;
          } else {
            calcExpr += key;
          }
          calcDisplay.textContent = calcExpr;
        }
      }

      if (calcButtons.length && calcDisplay) {
        calcButtons.forEach(function (btn) {
          btn.addEventListener('click', function () {
            var key = this.dataset.key;
            handleCalcKey(key);
          });
        });
      }

      var layout   = document.querySelector('.bakery-layout');
      var btnToggle = document.getElementById('btnSidebarToggle');

      if (layout && btnToggle) {
        btnToggle.addEventListener('click', function () {
          layout.classList.toggle('sidebar-hidden');
        });
      }

      if (layout) {
        document.addEventListener('keydown', function (e) {
          var tag = e.target.tagName;
          var isEditable = e.target.isContentEditable;

          if (tag === 'INPUT' || tag === 'TEXTAREA' || isEditable) return;

          if (e.key === 'ArrowLeft') {
            layout.classList.add('sidebar-hidden');
          } else if (e.key === 'ArrowRight') {
            layout.classList.remove('sidebar-hidden');
          }
        });
      }
    }

    if (document.readyState === 'loading') {
      document.addEventListener('DOMContentLoaded', initDashboard);
    } else {
      initDashboard();
    }
  })();
</script>

<div class="bakery-scroll-controls">
  <button type="button" class="bakery-scroll-btn js-scroll-top" aria-label="맨 위로">
    <i class="fa fa-arrow-up"></i>
  </button>
  <button type="button" class="bakery-scroll-btn js-scroll-bottom" aria-label="맨 아래로">
    <i class="fa fa-arrow-down"></i>
  </button>
</div>
</body>
</html>
