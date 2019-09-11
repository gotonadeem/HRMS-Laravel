<form action="{{ route('administration.languages.store') }}" class="ajax-submit" autocomplete="off" method="post">
	@csrf
	<div class="col-md-12">
		<div class="form-group">
			<label class="control-label">{{ _lang('Language Name') }}</label>
			<input type="text" class="form-control" name="language_name" value="{{ old('language_name') }}" required>
		</div>
	</div>
	<div class="col-md-12">
		<div class="form-group text-right">
			<button type="submit" class="btn btn-info">{{ _lang('Create') }}</button>
		</div>
	</div>
</form>	