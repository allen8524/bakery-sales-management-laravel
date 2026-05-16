<!---------------------------------------------------------------------------------------------
	제목 : Django Tutorial (실습용 디자인 HTML)

	소속 : 인덕대학교 컴퓨터소프트웨어학과
	이름 : 교수 윤형태 (2025.01)
---------------------------------------------------------------------------------------------->
<!doctype html>
<html lang="kr">
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
<body>

<div class="container">


@yield("content")

</div>

</body>
</html>

