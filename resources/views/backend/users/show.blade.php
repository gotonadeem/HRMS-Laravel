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
								<img src="{{ asset('public/uploads/images/'.$user->profile) }}" class="img-lg">
							</td>
						</tr>
						<tr>
							<td>{{ _lang('Name') }}</td>
							<td>{{ $user->first_name . ' ' . $user->last_name }}</td>
						</tr>
						<tr>
							<td>{{ _lang('Email') }}</td>
							<td>{{ $user->email }}</td>
						</tr>
						<tr>
							<td>{{ _lang('Status') }}</td>
							<td>
								@if ($user->status != 'Active')
								<span class="badge btn-danger">{{ _lang('In-Active') }}</span>
								@else
								<span class="badge btn-success">{{ _lang('Active') }}</span>
								@endif
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
@endsection