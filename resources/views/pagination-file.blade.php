@if($paginator->hasPages())
    <div class="pagination" style="margin-left: 35px;">
        @if($paginator->onFirstPage())
            <span class="">
              <a class="btn btn-default" disabled>Prev</a>
            </span>
        @else
            <span class="">
              <a class="btn btn-default" wire:click="previousPage">Prev</a>
            </span>
        @endif
        
        @foreach($elements as $element)
        @if(is_string($element))
         <span class="">
            <a class="btn btn-info" disabled>{{$page}}</a>
        </span>
        @endif
        @if(is_array($element))
        @foreach($element as $page =>$url)
        @if($page == $paginator->currentPage())
             <span class="">
            <a class="btn btn-info" wire:click="gotoPage">{{$page}}</a>
        </span>
        @else
         <span class="">
            <a class="btn" wire:click="gotoPage({{$page}})">{{$page}}</a>
        </span>
        @endif
        @endforeach
        @endif
        @endforeach
        @if($paginator->hasMorePages())
            <span class="">
            <a class="btn btn-default" wire:click="nextPage">Next</a>
        </span>
        @else
            <span class="">
            <a class="btn btn-default" disabled>Next</a>
        </span>
        @endif
        </div>


@endif