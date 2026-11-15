@if ($paginator->hasPages())
<nav role="navigation" aria-label="Pagination" style="display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 12px; padding: 8px 0; font-size: 13px; font-family: inherit;">

    {{-- Info teks: Showing X to Y of Z results --}}
    <div style="color: #64748b;">
        @if ($paginator->firstItem())
            Showing <strong>{{ $paginator->firstItem() }}</strong> to <strong>{{ $paginator->lastItem() }}</strong> of <strong>{{ $paginator->total() }}</strong> results
        @else
            {{ $paginator->count() }} results
        @endif
    </div>

    {{-- Tombol-tombol halaman --}}
    <div style="display: flex; align-items: center; gap: 4px;">

        {{-- Previous --}}
        @if ($paginator->onFirstPage())
            <span style="display:inline-flex; align-items:center; padding: 5px 10px; border: 1px solid #e2e8f0; border-radius: 6px; color: #cbd5e1; cursor: not-allowed; background: #f8fafc; font-size: 13px;">
                &laquo;
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev"
               style="display:inline-flex; align-items:center; padding: 5px 10px; border: 1px solid #e2e8f0; border-radius: 6px; color: #475569; background: #fff; text-decoration: none; font-size: 13px; transition: background 0.15s;"
               onmouseover="this.style.background='#f1f5f9'" onmouseout="this.style.background='#fff'">
                &laquo;
            </a>
        @endif

        {{-- Nomor halaman --}}
        @foreach ($elements as $element)
            @if (is_string($element))
                <span style="display:inline-flex; align-items:center; padding: 5px 10px; color: #94a3b8; font-size: 13px;">{{ $element }}</span>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span aria-current="page"
                              style="display:inline-flex; align-items:center; padding: 5px 10px; border: 1px solid #55ACEE; border-radius: 6px; background: #55ACEE; color: #fff; font-weight: 600; font-size: 13px;">
                            {{ $page }}
                        </span>
                    @else
                        <a href="{{ $url }}"
                           style="display:inline-flex; align-items:center; padding: 5px 10px; border: 1px solid #e2e8f0; border-radius: 6px; color: #475569; background: #fff; text-decoration: none; font-size: 13px; transition: background 0.15s;"
                           onmouseover="this.style.background='#f1f5f9'" onmouseout="this.style.background='#fff'"
                           aria-label="Go to page {{ $page }}">
                            {{ $page }}
                        </a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next"
               style="display:inline-flex; align-items:center; padding: 5px 10px; border: 1px solid #e2e8f0; border-radius: 6px; color: #475569; background: #fff; text-decoration: none; font-size: 13px; transition: background 0.15s;"
               onmouseover="this.style.background='#f1f5f9'" onmouseout="this.style.background='#fff'">
                &raquo;
            </a>
        @else
            <span style="display:inline-flex; align-items:center; padding: 5px 10px; border: 1px solid #e2e8f0; border-radius: 6px; color: #cbd5e1; cursor: not-allowed; background: #f8fafc; font-size: 13px;">
                &raquo;
            </span>
        @endif

    </div>
</nav>
@endif
