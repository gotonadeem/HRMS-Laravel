@section('css-stylesheet')
<style type="text/css">
	.dropify-wrapper{
		height: 200px;
	}
</style>
@stop

<div class="row">
	<span class="panel-title" style="display: none;">{{ _lang('Edit Details') }}</span>
	<form class="ajax-submit2" method="post" autocomplete="off" action="{{ route('clients.update', $client->client_id) }}" enctype="multipart/form-data">
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
							<input type="text" name="first_name" class="form-control" value="{{ $client->first_name }}" required>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="form-control-label">{{ _lang('Last Name') }}</label>
							<input type="text" name="last_name" class="form-control" value="{{ $client->last_name }}" required>
						</div>
					</div>
					
					<div class="col-md-6">
						<div class="form-group">
							<label class="form-control-label">{{ _lang('Phone') }}</label>
							<input type="text" name="phone" class="form-control" value="{{ $client->phone }}">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="form-control-label">{{ _lang('Website URL') }}</label>
							<input type="text" name="website_url" class="form-control" value="{{ $client->website_url }}">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="form-control-label">{{ _lang('Skype ID') }}</label>
							<input type="text" name="skype_id" class="form-control" value="{{ $client->skype_id }}">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="form-control-label">{{ _lang('Facebook ID') }}</label>
							<input type="text" name="facebook_id" class="form-control" value="{{ $client->facebook_id }}">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="form-control-label">{{ _lang('Street') }}</label>
							<input type="text" name="street" class="form-control" value="{{ $client->street }}" required>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="form-control-label">{{ _lang('State') }}</label>
							<input type="text" name="state" class="form-control" value="{{ $client->state }}" required>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="form-control-label">{{ _lang('Zip Code') }}</label>
							<input type="text" name="zip_code" class="form-control" value="{{ $client->zip_code }}" required>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="form-control-label">{{ _lang('Country') }}</label>
							<select class="form-control select2" name="country" required>
								<option value="">{{ _lang('Select One') }}</option>
								{{ get_country_list($client->country) }}
							</select>
						</div>
					</div>

					{{-- <div class="col-md-12">
						<h3 class="block">{{ _lang('Login Details') }}</h3>
					</div> --}}
					<div class="col-md-6">
						<div class="form-group">
							<label class="form-control-label">{{ _lang('Email') }}</label>
							<input type="email" name="email" class="form-control" value="{{ $client->email }}" required>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label">{{ _lang('Password') }}</label>
							<input type="password" class="form-control" name="password" required>
						</div>
					</div>
					
					<div class="col-md-12">
						<div class="form-group">
							<label class="control-label">{{ _lang('Profile') }}</label>
							<input type="file" class="form-control dropify" name="profile" data-allowed-file-extensions="png jpg jpeg PNG JPG JPEG" data-default-file="{{ asset('public/uploads/images/'.$client->profile) }}">
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


@section('js-script')
<script type="text/javascript">
	$('select[name=status]').val('{{ $client->user->status }}');
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