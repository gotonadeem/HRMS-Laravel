@extends('layouts.app')

@section('content')

<div class="row">
	<div class="col-md-12">
		<div class="panel">
			<header class="panel-heading">
				<h4 class="panel-title">{{ _lang('Notices List') }}</h4>
				<a class="btn btn-primary btn-xs pull-right ajax-modal" data-title="{{ _lang('Add New') }}" href="{{ route('notices.create') }}">
					{{ _lang('Add New') }}
				</a>
			</header>
			<div class="panel-body">
				<table class="table table-striped data-table">
					<thead>
						<tr>
							<th>#</th>
							
        					<th>{{ _lang('Title') }}</th>
        					<th>{{ _lang('Status') }}</th>
        					<th>{{ _lang('Created At') }}</th>

							<th class="text-center">{{ _lang('Action') }}</th>
						</tr>
					</thead>
					<tbody>
						@foreach($notices as $data)
						<tr id="row_{{ $data->id }}">
							<td class="id">{{ $data->id }}</td>
							
        					<td class="title">{{ $data->title }}</td>
        					<td class="status">
								{{ ($data->status == 'Active') ? _lang('Active') : _lang('In-Active') }}
							</td>
							<td class="created_at">{{ $data->created_at }}</td>

							<td class="text-center action">
								<form action="{{ route('notices.destroy', $data->id) }}" method="post" class="ajax-delete">
									<a href="{{ route('notices.show', $data->id) }}" class="btn btn-info btn-xs ajax-modal" data-title="{{ _lang('Details') }}">
										<i class="fa fa-eye"></i>
									</a>
									<a href="{{ route('notices.edit', $data->id) }}" class="btn btn-warning btn-xs ajax-modal" data-title="{{ _lang('Edit') }}">
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
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

@endsection


