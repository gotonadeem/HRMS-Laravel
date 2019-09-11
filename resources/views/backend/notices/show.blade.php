@extends('layouts.app')

@section('content')
<div class="row">
	<div class="col-md-6">
		<div class="panel">
			<header class="panel-heading">
				<h2 class="panel-title">
					{{ _lang('Details') }}
				</h2>
			</header>
			<div class="panel-body">
				<table class="table table-bordered">
					
					<tr>
						<td>{{ _lang('Title') }}</td>
						<td>{{ $notice->title }}</td>
					</tr>
					<tr>
						<td>{{ _lang('Description') }}</td>
						<td>{!! $notice->description !!}</td>
					</tr>
					<tr>
						<td>{{ _lang('Status') }}</td>
						<td>
							@if ($notice->status != 'Active')
							<span class="badge btn-danger">{{ _lang('In-Active') }}</span>
							@else
							<span class="badge btn-success">{{ _lang('Active') }}</span>
							@endif
						</td>
					</tr>
					<tr>
						<td>{{ _lang('Created At') }}</td>
						<td>{{ $notice->created_at }}</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
</div>
@endsection


