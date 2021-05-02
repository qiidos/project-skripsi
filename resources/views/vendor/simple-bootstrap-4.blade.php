@if ($paginator->hasPages())
<nav>
    <ul class="pagination">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
        <li class="page-item disabled" aria-disabled="true">
            <span class="page-link">@lang('pagination.previous')</span>
        </li>
        @else
        <li class="page-item">
            <a class="page-link" style="color: black;" href="{{ $paginator->previousPageUrl() }}" rel="prev">@lang('pagination.previous')</a>
        </li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
        {{-- "Three Dots" Separator --}}
        @if (is_string($element))
        <li class="page-item disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
        @endif

        {{-- Array Of Links --}}
        @if (is_array($element))
        @foreach ($element as $page => $url)
        @if ($page == $paginator->currentPage())
        <li class="page-item active" aria-current="page"><span class="page-link" style="background-color: #303e56; color: white;">{{ $page }}</span></li>
        @else
        <li class="page-item"><a class="page-link" style="color: black;" href="{{ $url }}">{{ $page }}</a></li>
        @endif
        @endforeach
        @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
        <li class="page-item">
            <a class="page-link" style="color: black;" href="{{ $paginator->nextPageUrl() }}" rel="next">@lang('pagination.next')</a>
        </li>
        @else
        <li class="page-item disabled" aria-disabled="true">
            <span class="page-link">@lang('pagination.next')</span>
        </li>
        @endif
    </ul>
    <div>
        <p class="text-sm text-gray-700 leading-5 mt-sm-4 text-center">
            {!! __('Showing') !!}
            <span class="font-medium">{{ $paginator->firstItem() }}</span>
            {!! __('to') !!}
            <span class="font-medium">{{ $paginator->lastItem() }}</span>
            {!! __('of') !!}
            <span class="font-medium">{{ $paginator->total() }}</span>
            {!! __('results') !!}
        </p>
    </div>
</nav>
@endif