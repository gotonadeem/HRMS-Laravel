<form method="post" class="ajax-submit" autocomplete="off" action="{{ route('notices.store') }}" enctype="multipart/form-data">
	@csrf
	
	<div class="col-md-12">
		<div class="form-group">
			<label class="form-control-label">{{ _lang('Title') }}</label>
			<input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
		</div>
	</div>
	<div class="col-md-12">
		<div class="form-group">
			<label class="form-control-label">{{ _lang('Description') }}</label>
			<textarea class="form-control summernote" name="description" required>{{ old('description') }}</textarea>
		</div>
	</div>

	<div class="col-md-12 text-right">
		<div class="form-group">
			<button type="submit" class="btn btn-primary">{{ _lang('Save') }}</button>
		</div>
	</div>
</form>



