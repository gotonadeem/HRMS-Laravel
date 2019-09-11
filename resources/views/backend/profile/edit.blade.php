@extends('layouts.app')
@section('content')
<div class="row">
	<div class="col-md-8">
		<div class="panel panel-default" data-collapsed="0">
			<div class="panel-heading">
				<div class="panel-title" >
					{{ _lang('Edit') }}
				</div>
			</div>
			<div class="panel-body">
				<form action="{{ route('profile.update') }}" class="validate" autocomplete="off" enctype="multipart/form-data" method="post">
					@csrf
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label">{{ _lang('First Name') }}</label>
							<input type="text" class="form-control" name="first_name" value="{{ $profile->first_name }}" required>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label">{{ _lang('Last Name') }}</label>
							<input type="text" class="form-control" name="last_name" value="{{ $profile->last_name }}" required>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group">
							<label class="control-label">{{ _lang('Email') }}</label>
							<input type="email" class="form-control" name="email" value="{{ $profile->email }}" required>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group">
							<label class="control-label">{{ _lang('Profile') }}</label>
							<input type="file" class="form-control dropify" name="profile" data-allowed-file-extensions="png jpg jpeg PNG JPG JPEG" data-default-file="{{ asset('public/uploads/images/'.$profile->profile) }}">
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group text-right">
							<button type="submit" class="btn btn-info">{{ _lang('Update') }}</button>
						</div>
					</div>
				</form>	
			</div>
		</div>
	</div>
</div>
@endsection