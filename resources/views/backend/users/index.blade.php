@extends('layouts.app')
@section('content')
<div class="row">
	<div class="col-lg-12">
		<section class="panel">
			<header class="panel-heading">
				<h2 class="panel-title">{{ _lang('Users List') }}</h2>
				<a href="{{ route('users.create') }}" class="btn btn-info btn-xs pull-right ajax-modal" data-title="{{ _lang('Add New') }}">{{ _lang('Add New') }}</a>
			</header>
			<div class="panel-body">
				<table class="table table-bordered data-table">
					<thead>
						<th>{{ _lang('Profile') }}</th>
						<th>{{ _lang('Name') }}</th>
						<th>{{ _lang('Email') }}</th>
						<th>{{ _lang('Status') }}</th>
						<th class="text-center">{{ _lang('Action') }}</th>
					</thead>
					<tbody>
						@foreach($users AS $data)
						<tr>
							<td><img class="img-md" src="{{ asset('public/uploads/images/' . $data->profile) }}"></td>
							<td>{{ $data->first_name . ' ' . $data->last_name }}</td>
							<td>{{ $data->email }}</td>
							<td>
								@if ($data->status != 'Active')
									<span class="badge btn-danger">{{ _lang('In-Active') }}</span>
								@else
									<span class="badge btn-success">{{ _lang('Active') }}</span>
								@endif
							</td>
							<td class="text-center">	
								<form action="{{ route('users.destroy', $data->id) }}" method="post" class="ajax-delete">
									<a href="{{ route('users.show', $data->id) }}" class="btn btn-info btn-xs ajax-modal" data-title="{{ _lang('Details') }}"><i class="fa fa-eye" aria-hidden="true"></i></a>
									<a href="{{ route('users.edit', $data->id) }}" class="btn btn-warning btn-xs ajax-modal" data-title="{{ _lang('Edit') }}"><i class="fa fa-pencil" aria-hidden="true"></i></a>
									@method('DELETE')
									@csrf
									<button type="submit" class="btn btn-danger btn-xs btn-remove"><i class="fa fa-eraser" aria-hidden="true"></i></button>
								</form>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</section>
	</div>
</div>
@endsection