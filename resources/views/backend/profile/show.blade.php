@extends('layouts.app')
@section('content')
<div class="row">
	<div class="col-md-6">
		<div class="panel panel-default" data-collapsed="0">
			<div class="panel-heading">
				<div class="panel-title" >
					{{ _lang('Details') }}
				</div>
			</div>
			<div class="panel-body">
				<table class="table table-bordered">
					<tbody>
						<tr>
							<td colspan="2" class="text-center">
								<img src="{{ asset('public/uploads/images/'. $profile->profile) }}" class="img-lg">
							</td>
						</tr>
						<tr>
							<td>{{ _lang('Name') }}</td>
							<td>{{ $profile->first_name . ' ' . $profile->last_name }}</td>
						</tr>
						<tr>
							<td>{{ _lang('Email') }}</td>
							<td>{{ $profile->email }}</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
@endsection