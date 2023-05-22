<td class="text-center">
    <div class="dropdown">
        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fas fa-cog"></i>
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="">
            <div class="d-flex justify-content-center align-items-center">
                <a href="{{ route('backend.'. $variable .'Status',['id'=>$value->id]) }}"
                   title="@lang('backend.status')">
                    <input type="checkbox" id="switch"
                           switch="primary" {{ $value->status == 1 ? 'checked' : '' }} />
                    <label for="switch4"></label>
                </a>
            </div>
            <a class="dropdown-item" href="{{ route('backend.'.$variable.'.edit',[\Illuminate\Support\Str::singular($variable) => $value->id]) }}">@lang('backend.edit')</a>
            <a class="dropdown-item text-danger"
               href="{{ route('backend.'.$variable.'Delete',['id'=> $value->id]) }}">@lang('backend.delete')</a>
            <a class="dropdown-item text-red">{{ date('d.m.Y H:i:s',strtotime($value->created_at))}}</a>
        </div>
    </div>
</td>
