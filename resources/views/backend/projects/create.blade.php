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
	<span class="panel-title" style="display: none;">{{ _lang('Add Project') }}</span>
	<form  method="post" autocomplete="off" action="{{ route('projects.store') }}" enctype="multipart/form-data">
		@csrf
		<div class="col-md-12">
			<div class="panel panel-default">
				<header class="panel-heading">
					<h2 class="panel-title">
						{{ _lang('Project Details') }}
					</h2>
				</header>
				<div class="panel-body">
					<div class="col-md-12">
						<div class="form-group">
							<label class="form-control-label">{{ _lang('Project Title') }}</label>
							<input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group">
							<label class="form-control-label">{{ _lang('Description') }}</label>
							<textarea class="form-control" name="description" rows="4"></textarea>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="form-control-label">{{ _lang('Budget Ammount') }}</label>
							<input type="text" name="ammount" class="form-control" value="{{ old('ammount') }}">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="form-control-label">{{ _lang('Choose Client') }}</label>
							<select class="form-control select2" name="client_id" required>
								<option value="">{{ _lang('Select One') }}</option>
								{{ create_client_option(old('client_id'), ['status' => 'Active']) }}
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="form-control-label">{{ _lang('Start Time') }}</label>
							<input type="text" name="start_time" class="form-control datepicker" value="{{ old('start_time') }}">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="form-control-label">{{ _lang('End Time') }}</label>
							<input type="text" name="end_time" class="form-control datepicker" value="{{ old('end_time') }}">
						</div>
					</div>

					<div class="col-md-12">
						<div class="form-group">
							<label class="form-control-label">{{ _lang('Choose Suitable Staff') }}</label>
							<select class="form-control select2" name="employee_id" required>
								<option value="">{{ _lang('Select One') }}</option>
								{{ create_employee_option(old('employee_id'), ['status' => 'Active']) }}
							</select>
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