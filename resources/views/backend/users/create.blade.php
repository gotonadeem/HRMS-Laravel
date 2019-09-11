@extends('layouts.app')
@section('content')
<div class="row">
	<div class="col-md-8">
		<div class="panel panel-default" data-collapsed="0">
			<div class="panel-heading">
				<div class="panel-title" >
					{{ _lang('Add New') }}
				</div>
			</div>
			<div class="panel-body">
				<form action="{{ route('users.store') }}" class="validate" autocomplete="off" enctype="multipart/form-data" method="post">
					@csrf
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label">{{ _lang('First Name') }}</label>
							<input type="text" class="form-control" name="first_name" value="{{ old('first_name') }}" required>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label">{{ _lang('Last Name') }}</label>
							<input type="text" class="form-control" name="last_name" value="{{ old('last_name') }}" required>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group">
							<label class="control-label">{{ _lang('Email') }}</label>
							<input type="email" class="form-control" name="email" value="{{ old('email') }}" required>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group">
							<label class="control-label">{{ _lang('Password') }}</label>
							<input type="password" class="form-control" name="password" required>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group">
							<label class="control-label">{{ _lang('Confirm Password') }}</label>
							<input type="password" class="form-control" name="password_confirmation" required>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group">
							<label class="control-label">{{ _lang('Profile') }}</label>
							<input type="file" class="form-control dropify" name="profile" data-allowed-file-extensions="png jpg jpeg PNG JPG JPEG">
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group text-right">
							<button type="submit" class="btn btn-info">{{ _lang('Save') }}</button>
						</div>
					</div>
				</form>	
			</div>
		</div>
	</div>
</div>
@endsection