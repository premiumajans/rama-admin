@extends('master.backend')
@section('title',__('backend.'.$selection))
@section('styles')
    @include('backend.templates.components.dt-styles')
@endsection
@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-body">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0">@lang('backend.'.$selection):</h4>
                                <a href="{{ route('backend.'.$selection.'.create') }}" class="btn btn-primary mb-3"><i
                                        class="fas fa-plus"></i> &nbsp;@lang('backend.add-new')
                                </a>
                            </div>
                        </div>
                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                               style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th>ID</th>
                                @foreach($tableHeads as $th)
                                    <th>@lang('backend.'.$th)</th>
                                @endforeach
                                <th>@lang('backend.actions'):</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($selections as $selection)
                                <tr>
                                    <td>{{ $selection->id }}</td>
                                    @yield('table-body')
                                    @include('backend.templates.components.dt-settings',['variable' => $selection,'value' => $selection])
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    @include('backend.templates.components.dt-scripts')
@endsection
