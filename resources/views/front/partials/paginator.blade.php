@if ($paginator->hasPages())
    <div class="places__pagination pagination wow fadeInUp">
        @foreach(range(1, $paginator->lastPage()) as $i)
            @if($i >= $paginator->currentPage() - 2 && $i <= $paginator->currentPage() + 2)
                @if ($i == $paginator->currentPage())
                    <a class="pagination__page active" href="">{{ $i }}</a>
                @else
                    <a class="pagination__page" href="{{ $paginator->url($i) }}">{{ $i }}</a>
                @endif
            @endif
        @endforeach
    </div>
@endif
