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
               href="{{ route('backend.'.$variable.'.edit',[\Illuminate\Support\Str::singular($variable) => $value->id]) }}"><i
                    class="fas fa-pen"></i>&nbsp;@lang('backend.edit')</a>
            <a class="dropdown-item text-danger delete-button" data-toggle="modal"
               data-target="#deleteModal{{ $value->id }}"><i class="fas fa-trash"></i>&nbsp;@lang('backend.delete')</a>
            <a class="dropdown-item text-red"><i
                    class="fas fa-clock"></i>&nbsp;{{ date('d.m.Y H:i:s',strtotime($value->created_at))}}</a>
        </div>
    </div>
</td>
<div class="modal fade" id="deleteModal{{ $value->id }}" tabindex="-1" role="dialog"
     aria-labelledby="deleteModalLabel{{ $value->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel{{ $value->id }}">@lang('backend.confirm-delete')</h5>
            </div>
            <div class="modal-body">
                <p>@lang('backend.are-sure-delete')</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary cancel-button" data-dismiss="modal">@lang('backend.cancel')</button>
                <a href="{{ route('backend.'.$variable.'Delete',['id'=> $value->id]) }}"
                   class="btn btn-danger">@lang('backend.confrim')</a>
            </div>
        </div>
    </div>
</div>
@section('scripts')
    <script>
        $(document).ready(function () {
            $('.delete-button').click(function (e) {
                $('#deleteModal{{ $value->id }}').modal('show');
            });
            $('.cancel-button').click(function (e) {
                $('#deleteModal{{ $value->id }}').modal('hide');
            });
        });
    </script>
@endsection
