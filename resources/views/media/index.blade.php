@extends('layouts.master')

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
                <h2>{{__('All uploaded files')}}</h2>
            </div>
            <ul class="navbar-nav d-flex align-center ml-auto right-side-filter flex-column">
                <li>
                    <a href="{{ route('cmx-media.create') }}" class="btn btn-primary">
                        <span>{{__('Upload New File')}}</span>
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
                        <form id="sort_uploads" action="">
                            <div class="card-header d-flex">
                                <div class="col-md-3">
                                    <h5 class="mt-3 h6">{{__('All files')}}</h5>
                                </div>
                                <div class="col-md-3 ml-auto mr-0">
                                    <select class="form-control selectpicker" name="sort"
                                            onchange="CMX.uploader.sort()">
                                        <option value="newest"
                                                @if($sort_by == 'newest') selected="" @endif>{{ __('Sort by newest') }}</option>
                                        <option value="oldest"
                                                @if($sort_by == 'oldest') selected="" @endif>{{ __('Sort by oldest') }}</option>
                                        <option value="smallest"
                                                @if($sort_by == 'smallest') selected="" @endif>{{ __('Sort by smallest') }}</option>
                                        <option value="largest"
                                                @if($sort_by == 'largest') selected="" @endif>{{ __('Sort by largest') }}</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <input type="text" class="form-control" name="search"
                                           placeholder="{{ __('Search your files') }}" value="{{ $search }}">
                                </div>
                                <div class="col-auto pt-1">
                                    <button type="submit" class="btn btn-lg btn-primary">{{ __('Search') }}</button>
                                </div>
                            </div>
                        </form>
                        <div class="card-body">
                            <div class="row gutters-5">
                                @foreach($all_uploads as $key => $file)
                                    @php
                                        if($file->file_original_name == null){
                                            $file_name = __('Unknown');
                                        }else{
                                            $file_name = $file->file_original_name;
                                        }
                                    @endphp
                                    <div class="col-auto w-140px w-lg-220px">
                                        <div class="cmx-file-box">
                                            <div class="dropdown-file">
                                                <a class="dropdown-link" data-toggle="dropdown">
                                                    <i class="la la-ellipsis-v"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a href="javascript:void(0)" class="dropdown-item"
                                                       onclick="CMX.uploader.fileDetails(this)"
                                                       data-id="{{ $file->id }}">
                                                        <i class="las la-info-circle mr-2"></i>
                                                        <span>{{ __('Details Info') }}</span>
                                                    </a>
                                                    <a href="{{ my_asset($file->file_name) }}" target="_blank"
                                                       download="{{ $file_name }}.{{ $file->extension }}"
                                                       class="dropdown-item">
                                                        <i class="la la-download mr-2"></i>
                                                        <span>{{ __('Download') }}</span>
                                                    </a>
                                                    <a href="javascript:void(0)" class="dropdown-item"
                                                       onclick="CMX.uploader.copyUrl(this)"
                                                       data-url="{{ my_asset($file->file_name) }}">
                                                        <i class="las la-clipboard mr-2"></i>
                                                        <span>{{ __('Copy Link') }}</span>
                                                    </a>
                                                    <a href="javascript:void(0)" class="dropdown-item confirm-alert"
                                                       onclick="CMX.uploader.fileDelete('{{ route('cmx-media.destroy', $file->id ) }}')">
                                                        <i class="las la-trash mr-2"></i>
                                                        <span>{{ __('Delete') }}</span>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="card card-file cmx-uploader-select c-default"
                                                 title="{{ $file_name }}.{{ $file->extension }}">
                                                <div class="card-file-thumb">
                                                    @if($file->type == 'image')
                                                        <img src="{{ my_asset($file->file_name) }}" class="img-fit">
                                                    @elseif($file->type == 'video')
                                                        <i class="las la-file-video"></i>
                                                    @else
                                                        <i class="las la-file"></i>
                                                    @endif
                                                </div>
                                                <div class="card-body">
                                                    <h6 class="d-flex">
                                                        <span class="text-truncate title">{{ $file_name }}</span>
                                                        <span class="ext">.{{ $file->extension }}</span>
                                                    </h6>
                                                    <p>{{ formatBytes($file->file_size) }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="cmx-pagination mt-3">
                                {{ $all_uploads->appends(request()->input())->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('modal')
    <div id="info-modal" class="modal fade">
        <div class="modal-dialog modal-dialog-right">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title h6">{{ __('File Info') }}</h5>
                    <button type="button" class="close" data-dismiss="modal">
                    </button>
                </div>
                <div class="modal-body c-scrollbar-light position-relative" id="info-modal-content">
                    <div class="c-preloader text-center absolute-center">
                        <i class="las la-spinner la-spin la-3x opacity-70"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('plugin-scripts')
    {!! Html::script('assets/js/loader.js') !!}
    {!! Html::script('assets/js/forms/forms-validation.js') !!}
    {!! Html::script('plugins/bootstrap-select/bootstrap-select.min.js') !!}
    {!! Html::script('plugins/flatpickr/flatpickr.js') !!}
@endpush
