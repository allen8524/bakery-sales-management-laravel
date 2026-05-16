# Bakery Sales Management Laravel

Laravel 기반 베이커리 판매관리 웹 애플리케이션입니다. 매입/매출 장부, 제품/구분 관리, 기간별 조회, 재고 계산, BEST 제품, 월별 제품 현황, 종류별 차트, 사진 목록, 사용자 관리를 구현했습니다.

## 기술 스택

- PHP 8.2 이상
- Laravel 12
- MySQL 또는 MariaDB
- Blade Template
- Bootstrap 5
- jQuery
- Chart.js
- PhpSpreadsheet

## 주요 기능

- 로그인/로그아웃 및 사용자 등급 기반 메뉴 노출
- 제품 구분 CRUD
- 제품 CRUD 및 이미지 업로드
- 매입/매출 장부 CRUD
- 기간별 거래 조회 및 Excel 다운로드
- 재고 재계산
- BEST 제품 조회
- 월별 제품별 판매 현황
- 종류별 판매 분포 차트
- 재고 소진/재고 부족 상품 대시보드

## 실행 방법

```bash
composer install
npm install
cp .env.example .env
php artisan key:generate
```

`.env`의 DB 설정을 로컬 환경에 맞게 수정합니다.

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sale7
DB_USERNAME=root
DB_PASSWORD=
```

샘플 DB를 가져옵니다.

```bash
mysql -u root -p < database/sale7.sql
```

상품 이미지가 보이도록 storage link를 생성합니다.

```bash
php artisan storage:link
```

개발 서버를 실행합니다.

```bash
php artisan serve
```

브라우저에서 접속합니다.

```text
http://localhost:8000
```

## 샘플 로그인

```text
관리자 ID: admin
관리자 PW: 1234
```

## GitHub 업로드 전 확인 사항

- `.env`는 업로드하지 않습니다.
- `vendor`는 업로드하지 않습니다. `composer install`로 복구합니다.
- `node_modules`는 업로드하지 않습니다. `npm install`로 복구합니다.
- `public/storage`는 업로드하지 않습니다. `php artisan storage:link`로 생성합니다.
- 샘플 DB는 `database/sale7.sql`에 포함했습니다.

## 프로젝트 구조

```text
app/Http/Controllers    주요 컨트롤러
app/Models              Eloquent 모델
resources/views         Blade 화면
routes/web.php          웹 라우트
public/my               CSS, JS, 이미지 정적 리소스
storage/app/public      상품 이미지 샘플 데이터
database/sale7.sql      샘플 DB 덤프
```

## 추천 저장소 정보

```text
Repository name: bakery-sales-management-laravel
Description: Laravel 기반 베이커리 판매관리 웹 애플리케이션
Topics: laravel, php, mysql, bootstrap, sales-management, inventory-management, bakery
```
