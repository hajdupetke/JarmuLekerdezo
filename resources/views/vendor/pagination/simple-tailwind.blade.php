@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex items-center justify-center p-4 space-x-4">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span class="relative inline-flex items-center h-10 px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-500 cursor-default leading-5 rounded-md dark:bg-gray-900">
                {!! __('pagination.previous') !!}
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="inline-flex items-center justify-center rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 border bg-background hover:bg-accent hover:text-accent-foreground h-10 px-4 py-2 border-gray-600 hover:bg-gray-600 hover:text-white dark:text-white dark:hover:bg-gray-600 dark:hover:text-white duration-150">
                {!! __('pagination.previous') !!}
            </a>
        @endif

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="inline-flex items-center justify-center rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 border bg-background hover:bg-accent hover:text-accent-foreground h-10 px-4 py-2 border-gray-600 hover:bg-gray-600 hover:text-white dark:text-white dark:hover:bg-gray-600 dark:hover:text-white duration-150">
                {!! __('pagination.next') !!}
            </a>
        @else
            <span class="rinline-flex items-center justify-center rounded-md text-sm h-10 px-4 py-2 font-medium text-gray-500 bg-white border border-gray-500 cursor-default leading-5 dark:bg-gray-900">
                {!! __('pagination.next') !!}
            </span>
        @endif
    </nav>
@endif
