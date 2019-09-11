@extends('layouts.app')

@section('content')
<div class="row">
	<div class="col-md-6">
		<div class="panel">
			<div class="panel-body">
				<header class="panel-heading">
					<h2 class="panel-title">
						{{ _lang('Details') }}
					</h2>
				</header>
				<table class="table table-bordered">
					
					<tr>
						<td>{{ _lang('First Name') }}</td>
						<td>{{ $employee->first_name }}</td>
					</tr>
					<tr>
						<td>{{ _lang('Last Name') }}</td>
						<td>{{ $employee->last_name }}</td>
					</tr>
					<tr>
						<td>{{ _lang('Father Name') }}</td>
						<td>{{ $employee->father_name }}</td>
					</tr>
					<tr>
						<td>{{ _lang('Mother Name') }}</td>
						<td>{{ $employee->mother_name }}</td>
					</tr>
					<tr>
						<td>{{ _lang('Dob') }}</td>
						<td>{{ $employee->dob }}</td>
					</tr>
					<tr>
						<td>{{ _lang('Phone') }}</td>
						<td>{{ $employee->phone }}</td>
					</tr>
					<tr>
						<td>{{ _lang('Street') }}</td>
						<td>{{ $employee->street }}</td>
					</tr>
					<tr>
						<td>{{ _lang('State') }}</td>
						<td>{{ $employee->state }}</td>
					</tr>
					<tr>
						<td>{{ _lang('Zip Code') }}</td>
						<td>{{ $employee->zip_code }}</td>
					</tr>
					<tr>
						<td>{{ _lang('Country') }}</td>
						<td>{{ $employee->country }}</td>
					</tr>
					<tr>
						<td>{{ _lang('Email') }}</td>
						<td>{{ $employee->email }}</td>
					</tr>
					<tr>
						<td>{{ _lang('Employee Id') }}</td>
						<td>{{ $employee->employee_id }}</td>
					</tr>
					<tr>
						<td>{{ _lang('Department') }}</td>
						<td>{{ $employee->department }}</td>
					</tr>
					<tr>
						<td>{{ _lang('Designation') }}</td>
						<td>{{ $employee->designation }}</td>
					</tr>
					<tr>
						<td>{{ _lang('Joining Date') }}</td>
						<td>{{ $employee->joining_date }}</td>
					</tr>
					<tr>
						<td>{{ _lang('Exit Date') }}</td>
						<td>{{ $employee->exit_date }}</td>
					</tr>
					<tr>
						<td>{{ _lang('Status') }}</td>
						<td>{{ $employee->status }}</td>
					</tr>

				</table>
			</div>
		</div>
	</div>
</div>
@endsection


