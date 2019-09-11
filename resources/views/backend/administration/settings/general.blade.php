@extends('layouts.app')

@section('content')
<div class="row">
	<div class="col-md-12">
		<ul class="nav nav-tabs setting-tab">
			<li class="nav-item">
				<a class="nav-link active" data-toggle="tab" href="#general">{{ _lang('General') }}</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" data-toggle="tab" href="#logo">{{ _lang('Logo') }}</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" data-toggle="tab" href="#email">{{ _lang('Email') }}</a>
			</li>
		</ul>
		<div class="tab-content">
			<div id="general" class="tab-pane active">
				<div class="panel panel-default">
					<div class="panel-heading">
						<div class="panel-title" >
							{{ _lang('General Settings') }}
						</div>
					</div>
					<div class="panel-body">
						<form method="post" class="ajax-submit params-panel" autocomplete="off" action="{{ url('administration/settings/general') }}">
							@csrf
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">{{ _lang('Company Name') }}</label>		
									<input type="text" class="form-control" name="company_name" value="{{ get_option('company_name') }}" required>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">{{ _lang('Site Title') }}</label>						
									<input type="text" class="form-control" name="site_title" value="{{ get_option('site_title') }}" required>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">{{ _lang('Phone') }}</label>				
									<input type="text" class="form-control" name="phone" value="{{ get_option('phone') }}" required>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">{{ _lang('Email') }}</label>	
									<input type="email" class="form-control" name="email" value="{{ get_option('email') }}" required>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">{{ _lang('Address') }}</label>	
									<input type="text" class="form-control" name="address" value="{{ get_option('address') }}" required>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">{{ _lang('Currency Symbol') }}</label>				
									<input type="text" class="form-control" name="currency_symbol" value="{{ get_option('currency_symbol') }}" required>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">{{ _lang('Timezone') }}</label>			
									<select class="form-control select2" name="timezone" required>
										<option value="">{{ _lang('Select One') }}</option>
										{{ create_timezone_option(get_option('timezone')) }}
									</select>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">{{ _lang('Language') }}</label>			
									<select class="form-control select2" name="language" required>
										{!! load_language( get_option('language') ) !!}
									</select>
								</div>
							</div>
							<div class="form-group text-right">
								<div class="col-md-12">
									<button type="submit" class="btn btn-primary">{{ _lang('Update') }}</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
			<div id="logo" class="tab-pane fade">
				<div class="panel panel-default">
					<div class="panel-heading">
						<div class="panel-title" >
							{{ _lang('Logo') }}
						</div>
					</div>
					<div class="panel-body">
						<form method="post" class="ajax-submit" action="{{ url('administration/settings/general') }}" enctype="multipart/form-data">
							@csrf
							<div class="col-md-12">
								<div class="form-group">
									<input type="file" class="form-control dropify" name="logo" data-allowed-file-extensions="png jpg jpeg PNG JPG JPEG" data-default-file="{{ get_logo() }}">
								</div>
							</div>
							<div class="form-group text-right">
								<div class="col-md-12">
									<button type="submit" class="btn btn-primary">{{ _lang('Update') }}</button>
								</div>
							</div>
						</form>	
					</div>
				</div>
			</div>
			<div id="email" class="tab-pane fade">
				<div class="panel panel-default">
					<div class="panel-heading">
						<div class="panel-title" >
							{{ _lang('Email') }}
						</div>
					</div>
					<div class="panel-body">
						<form method="post" class="ajax-submit" action="{{ url('administration/settings/general') }}" enctype="multipart/form-data">
							@csrf
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">{{ _lang('Mail Type') }}</label>
									<select class="form-control select2" name="mail_type" id="mail_type" required>
										<option value="mail" {{ get_option('mail_type')=="mail" ? "selected" : "" }}>{{ _lang('PHP Mail') }}</option>
										<option value="smtp" {{ get_option('mail_type')=="smtp" ? "selected" : "" }}>{{ _lang('SMTP') }}</option>
									</select>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">{{ _lang('From Email') }}</label>
									<input type="text" class="form-control" name="from_email" value="{{ get_option('from_email') }}" required>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">{{ _lang('From Name') }}</label>
									<input type="text" class="form-control" name="from_name" value="{{ get_option('from_name') }}" required>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">{{ _lang('SMTP Host') }}</label>
									<input type="text" class="form-control smtp" name="smtp_host" value="{{ get_option('smtp_host') }}">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">{{ _lang('SMTP Port') }}</label>
									<input type="text" class="form-control smtp" name="smtp_port" value="{{ get_option('smtp_port') }}">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">{{ _lang('SMTP Username') }}</label>
									<input type="text" class="form-control smtp" autocomplete="off" name="smtp_username" value="{{ get_option('smtp_username') }}">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">{{ _lang('SMTP Password') }}</label>
									<input type="password" class="form-control smtp" autocomplete="off" name="smtp_password" value="{{ get_option('smtp_password') }}">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">{{ _lang('SMTP Encryption') }}</label><select class="form-control smtp" name="smtp_encryption">
										<option value="ssl" {{ get_option('smtp_encryption')=="ssl" ? "selected" : "" }}>{{ _lang('SSL') }}</option>
										<option value="tls" {{ get_option('smtp_encryption')=="tls" ? "selected" : "" }}>{{ _lang('TLS') }}</option>
									</select>
								</div>
							</div>
							<div class="form-group text-right">
								<div class="col-md-12">
									<button type="submit" class="btn btn-primary">{{ _lang('Update') }}</button>
								</div>
							</div>
						</form>	
					</div>
				</div>
			</div>
		</div>  
	</div>
</div>
@endsection
@section('js-script')
<script type="text/javascript">
	if($("#mail_type").val() != "smtp"){
		$(".smtp").prop("disabled",true);
		$(".smtp").prop("required",false);
	}
	$(document).on("change","#mail_type",function(){
		if( $(this).val() != "smtp" ){
			$(".smtp").prop("disabled",true);
			$(".smtp").prop("required",false);
		}else{
			$(".smtp").prop("disabled",false);
			$(".smtp").prop("required",true);
		}
	});
</script>
@stop
