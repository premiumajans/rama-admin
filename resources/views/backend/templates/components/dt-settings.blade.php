<td class="text-center">
    <div class="dropdown">
        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown"
                aria-expanded="false">
            <i class="fas fa-cog"></i>
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="">
            <div class="dropdown-item">
                <a href="{{ route('backend.'. $variable .'Status',['id'=>$value->id]) }}"
                   title="@lang('backend.status')">
                    <input type="checkbox" id="switch"
                           switch="primary" {{ $value->status == 1 ? 'checked' : '' }} />
                    <label for="switch4"></label>
                </a>
            </div>
            <a class="dropdown-item"
               href="{{ route('backend.'.$variable.'.edit',[ \Illuminate\Support\Str::replace('-','_',\Illuminate\Support\Str::singular($variable)) => $value->id]) }}"><i
                    class="fas fa-pen"></i>&nbsp;@lang('backend.edit')</a>
            <a class="dropdown-item text-danger delete-button" href="{{ route('backend.'. $variable .'Delete',['id'=>$value->id]) }}"><i class="fas fa-trash"></i>&nbsp;@lang('backend.delete')</a>
            <a class="dropdown-item text-red"><i
                    class="fas fa-clock"></i>&nbsp;{{ date('d.m.Y H:i:s',strtotime($value->created_at))}}</a>
        </div>
    </div>
</td>

