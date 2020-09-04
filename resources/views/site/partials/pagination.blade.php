
@if ($paginator->hasPages())
<nav class="pagination_" aria-label="navigation">
    <ul class="pagination mt-50 mb-70">
        @if (!$paginator->onFirstPage())
            <li class="page-item"><a class="page-link" href="{{$paginator->previousPageUrl()}}"><i class="fa fa-angle-left"></i></a></li>
        @endif
        @php
            //$rangeLimit  = 5;
            $pageCount =  $paginator->lastPage();
            
            $curr = $paginator->currentPage();
            
            if($pageCount <= $rangeLimit) {
                $start = 1;
                $end = $pageCount;    
            }
            else{
                $mid =  round($rangeLimit / 2);
                    if($curr <= $mid){
                        $start = 1;
                    }
                    else{
                        $start = $curr - 2;
                        if($start + $rangeLimit >= $pageCount){
                            $start = $start - ($start + $rangeLimit - $pageCount);
                        }
                    }
                        $end = $start + $rangeLimit;  
            }
        @endphp
        @for ($i = $start; $i <= $end; $i++)
            @if ($i == $curr)
                <li class="page-item {{$i == $curr ? 'active' : ''}}"><a class="page-link" href="{{$paginator->url($i)}}">{{$i}}</a></li>
            @else
                <li class="page-item"><a class="page-link" href="{{$paginator->url($i)}}">{{$i}}</a></li>    
            @endif
        @endfor
            @if ($paginator->hasMorePages())
                <li class="page-item"><a class="page-link" href="{{$paginator->nextPageUrl()}}"><i class="fa fa-angle-right"></i></a></li>
            @endif
        </ul>
</nav>
@endif