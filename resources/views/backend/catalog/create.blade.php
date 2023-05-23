@extends('master.backend')
@section('title',__('backend.catalog'))
@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-xl-9">
                        <div class="card">
                            <form action="{{ route('backend.catalog.store') }}" class="needs-validation" novalidate
                                  method="post"
                                  enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    @include('backend.templates.components.card-col-12',['variable' => 'catalog'])
                                    @include('backend.templates.components.multi-lan-tab')
                                    <div class="tab-content p-3 text-muted">
                                        @foreach(active_langs() as $lan)
                                            <div class="tab-pane @if($loop->first) active show @endif"
                                                 id="{{ $lan->code }}"
                                                 role="tabpanel">
                                                <div class="form-group row">
                                                    @include('backend.templates.items.create.validations.name')
                                                    @include('backend.templates.items.create.validations.description')
                                                </div>
                                            </div>
                                        @endforeach
                                        @include('backend.templates.items.create.validations.photo')
                                        @include('backend.templates.items.create.validations.photos')
                                    </div>
                                </div>
                                @include('backend.templates.components.buttons')
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    @include('backend.templates.components.tiny')
    @include('backend.templates.components.preview-images')
@endsection
