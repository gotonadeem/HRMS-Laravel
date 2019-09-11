@extends('layouts.app')

@section('css-stylesheet')
<style type="text/css">
	.dropify-wrapper{
		height: 200px;
		width: 200px;
	}
</style>
@stop

@section('content')
<div class="row">
	<span class="panel-title" style="display: none;">{{ _lang('Edit Details') }}</span>
	<form class="ajax-submit2" method="post" autocomplete="off" action="{{ route('employees.update', $employee->employee_id) }}" enctype="multipart/form-data">
		@csrf
		@method('PUT')
		<div class="col-md-12">
			<div class="panel">
				<header class="panel-heading">
					<h2 class="panel-title">
						{{ _lang('Personal Details') }}
					</h2>
				</header>
				<div class="panel-body">
					<div class="col-md-6">
						<div class="form-group">
							<label class="form-control-label">{{ _lang('First Name') }}</label>
							<input type="text" name="first_name" class="form-control" value="{{ $employee->user->first_name }}" required>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="form-control-label">{{ _lang('Last Name') }}</label>
							<input type="text" name="last_name" class="form-control" value="{{ $employee->user->last_name }}" required>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="form-control-label">{{ _lang('Father Name') }}</label>
							<input type="text" name="father_name" class="form-control" value="{{ $employee->father_name }}">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="form-control-label">{{ _lang('Mother Name') }}</label>
							<input type="text" name="mother_name" class="form-control" value="{{ $employee->mother_name }}">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="form-control-label">{{ _lang('DoB') }}</label>
							<input type="text" name="dob" class="form-control datepicker" value="{{ $employee->dob }}">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="form-control-label">{{ _lang('Phone') }}</label>
							<input type="text" name="phone" class="form-control" value="{{ $employee->phone }}">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="form-control-label">{{ _lang('Street') }}</label>
							<input type="text" name="street" class="form-control" value="{{ $employee->street }}" required>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="form-control-label">{{ _lang('State') }}</label>
							<input type="text" name="state" class="form-control" value="{{ $employee->state }}" required>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="form-control-label">{{ _lang('Zip Code') }}</label>
							<input type="text" name="zip_code" class="form-control" value="{{ $employee->zip_code }}" required>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="form-control-label">{{ _lang('Country') }}</label>
							<select class="form-control select2" name="country" required>
								<option value="">{{ _lang('Select One') }}</option>
								{{ get_country_list($employee->country) }}
							</select>
						</div>
					</div>
					<div class="col-md-12">
						<h3 class="block">{{ _lang('Login Details') }}</h3>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="form-control-label">{{ _lang('Email') }}</label>
							<input type="email" name="email" class="form-control" value="{{ $employee->user->email }}" required>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label">{{ _lang('Password') }}</label>
							<input type="password" class="form-control" name="password">
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="panel">
				<header class="panel-heading">
					<h2 class="panel-title">
						{{ _lang('Company Details') }}
					</h2>
				</header>
				<div class="panel-body">
					<div class="col-md-6">
						<div class="form-group">
							<label class="form-control-label">{{ _lang('Employee Id') }}</label>
							<input type="text" name="employee_id" class="form-control" value="{{ $employee->employee_id }}" required>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label">{{ _lang('Status') }}</label>
							<select class="form-control select2" name="status" required>
								<option value="Active">{{ _lang('Active') }}</option>
								<option value="In-Active">{{ _lang('In-Active') }}</option>
							</select>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group">
							<label class="form-control-label">{{ _lang('Department') }}</label>
							<select class="form-control select2" name="department_id" required>
								<option value="">{{ _lang('Select One') }}</option>
								{{ create_option('departments', 'id', 'department', $employee->department_id, ['status' => 'Active']) }}
							</select>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group">
							<label class="form-control-label">{{ _lang('Designation') }}</label>
							<select class="form-control select2" name="designation_id" required>
								{{ create_option('designations', 'id', 'designation', $employee->designation_id, ['department_id' => $employee->department_id]) }}
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="form-control-label">{{ _lang('Joining Date') }}</label>
							<input type="text" name="joining_date" class="form-control datepicker" value="{{ $employee->joining_date }}" required>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="form-control-label">{{ _lang('Exit Date') }}</label>
							<input type="text" name="exit_date" class="form-control datepicker" value="{{ $employee->exit_date }}">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="form-control-label">{{ _lang('Joining Salary') }} ({{ get_option('currency_symbol') }})</label>
							<input type="number" name="joining_salary" class="form-control" value="{{ ($employee->joining_salary != '') ? $employee->joining_salary : 0 }}" required>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="form-control-label">{{ _lang('Current Salary') }} ({{ get_option('currency_symbol') }})</label>
							<input type="number" name="current_salary" class="form-control" value="{{ ($employee->current_salary != '') ? $employee->current_salary : 0 }}" required>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="panel">
				<header class="panel-heading">
					<h2 class="panel-title">
						{{ _lang('Bank Details') }}
					</h2>
				</header>
				<div class="panel-body">
					<div class="col-md-12">
						<div class="form-group">
							<label class="form-control-label">{{ _lang('Account Holder Name') }}</label>
							<input type="text" name="account_holder_name" class="form-control" value="{{ $employee->account_holder_name }}">
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group">
							<label class="form-control-label">{{ _lang('Account Number') }}</label>
							<input type="text" name="account_number" class="form-control" value="{{ $employee->account_number }}">
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group">
							<label class="form-control-label">{{ _lang('Bank Name') }}</label>
							<input type="text" name="bank_name" class="form-control" value="{{ $employee->bank_name }}">
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group">
							<label class="form-control-label">{{ _lang('Bank Identifier Code') }}</label>
							<input type="text" name="bank_identifier_code" class="form-control" value="{{ $employee->bank_identifier_code }}">
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group">
							<label class="form-control-label">{{ _lang('Branch Location') }}</label>
							<input type="text" name="branch_location" class="form-control" value="{{ $employee->branch_location }}">
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-12">
			<div class="panel">
				<header class="panel-heading">
					<h2 class="panel-title">
						{{ _lang('Documents') }}
					</h2>
				</header>
				<div class="panel-body">
					<div class="col-md-3">
						<div class="form-group">
							<label class="control-label">{{ _lang('Profile') }}</label>
							<input type="file" class="form-control dropify" name="profile" data-allowed-file-extensions="png jpg jpeg PNG JPG JPEG" data-default-file="{{ asset('public/uploads/images/'.$employee->user->profile) }}">
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label class="control-label">{{ _lang('Resume') }}</label>
							<input type="file" class="form-control dropify" name="resume" data-allowed-file-extensions="doc docx pdf" data-default-file="{{ $employee->resume != '' ? asset('public/uploads/files/' . $employee->resume) : '' }}">
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label class="control-label">{{ _lang('Joining Letter') }}</label>
							<input type="file" class="form-control dropify" name="joining_letter" data-allowed-file-extensions="doc docx pdf" data-default-file="{{ $employee->joining_letter != '' ? asset('public/uploads/files/' . $employee->joining_letter) : '' }}">
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label class="control-label">{{ _lang('ID Card') }}</label>
							<input type="file" class="form-control dropify" name="id_card" data-allowed-file-extensions="doc docx pdf" data-default-file="{{ $employee->id_card != '' ? asset('public/uploads/files/' . $employee->id_card) : '' }}">
						</div>
					</div>
					
					<div class="col-md-12 text-right">
						<div class="form-group">
							<button type="submit" class="btn btn-primary">{{ _lang('Update') }}</button>
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
	$('select[name=status]').val('{{ $employee->user->status }}');
	$('select[name=status]').on('change', function(){
		var status = $(this).val();
		$("#preloader").css("display","block");
		setTimeout(function() { 
			if(typeof status != 'undefined' && status != 'Active'){
				$('input[name=exit_date]').val('{{ date('Y-m-d') }}');
			}else{
				$('input[name=exit_date]').val('');
			}
			$("#preloader").css("display","none");
		}, 300);
	});
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