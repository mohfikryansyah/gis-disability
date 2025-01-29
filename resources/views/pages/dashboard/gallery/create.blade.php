@extends('layouts.dashboard', [
    'breadcrumbs' => [
        'Dashboard' => route('dashboard.index'),
        'Gallery' => route('dashboard.gallery.index'),
        'Tambah Data' => '#',
    ],
])
@section('title', 'Tambah Foto')
@push('css')
	<link rel="stylesheet" href="{{ asset('css/extensions/filepond.css') }}">
	<link rel="stylesheet" href="{{ asset('css/extensions/filepond-plugin-image-preview.css') }}">
@endpush
@section('content')
	<section class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body py-4-5 px-4">
					<form action="{{ route('dashboard.gallery.store') }}" method="POST" enctype="multipart/form-data">
						@csrf
						<x-form.input type="file" name="foto" label="Foto" class="multiple-files-filepond" :required="true" />
						<x-form.input type="text" name="deskripsi" label="Deskripsi" :required="true" />
						<div class="pt-3">
							<button type="submit" class="btn btn-primary">Submit</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>
@endsection
@push('scripts')
	<script src="{{ asset('js/extensions/jquery.min.js') }}"></script>
	<script src="{{ asset('js/extensions/filepond-plugin-file-validate-size.min.js') }}"></script>
	<script src="{{ asset('js/extensions/filepond-plugin-file-validate-type.min.js') }}"></script>
	<script src="{{ asset('js/extensions/filepond-plugin-image-crop.min.js') }}"></script>
	<script src="{{ asset('js/extensions/filepond-plugin-image-exif-orientation.min.js') }}"></script>
	<script src="{{ asset('js/extensions/filepond-plugin-image-filter.min.js') }}"></script>
	<script src="{{ asset('js/extensions/filepond-plugin-image-preview.min.js') }}"></script>
	<script src="{{ asset('js/extensions/filepond-plugin-image-resize.min.js') }}"></script>
	<script src="{{ asset('js/extensions/filepond.js') }}"></script>
	<script>
		FilePond.registerPlugin(
			FilePondPluginImagePreview,
			FilePondPluginImageCrop,
			FilePondPluginImageExifOrientation,
			FilePondPluginImageFilter,
			FilePondPluginImageResize,
			FilePondPluginFileValidateSize,
			FilePondPluginFileValidateType,
		)

		FilePond.create(document.querySelector(".multiple-files-filepond"), {
			credits: null,
			allowImagePreview: false,
			allowMultiple: true,
			allowFileEncode: false,
			required: false,
			storeAsFile: true,
		})
	</script>
@endpush
