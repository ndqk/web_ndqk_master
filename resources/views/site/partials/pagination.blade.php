@if ($paginator->hasPages())
<div class="row pagination-wrap">
    <div class="col-full">
        <nav class="pgn" data-aos="fade-up">
            <ul>
                @if (!$paginator->onFirstPage())
                    <li><a class="pgn__prev" href="{{$paginator->previousPageUrl()}}">Prev</a></li>
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
                        <li><a class="pgn__num current" href="{{$paginator->url($i)}}">{{$i}}</a></li>    
                    @else
                    <li><a class="pgn__num" href="{{$paginator->url($i)}}">{{$i}}</a></li>    
                    @endif
                @endfor
                @if ($paginator->hasMorePages())
                    <li><a class="pgn__next" href="{{$paginator->nextPageUrl()}}">Next</a></li>
                @endif
            </ul>
        </nav>
    </div>
</div>
@endif