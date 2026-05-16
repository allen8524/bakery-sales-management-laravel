@if (isset($paginator) && $paginator->lastPage() > 1)

  <nav class="pager-bakery" aria-label="Pagination">
    <ul class="pagination pagination-sm justify-content-center mymargin5">

      @php
        $interval = isset($interval) ? abs(intval($interval)) : 2;
        $from = max(1, $paginator->currentPage() - $interval);
        $to   = min($paginator->lastPage(), $paginator->currentPage() + $interval);
      @endphp

      {{-- 처음 / 이전 --}}
      @if ($paginator->currentPage() > 1)
        <li class="page-item">
          <a class="page-link icon" href="{{ $paginator->url(1) }}" aria-label="First">
            <svg viewBox="0 0 16 16" fill="currentColor" aria-hidden="true">
              <path d="M7.5 12.5L3 8l4.5-4.5M13 12.5L8.5 8 13 3.5"
                    stroke="currentColor" stroke-width="1.5"
                    stroke-linecap="round" stroke-linejoin="round" />
            </svg>
          </a>
        </li>
        <li class="page-item">
          <a class="page-link icon"
             href="{{ $paginator->url($paginator->currentPage() - 1) }}"
             aria-label="Previous">
            <svg viewBox="0 0 16 16" fill="currentColor" aria-hidden="true">
              <path d="M10.5 12.5L6 8l4.5-4.5"
                    stroke="currentColor" stroke-width="1.5"
                    stroke-linecap="round" stroke-linejoin="round" />
            </svg>
          </a>
        </li>
      @endif

      {{-- 숫자 버튼 --}}
      @for ($i = $from; $i <= $to; $i++)
        @php $isCurrentPage = ($paginator->currentPage() == $i); @endphp
        <li class="page-item {{ $isCurrentPage ? 'active' : '' }}">
          @if (!$isCurrentPage)
            <a class="page-link" href="{{ $paginator->url($i) }}"
               aria-label="Go to page {{ $i }}">{{ $i }}</a>
          @else
            <span class="page-link" aria-current="page">{{ $i }}</span>
          @endif
        </li>
      @endfor

      {{-- 다음 / 마지막 --}}
      @if ($paginator->currentPage() < $paginator->lastPage())
        <li class="page-item">
          <a class="page-link icon"
             href="{{ $paginator->url($paginator->currentPage() + 1) }}"
             aria-label="Next">
            <svg viewBox="0 0 16 16" fill="currentColor" aria-hidden="true">
              <path d="M5.5 3.5L10 8l-4.5 4.5"
                    stroke="currentColor" stroke-width="1.5"
                    stroke-linecap="round" stroke-linejoin="round" />
            </svg>
          </a>
        </li>
        <li class="page-item">
          <a class="page-link icon"
             href="{{ $paginator->url($paginator->lastPage()) }}"
             aria-label="Last">
            <svg viewBox="0 0 16 16" fill="currentColor" aria-hidden="true">
              <path d="M3 12.5L7.5 8 3 3.5M8.5 12.5L13 8 8.5 3.5"
                    stroke="currentColor" stroke-width="1.5"
                    stroke-linecap="round" stroke-linejoin="round" />
            </svg>
          </a>
        </li>
      @endif

    </ul>
  </nav>

@endif
