<div class="modal fade" id="cmxUploaderModal" data-backdrop="static" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-adaptive" role="document">
		<div class="modal-content h-100">
			<div class="modal-header pb-0 bg-light">
				<div class="uppy-modal-nav">
					<ul class="nav nav-tabs border-0">
						<li class="nav-item">
							<a class="nav-link active font-weight-medium" data-toggle="tab" href="#cmx-select-file">{{ __('Select File') }}</a>
						</li>
						<li class="nav-item">
							<a class="nav-link font-weight-medium" data-toggle="tab" href="#cmx-upload-new">{{ __('Upload New') }}</a>
						</li>
					</ul>
				</div>
				<button type="button" class="close btn-close" data-bs-dismiss="modal" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true"></span>
				</button>
			</div>
			<div class="modal-body">
				<div class="tab-content h-100">
					<div class="tab-pane active h-100" id="cmx-select-file">
						<div class="cmx-uploader-filter pt-1 pb-3 border-bottom mb-4">
							<div class="row align-items-center gutters-5 gutters-md-10 position-relative">
								<div class="col-xl-2 col-md-3 col-5">
									<div class="">
										<!-- Input -->
										<select class="form-control form-control-xs cmx-selectpicker" name="cmx-uploader-sort">
											<option value="newest" selected>{{ __('Sort by newest') }}</option>
											<option value="oldest">{{ __('Sort by oldest') }}</option>
											<option value="smallest">{{ __('Sort by smallest') }}</option>
											<option value="largest">{{ __('Sort by largest') }}</option>
										</select>
										<!-- End Input -->
									</div>
								</div>
								<div class="col-md-3 col-5">
									<div class="custom-control custom-radio">
										<input type="checkbox" class="custom-control-input" name="cmx-show-selected" id="cmx-show-selected" name="stylishRadio">
										<label class="custom-control-label" for="cmx-show-selected">
											{{ __('Selected Only') }}
										</label>
									</div>
								</div>
								<div class="col-md-4 col-xl-3 ml-auto mr-0 ms-auto me-0 col-2 position-static">
									<div class="cmx-uploader-search text-right">
										<input type="text" class="form-control form-control-xs" name="cmx-uploader-search" placeholder="{{ __('Search your files') }}">
										<i class="search-icon d-md-none"><span></span></i>
									</div>
								</div>
							</div>
						</div>
						<div class="cmx-uploader-all clearfix c-scrollbar-light">
							<div class="align-items-center d-flex h-100 justify-content-center w-100">
								<div class="text-center">
									<h3>{{ __('No files found') }}</h3>
								</div>
							</div>
						</div>
					</div>

					<div class="tab-pane h-100" id="cmx-upload-new">
						<div id="cmx-upload-files" class="h-100">
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer justify-content-between bg-light text-black-50">
				<div class="flex-grow-1 overflow-hidden d-flex">
					<div class="">
						<div class="cmx-uploader-selected">{{ __('0 File selected') }}</div>
						<button type="button" class="btn-link btn btn-sm p-0 cmx-uploader-selected-clear">{{ __('Clear') }}</button>
					</div>
					<div class="mb-0 ml-3 ms-3">
						<button type="button" class="btn btn-sm btn-primary" id="uploader_prev_btn">{{ __('Prev') }}</button>
						<button type="button" class="btn btn-sm btn-primary" id="uploader_next_btn">{{ __('Next') }}</button>
					</div>
				</div>
				<button type="button" class="btn btn-sm btn-primary" data-toggle="cmxUploaderAddSelected">{{ __('Add Files') }}</button>
			</div>
		</div>
	</div>
</div>
