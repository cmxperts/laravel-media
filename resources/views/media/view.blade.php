<div class="row gutters-5">
    @foreach($files as $key => $file)
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
