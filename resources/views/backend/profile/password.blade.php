@extends('layouts.app')
@section('content')
<div class="row">
	<div class="col-md-6">
		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="panel-title" >
					{{ _lang('Change Password') }}
				</div>
			</div>
			<div class="panel-body">
				<form action="{{ route('password.update') }}" class="validate" method="post" autocomplete="off">
					@csrf
					<div class="col-md-12">
						<div class="form-group">
							<label class="control-label">{{ _lang('Old Password') }}</label>
							<input type="password" class="form-control" name="oldpassword" required>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group">
							<label class="control-label">{{ _lang('New Password') }}</label>
							<input type="password" class="form-control" name="password" required>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group">
							<label class="control-label">{{ _lang('Confirm Password') }}</label>
							<input type="password" id="password-confirm" class="form-control" name="password_confirmation" required>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group text-right">
							<button type="submit" class="btn btn-info">{{ _lang('Update Password') }}</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection

