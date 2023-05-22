<ul class="nav nav-pills nav-justified" role="tablist">
    @foreach(active_langs() as $lan)
        <li class="nav-item waves-effect waves-light">
            <a class="nav-link @if($loop->first) active @endif" data-bs-toggle="tab"
               href="#{{ $lan->code }}" role="tab" aria-selected="true">
                <span class="d-block d-sm-none"><i>{{ $lan->code }}</i></span>
                <span class="d-none d-sm-block">{{ $lan->name }}</span>
            </a>
        </li>
    @endforeach
</ul>
