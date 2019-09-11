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
						<td>{{ _lang('Department') }}</td>
						<td>{{ $department->department }}</td>
					</tr>
					<tr>
						<td>{{ _lang('Designation') }}</td>
						<td>{{ $department->designation }}</td>
					</tr>

				</table>
			</div>
		</div>
	</div>
</div>
@endsection


