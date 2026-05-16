@extends('main')
@section('content')

<br>
<div class="alert mycolor1" role="alert">종류별 분포도</div>

<script>
  function find_text() {
    form1.action = "{{ route('chart.index') }}";
    form1.submit();
  }

  $(function () {
    $("#text1").datetimepicker({
      locale: "ko",
      format: "YYYY-MM-DD"
    });

    $("#text2").datetimepicker({
      locale: "ko",
      format: "YYYY-MM-DD"
    });

    $("#text1").on("dp.change", function (e) { find_text(); });
    $("#text2").on("dp.change", function (e) { find_text(); });
  });
</script>

<form name="form1" action="">
  <div class="row">
    <div class="col-12" align="left">
      <div class="d-inline-flex">
        <div class="input-group input-group-sm date" id="text1">
          <span class="input-group-text">날짜</span>
          <input type="text" name="text1" size="10" value="{{ $text1 }}" class="form-control"
                 onKeydown="if (event.keyCode == 13) { find_text(); }">
          <span class="input-group-text">
            <div class="input-group-addon">
              <i class="far fa-calendar-alt fa-lg"></i>
            </div>
          </span>
        </div>
      </div>
      -
      <div class="d-inline-flex">
        <div class="input-group input-group-sm date" id="text2">
          <input type="text" name="text2" size="10" value="{{ $text2 }}" class="form-control"
                 onKeydown="if (event.keyCode == 13) { find_text(); }">
          <span class="input-group-text">
            <div class="input-group-addon">
              <i class="far fa-calendar-alt fa-lg"></i>
            </div>
          </span>
        </div>
      </div>
    </div>
  </div>
</form>

<br>

<script src="{{ asset('my/js/chart.min.js') }}"></script>

<div class="card shadow-sm">
  <div class="card-body">
    <div class="d-flex justify-content-between align-items-center mb-2">
      <h5 class="mb-0">기간 : {{ $text1 }} ~ {{ $text2 }}</h5>
      <small class="text-muted">단위 : 건</small>
    </div>

    <div style="position:relative; height:380px; width:100%;">
      <canvas id="myChart"></canvas>
    </div>
  </div>
</div>

<script>
    const ctx    = document.getElementById('myChart').getContext('2d');
    const labels = [ {!! $str_label !!} ];
    const data   = [ {{ $str_data }} ];

    const palette = [
      "rgba(255, 99, 132, 0.8)",
      "rgba(255, 159, 64, 0.8)",
      "rgba(255, 205, 86, 0.8)",
      "rgba(75, 192, 192, 0.8)",
      "rgba(153, 102, 255, 0.8)",
      "rgba(201, 203, 207, 0.8)",
      "rgba(54, 162, 235, 0.8)",
      "rgba(255, 99, 132, 0.5)",
      "rgba(255, 159, 64, 0.5)",
      "rgba(255, 205, 86, 0.5)",
      "rgba(75, 192, 192, 0.5)",
      "rgba(153, 102, 255, 0.5)",
      "rgba(201, 203, 207, 0.5)",
      "rgba(54, 162, 235, 0.5)"
    ];

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: '판매 수량',               // ★ undefined 대신 이 텍스트가 범례에 나옴
                data: data,
                backgroundColor: data.map((_, i) => palette[i % palette.length]),
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });
</script>

@endsection
