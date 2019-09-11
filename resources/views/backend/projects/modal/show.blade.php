<table class="table table-bordered">
	<div align="center">
		<img class="img-lg" src="{{ asset('public/uploads/images/' . $client->profile) }}">
	</div>
	<tr>
		<td>{{ _lang('Client Id') }}</td>
		<td>{{ $client->client_id }}</td>
	</tr>
	
	<tr>
		<td>{{ _lang('First Name') }}</td>
		<td>{{ $client->first_name }}</td>
	</tr>
	<tr>
		<td>{{ _lang('Last Name') }}</td>
		<td>{{ $client->last_name }}</td>
	</tr>
	
	<tr>
		<td>{{ _lang('Phone') }}</td>
		<td>{{ $client->phone }}</td>
	</tr>
	<tr>
		<td>{{ _lang('Skype Id') }}</td>
		<td>{{ $client->skype_id }}</td>
	</tr>
	<tr>
		<td>{{ _lang('Facebook Id') }}</td>
		<td>{{ $client->facebook_id }}</td>
	</tr>
	<tr>
		<td>{{ _lang('Website Url') }}</td>
		<td>{{ $client->website_url }}</td>
	</tr>
	<tr>
		<td>{{ _lang('Street') }}</td>
		<td>{{ $client->street }}</td>
	</tr>
	<tr>
		<td>{{ _lang('State') }}</td>
		<td>{{ $client->state }}</td>
	</tr>
	<tr>
		<td>{{ _lang('Zip Code') }}</td>
		<td>{{ $client->zip_code }}</td>
	</tr>
	<tr>
		<td>{{ _lang('Country') }}</td>
		<td>{{ $client->country }}</td>
	</tr>
	<tr>
		<td>{{ _lang('Email') }}</td>
		<td>{{ $client->email }}</td>
	</tr>
	<tr>
		<td>{{ _lang('Created at') }}</td>
		<td>{{ $client->created_at }}</td>
	</tr>
	
	<tr>
		<td>{{ _lang('Status') }}</td>
		<td>{{ $client->status }}</td>
	</tr>

</table>