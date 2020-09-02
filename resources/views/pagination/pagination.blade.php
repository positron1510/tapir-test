@if($paginator->count > 1)
    <nav aria-label="...">
        <ul class="pagination">
            <li class="page-item @if(!$paginator->previous_page) disabled @endif">
                <a class="page-link" href="{{route($paginator->route, ['per_page'=>$paginator->previous_page])}}/{{$paginator->query_string}}" tabindex="-1">Previous</a>
            </li>

            @for($num = 1; $num <= $paginator->count; $num++)
                <li class="page-item  @if($num == $paginator->per_page) active @endif">
                    <a class="page-link" href="{{route($paginator->route, ['per_page'=>$num])}}/{{$paginator->query_string}}">{{$num}}
                        @if($num == $paginator->per_page)
                            <span class="sr-only">(current)</span>
                        @endif
                    </a>
                </li>
            @endfor

            <li class="page-item @if(!$paginator->next_page) disabled @endif">
                <a class="page-link" href="{{route($paginator->route, ['per_page'=>$paginator->next_page])}}/{{$paginator->query_string}}" tabindex="-1">Next</a>
            </li>
        </ul>
    </nav>
@endif
