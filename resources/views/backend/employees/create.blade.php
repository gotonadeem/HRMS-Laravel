@extends('layouts.app')

@section('css-stylesheet')
<style type="text/css">
	.dropify-wrapper{
		height: 200px;
	}
</style>
@stop

@section('content')
<div class="row">
	<span class="panel-title" style="display: none;">{{ _lang('Add Employee') }}</span>
	<form class="ajax-submit2" method="post" autocomplete="off" action="{{ route('clients.store') }}" enctype="multipart/form-data">
		@csrf
		<div class="col-md-12">
			<div class="panel panel-default">
				<header class="panel-heading">
					<h2 class="panel-title">
						{{ _lang('Personal Details') }}
					</h2>
				</header>
				<div class="panel-body">
					<div class="col-md-6">
						<div class="form-group">
							<label class="form-control-label">{{ _lang('First Name') }}</label>
							<input type="text" name="first_name" class="form-control" value="{{ old('first_name') }}" required>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="form-control-label">{{ _lang('Last Name') }}</label>
							<input type="text" name="last_name" class="form-control" value="{{ old('last_name') }}" required>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="form-control-label">{{ _lang('Phone') }}</label>
							<input type="text" name="phone" class="form-control" value="{{ old('phone') }}">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="form-control-label">{{ _lang('Skype ID') }}</label>
							<input type="text" name="skype_id" class="form-control" value="{{ old('skype_id') }}">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="form-control-label">{{ _lang('Street') }}</label>
							<input type="text" name="street" class="form-control" value="{{ old('street') }}" required>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="form-control-label">{{ _lang('State') }}</label>
							<input type="text" name="state" class="form-control" value="{{ old('state') }}" required>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="form-control-label">{{ _lang('Zip Code') }}</label>
							<input type="text" name="zip_code" class="form-control" value="{{ old('zip_code') }}" required>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="form-control-label">{{ _lang('Country') }}</label>
							<select class="form-control select2" name="country" required>
								<option value="">{{ _lang('Select One') }}</option>
								{{ get_country_list(old('country')) }}
							</select>
						</div>
					</div>
					
					<div class="col-md-6">
						<div class="form-group">
							<label class="form-control-label">{{ _lang('Department') }}</label>
							<select class="form-control select2" name="department_id" required>
								<option value="">{{ _lang('Select One') }}</option>
								{{ create_option('departments', 'id', 'department', old('department_id'), ['status' => 'Active']) }}
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="form-control-label">{{ _lang('Designation') }}</label>
							<select class="form-control select2" name="designation_id" required>
								<option value="">{{ _lang('Select One') }}</option>
							</select>
						</div>
					</div>

					<div class="col-md-12">
						<div class="form-group">
							<label class="control-label">{{ _lang('Profile') }}</label>
							<input type="file" class="form-control dropify" name="profile" data-allowed-file-extensions="png jpg jpeg PNG JPG JPEG">
						</div>
					</div>

					<div class="col-md-12">
						<h3 class="block">{{ _lang('Login Details') }}</h3>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="form-control-label">{{ _lang('Email') }}</label>
							<input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label">{{ _lang('Password') }}</label>
							<input type="password" class="form-control" name="password" required>
						</div>
					</div>

					<div class="col-md-12 text-right">
						<div class="form-group">
							<button type="submit" class="btn btn-primary">{{ _lang('Save') }}</button>
						</div>
					</div>
				</div>
			</div>
		</div>
		
	</form>
</div>
@endsection

@section('js-script')
<script type="text/javascript">
	$('select[name=department_id]').on('change', function(){
		var department_id = $(this).val();
		if(typeof department_id != 'undefined' && department_id != ''){
			$.ajax({
				url: '{{ url('departments/options') }}/' + department_id,
				type: 'GET',
				beforeSend: function(){
					$("#preloader").css("display","block"); 
				},
				success: function(data){
					$('#preloader').css('display', 'none');
					$('select[name=designation_id]').html(data);
				} 
			});
		}else{
			$('select[name=designation_id]').html('<option value="">{{ _lang('Select One') }}</option>');
		}
	});
</script>
@stop