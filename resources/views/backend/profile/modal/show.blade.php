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
		<tr>
			<td>{{ _lang('Status') }}</td>
			<td>
				@if ($profile->status == 0)
				<span class="badge btn-danger">{{ _lang('In-Active') }}</span>
				@elseif ($profile->status == 1)
				<span class="badge btn-success">{{ _lang('Active') }}</span>
				@endif
			</td>
		</tr>
	</tbody>
</table>