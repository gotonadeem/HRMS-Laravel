@extends('layouts.app')

@section('content')

<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading"><span class="panel-title">{{ _lang('Languages') }}</span>
				<a class="btn btn-primary btn-sm pull-right ajax-modal" href="{{ route('administration.languages.create') }}" data-title="{{ _lang('Add New') }}">{{ _lang('Add New') }}</a>
			</div>
			<div class="panel-body">
				<table class="table table-bordered data-table">
					<thead>
						<tr>
							<th>{{ _lang('Language Name') }}</th>
							<th class="text-center">{{ _lang('Edit Translation') }}</th>
							<th class="text-center">{{ _lang('Remove') }}</th>
						</tr>
					</thead>
					<tbody>
						@foreach(get_language_list() as $language)
						<tr>
							<td>{{ ucwords($language) }}</td>
							<td class="text-center">
								<a href="{{ route('administration.languages.edit', $language) }}" class="btn btn-info btn-sm">{{ _lang('Edit Translation') }}</a>
							</td>	
							<td class="text-center">
								<form action="{{ route('administration.languages.destroy', $language) }}" method="post" class="ajax-delete">
									@csrf
									@method('DELETE')
									<button class="btn btn-danger btn-sm btn-remove" type="submit">{{ _lang('Delete') }}</button>
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


