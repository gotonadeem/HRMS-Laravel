<form method="post" class="ajax-submit" autocomplete="off" action="{{ route('notices.update', $notice->id) }}" enctype="multipart/form-data">
	@csrf
	@method('PUT')
	
	<div class="col-md-12">
		<div class="form-group">
			<label class="form-control-label">{{ _lang('Title') }}</label>
			<input type="text" name="title" class="form-control" value="{{ $notice->title }}" required>
		</div>
	</div>
	<div class="col-md-12">
		<div class="form-group">
			<label class="form-control-label">{{ _lang('Description') }}</label>
			<textarea class="form-control summernote" name="description" required>{{ $notice->description }}</textarea>
		</div>
	</div>
	<div class="col-md-12">
		<div class="form-group">
			<label class="control-label">{{ _lang('Status') }}</label>
			<select class="form-control select2" name="status" required>
				<option{{ $notice->status == 'Active' ? ' selected' : '' }} value="Active">{{ _lang('Active') }}</option>
				<option{{ $notice->status == 'In-Active' ? ' selected' : '' }}  value="In-Active">{{ _lang('In-Active') }}</option>
			</select>
		</div>
	</div>

	<div class="col-md-12 text-right">
		<div class="form-group">
			<button type="submit" class="btn btn-primary">{{ _lang('Update') }}</button>
		</div>
	</div>
</form>


