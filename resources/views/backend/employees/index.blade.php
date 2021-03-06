@extends('layouts.app')

@section('content')

<div class="row">
	<div class="col-md-12">
		<div class="panel">
			<header class="panel-heading">
				<h4 class="panel-title">{{ _lang('Employees List') }}</h4>
				<a class="btn btn-primary btn-xs pull-right" href="{{ route('employees.create') }}">
					{{ _lang('Add New') }}
				</a>
			</header>
			<div class="panel-body">
				<table class="table table-striped data-table">
					<thead>
						<tr>
							
							<th>{{ _lang('Profile') }}</th>
							<th>{{ _lang('Employee Id') }}</th>
        					<th>{{ _lang('Name') }}</th>
        					<th>{{ _lang('Department') }}</th>
        					<th>{{ _lang('Designation') }}</th>
        					<th>{{ _lang('Joining Date') }}</th>
        					<th>{{ _lang('Status') }}</th>

							<th class="text-center">{{ _lang('Action') }}</th>
						</tr>
					</thead>
					<tbody>
						@php $i = 1; @endphp
						@foreach($employees as $data)
						<tr>

							<td>
								<img class="img-md" src="{{ asset('public/uploads/images/' . $data->user->profile) }}">
							</td>
							<td>{{ $data->employee_id }}</td>
        					<td>{{ $data->user->first_name . ' ' . $data->user->last_name }}</td>
        					<td>{{ $data->department->department }}</td>
        					<td>{{ $data->designation->designation }}</td>
        					<td>{{ $data->joining_date }}</td>
        					<td>
        						@if ($data->user->status != 'Active')
									<span class="badge btn-danger">{{ _lang('In-Active') }}</span>
								@else
									<span class="badge btn-success">{{ _lang('Active') }}</span>
								@endif
        					</td>

							<td class="text-center">
								<form action="{{ route('employees.destroy', $data->employee_id) }}" method="post" class="ajax-delete">
									<a href="{{ route('employees.show', $data->employee_id) }}" class="btn btn-info btn-xs" data-title="{{ _lang('Details') }}">
										<i class="fa fa-eye"></i>
									</a>
									<a href="{{ route('employees.edit', $data->employee_id) }}" class="btn btn-warning btn-xs" data-title="{{ _lang('Edit') }}">
										<i class="fa fa-pencil"></i>
									</a>
									@csrf
									@method('DELETE')
									<button class="btn btn-danger btn-xs btn-remove" type="submit">
										<i class="fa fa-eraser"></i>
									</button>
								</form>
							</td>
						</tr>
						@php $i++ @endphp
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

@endsection


