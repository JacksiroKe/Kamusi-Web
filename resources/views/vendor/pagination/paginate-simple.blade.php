@if ($paginator->hasPages())
    <nav>
        <ul class="pagination justify-content-end mb-0">
            {{-- Previous Page Link --}}            
            @if ($paginator->onFirstPage())
                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <a class="page-link" href="#" tabindex="-1">
                        <i class="fas fa-angle-left"></i>
                        <span class="sr-only" aria-hidden="true">&lsaquo;</span>
                    </a>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">
                        <i class="fas fa-angle-left"></i>
                        <span class="sr-only">Previous</span>
                    </a>
                </li>
            @endif
            @lang('pagination.previous')

            {{-- Next Page Link --}}
            @lang('pagination.next')

            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">
                        <i class="fas fa-angle-right"></i>
                        <span class="sr-only">Next</span>
                    </a>
                </li>
            @else
                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <a class="page-link" href="#">
                        <i class="fas fa-angle-right"></i>
                        <span class="sr-only" aria-hidden="true">&rsaquo;</span>
                    </a>
                </li>
            @endif
        </ul>
    </nav>
@endif
