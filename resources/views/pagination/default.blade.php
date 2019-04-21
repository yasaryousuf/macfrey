@if ($paginator->hasPages())
    <div class="page-navigation">
        <p>
            Page {{$paginator->currentPage()}} of {{$paginator->total()}}.
        </p>
        <ul class="f3-widget-paginator">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())

        @else
            <li class="previous">
                <a href="{{ $paginator->previousPageUrl() }}">
                    Previous
                </a>
            </li>        
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li>....</li>
                {{-- <li class="page-item disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></li> --}}
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                    <li class="current">{{ $page }}</li>
                        {{-- <li class="page-item active" aria-current="page"><span class="page-link">{{ $page }}</span></li> --}}
                    @else
                        {{-- <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li> --}}
                    <li>
                        <a href="{{ $url }}">{{ $page }}</a>
                    </li>                        
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="last next">
                <a href="{{ $paginator->nextPageUrl() }}">
                    Next
                </a>
            </li>  
        @else      

        @endif
    </ul>
@endif
