@extends('master.backend')
@section('title',__('backend.gallery'))
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
                            <div
                                class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0">@lang('backend.add-new'):@lang('backend.photos')</h4>
                            </div>
                        </div>
                        <div class="col-12">
                            <form action="{{ route('backend.gallery.photos.store',$id) }}" class="needs-validation" novalidate
                                  method="post"
                                  enctype="multipart/form-data">
                                @csrf
                                <input hidden="" name="gallery_id" value="{{ $id }}">
                                <div class="mb-3">
                                    <label>@lang('backend.photos')</label>
                                    <input type="file" class="form-control mb-2" id="photos" name="photos[]"
                                           multiple>
                                    <div id="image-preview-container" class="d-flex flex-wrap"></div>
                                </div>
                                @include('backend.templates.components.buttons')
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="col-12">
                            <div
                                class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0">@lang('backend.gallery'):</h4>
                                <a href="{{ route('backend.gallery.create') }}"
                                   class="btn btn-primary mb-3"><i
                                        class="fas fa-plus"></i> &nbsp;@lang('backend.add-new')
                                </a>
                            </div>
                        </div>
                        <table id="datatable-buttons"
                               class="table table-striped table-bordered dt-responsive nowrap"
                               style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>@lang('backend.photo'):</th>
                                <th>@lang('backend.actions'):</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($photos->photos as $gallery)
                                <tr>
                                    <td>{{ $gallery->id }}</td>
                                    <td><img width="200px" height="150px" src="{{ asset($gallery->photo) }}"></td>
                                    <td class="text-center">
                                        <a class="btn btn-danger"
                                           href="{{ route('backend.gallery.photos.delete',['id'=>$gallery->id]) }}"><i
                                                class="fas fa-trash"></i></a>
                                    </td>
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
    @include('backend.templates.components.preview-images')
    @include('backend.templates.components.dt-scripts')
@endsection
