@extends('layout.master')

@push('plugin-styles')
    {!! Html::style('assets/css/loader.css') !!}
    {!! Html::style('plugins/bootstrap-select/bootstrap-select.min.css') !!}
    {!! Html::style('assets/css/forms/form-widgets.css') !!}
    {!! Html::style('plugins/flatpickr/flatpickr.css') !!}
    {!! Html::style('plugins/flatpickr/custom-flatpickr.css') !!}
    {!! Html::style('assets/css/forms/switch-theme.css') !!}
    {!! Html::style('plugins/table/datatable/dt-global_style.css') !!}
@endpush

@section('content')
    <div class="sub-header-container">
        <header class="header navbar navbar-expand-sm">
            <div class="navbar-nav flex-column">
                <h2>{{__('Upload New File')}}</h2>
            </div>
            <ul class="navbar-nav d-flex align-center ml-auto right-side-filter flex-column">
                <li>
                    <a href="{{ route('cmx-media.index') }}" class="btn btn-link text-reset">
                        <i class="las la-angle-left"></i>
                        <span>{{__('Back to uploaded files')}}</span>
                    </a>
                </li>
                <li>
                    <i class="las la-angle-double-right"></i>
                    <span id="currentDate"></span>
                </li>
            </ul>
        </header>
    </div>

    <div class="content px-3">

        @include('flash::message')

        <div class="clearfix"></div>

        <div class="row layout-top-spacing data-table-container">
            <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
                <div class="widget-content widget-content-area br-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0 h6">{{__('Drag & drop your files')}}</h5>
                        </div>
                        <div class="card-body">
                            <div id="cmx-upload-files" class="h-420px" style="min-height: 65vh">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            CMX.plugins.cmxUppy();
        });
    </script>
@endpush

@push('plugin-scripts')
    {!! Html::script('assets/js/loader.js') !!}
    {!! Html::script('assets/js/forms/forms-validation.js') !!}
    {!! Html::script('plugins/bootstrap-select/bootstrap-select.min.js') !!}
    {!! Html::script('plugins/flatpickr/flatpickr.js') !!}
@endpush
