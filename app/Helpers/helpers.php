<?php

if ( ! function_exists('_lang')){
	function _lang($string = ''){
		
		//Get Target language
		$target_lang = get_option('language');
		
		if($target_lang == ""){
			$target_lang = "language";
		}
		
		if(file_exists(resource_path() . "/_lang/$target_lang.php")){
			include(resource_path() . "/_lang/$target_lang.php"); 
		}else{
			include(resource_path() . "/_lang/language.php"); 
		}
		
		if (array_key_exists($string, $language)){
			return $language[$string];
		}else{
			return $string;
		}
	}
}


if ( ! function_exists('mail_template')){
	function mail_template($template_name, $id = '')
	{
		$text = get_option($template_name . '_template');

		$token = array();
		$token['company_name'] = get_option('company_name');
		$token['site_title'] = get_option('site_title');
		$token['site_url'] = url('/');
		$token['logo'] = '<img src="' . get_logo() . '">';

		if($template_name == 'user_registration'){
			$client = App\Client::where('id', $id)->first();
			$token['first_name'] = $client->first_name;
			$token['last_name'] = $client->last_name;
		}

		if($template_name == 'booking_received' || $template_name == 'booking_confirmation' || $template_name == 'booking_rejected'){
			$booking = App\Booking::where('id', $id)->first();

			$service = App\Service::where('id', $booking->service_id)->first();

			$client = App\Client::where('id', $booking->client_id)->first();

			if($booking->status == 0){
				$status = 'Pending';
			}elseif($booking->status == 1){
				$status = 'Confirmed';
			}elseif($booking->status == 2){
				$status = 'Canceled';
			}
			if($booking->status == 0){
				$payment_status = 'Due';
			}elseif($booking->status == 1){
				$payment_status = 'Paid';
			}

			$token['first_name'] = $client->first_name;
			$token['last_name'] = $client->last_name;
			$token['booking_id'] = $booking->id;
			$token['service_title'] = $service->title;
			$token['booking_date'] = $booking->date;
			$token['booking_quantity'] = $booking->quantity;
			$token['booking_status'] = $status;
			$token['bill'] = get_option('currency_symbol') . $booking->bill;
			$token['payment_status'] = $payment_status;
		}

		$pattern = '{%s}';
		foreach($token as $key=>$val){
			$varMap[sprintf($pattern,$key)] = $val;
		}
		$content = strtr($text,$varMap);
		return $content;
	}
}

if ( ! function_exists('notification')){
	function notification($message, $user_type = null, $user_id = null) 
	{
		$where = array();
		if($user_type != null){
			$where['user_type'] = $user_type;
		}
		if($user_id != null){
			$where['id'] = $user_id;
		}
		$where['status'] = 'Active';
		foreach (get_table('users', $where) as $data) {
			$notification = new \App\Notification();
			$notification->message = $message;
			$notification->user_id = $user_id;
			$notification->save();
		}
		return true;
	}
}

if ( ! function_exists('notifications')){
	function notifications($user_id) 
	{
		$notifications = \App\Notification::where('user_id', $user_id)
											->where('status', 0)
											->orderBy('id', 'DESC')
											->get();
		return !empty($notifications) ? $notifications : [];
	}
}


if (! function_exists('create_option')) {
	function create_option($table = '',$value = '',$show = '',$selected = '', $where = null) {
		if($where != null){
			$results = DB::table($table)->where($where)->orderBy('id','DESC')->get();
		}else{
			$results = DB::table($table)->orderBy('id','DESC')->get();
		}
		$option = '';
		foreach ($results as $data) {
			if($data->$value == $selected){
				$option .= '<option value="' . $data->$value . '" selected>' . $data->$show . '</option>';
			}else{
				$option .= '<option value="' . $data->$value . '">' . $data->$show . '</option>';
			}
		}
		echo $option;
	}
}

if (! function_exists('create_employee_option')) {
	function create_employee_option($selected = '', $where = null, $order = 'DESC') {
		if($where != null){
			$results = App\Employee::select('*')
									->join('users', 'users.id', '=', 'user_id')
									->where($where)
									->orderBy('employees.id', $order)
									->get();
		}else{
			$results = App\Employee::select('*')
									->join('users', 'users.id', '=', 'user_id')
									->orderBy('employees.id', $order)
									->get();
		}
		$option = '';
		foreach ($results as $data) {
			if($data->employee_id == $selected){
				$option.='<option value="' . $data->employee_id . '" selected>' . $data->first_name . ' ' . $data->last_name . ' (' . $data->employee_id . ')</option>';
			}else{
				$option.='<option value="' . $data->employee_id . '">' . $data->first_name . ' ' . $data->last_name . ' (' . $data->employee_id . ')</option>';
			}
		}
		echo $option;
	}
}
if (! function_exists('create_client_option')) {
	function create_client_option($selected = '', $where = null, $order = 'DESC') {
		if($where != null){
			$results = App\Client::select('*')
									->join('users', 'users.id', '=', 'clients.user_id')
									->where($where)
									->orderBy('clients.id', $order)
									->get();
		}else{
			$results = App\Client::select('*')
									->join('users', 'users.id', '=', 'clients.user_id')
									->orderBy('clients.id', $order)
									->get();
		}
		$option = '';
		foreach ($results as $data) {
			if($data->employee_id == $selected){
				$option.='<option value="' . $data->client_id . '" selected>' . $data->first_name . ' ' . $data->last_name . ' (' . $data->client_id . ')</option>';
			}else{
				$option.='<option value="' . $data->client_id . '">' . $data->first_name . ' ' . $data->last_name . ' (' . $data->client_id . ')</option>';
			}
		}
		echo $option;
	}
}

if (! function_exists('create_leave_option')) {
	function create_leave_option($selected = '', $where = null, $order = 'DESC') {
		if($where !=null){
			$results = App\LeaveType::where($where)->orderBy('id', $order)->get();
		}else{
			$results = App\LeaveType::orderBy('id', $order)->get();
		}
		$option = '';
		foreach ($results as $data) {
			if($data->id == $selected){
				$option.='<option value="' . $data->id . '" selected>' . $data->title . ' (' . $data->off_type . ')</option>';
			}else{
				$option.='<option value="' . $data->id . '">' . $data->title . ' (' . $data->off_type . ')</option>';
			}
		}
		echo $option;
	}
}

if (! function_exists('create_month_option')) {
	function create_month_option($selected = '') {
		$option = '';
		for ($i = 1; $i <= 12; ) {
			$month = date('F', mktime(0, 0, 0, $i, 1, date('Y')));
			if($month == $selected){
				$option.='<option value="' . $month . '" selected>' . $month . '</option>';
			}else{
				$option.= '<option value="' . $month . '">' . $month . '</option>';
			}
			$i++;
		}
		echo $option;
	}
}

if ( ! function_exists('time_elapsed_string')){
	function time_elapsed_string($datetime, $full = false) 
	{
		$now = new \DateTime;
		$ago = new \DateTime($datetime);
		$diff = $now->diff($ago);

		$diff->w = floor($diff->d / 7);
		$diff->d -= $diff->w * 7;

		$string = array(
			'y' => 'year',
			'm' => 'month',
			'w' => 'week',
			'd' => 'day',
			'h' => 'hour',
			'i' => 'minute',
			's' => 'second',
		);
		foreach ($string as $k => &$v) {
			if ($diff->$k) {
				$v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
			} else {
				unset($string[$k]);
			}
		}

		if (!$full) $string = array_slice($string, 0, 1);
		return $string ? implode(', ', $string) . ' ago' : 'just now';
	}
}

if ( ! function_exists('get_weekend_holiday')){
	function get_weekend_holiday($day = 0)
	{
		$startDate = new DateTime(date('Y') . '-01-1');
		$endDate = new DateTime(date('Y') . '-12-31');
		$sundays = array();
		while ($startDate <= $endDate) {
			if ($startDate->format('w') == $day) {
				$sundays[] = $startDate->format('Y-m-d');
			}
			$startDate->modify('+1 day');
		}
		return $sundays;
	}
}

if ( ! function_exists('get_table')){
	function get_table($table, $where = null , $order = 'DESC') 
	{
		if($where != null){
			$results = DB::table($table)->where($where)->orderBy('id', $order)->get();
		}else{
			$results = DB::table($table)->orderBy('id', $order)->get();
		}
		return $results;
	}
}

if ( ! function_exists('get_employee_id')){
	function get_employee_id() 
	{
		$user_id = Auth::user()->id;
		$employee_id = App\Employee::where('user_id', $user_id)->first()->employee_id;
		return $employee_id;
	}
}

if ( ! function_exists('get_logo')){
	function get_logo() 
	{
		$logo = get_option("logo");
		if($logo == ''){
			return asset("public/images/images/company-logo.png");
		}
		return asset("public/uploads/images/$logo"); 
	}
}

if ( ! function_exists('get_icon')){
	function get_icon($name) 
	{
		return asset("public/images/icons/".$name); 
	}
}

if ( ! function_exists('month_number_to_name')){
	function month_number_to_name($month_number) 
	{
		$month_name = date("F", mktime(0, 0, 0, $month_number, 10));
		return $month_name; 
	}
}

if ( ! function_exists('sql_escape')){
	function sql_escape($unsafe_str) 
	{
		if (get_magic_quotes_gpc())
		{
			$unsafe_str = stripslashes($unsafe_str);
		}
		return $escaped_str = str_replace("'", "", $unsafe_str);
	}
}

if ( ! function_exists('get_option')){
	function get_option($name, $optional = '') 
	{
		$setting = DB::table('settings')->where('name', $name)->get();
		if ( ! $setting->isEmpty() ) {
			return $setting[0]->value;
		}
		return $optional;

	}
}


if ( ! function_exists('timezone_list'))
{
	function timezone_list() {
		$zones_array = array();
		$timestamp = time();
		foreach(timezone_identifiers_list() as $key => $zone) {
			date_default_timezone_set($zone);
			$zones_array[$key]['ZONE'] = $zone;
			$zones_array[$key]['GMT'] = 'UTC/GMT ' . date('P', $timestamp);
		}
		return $zones_array;
	}

}

if ( ! function_exists('create_timezone_option'))
{

	function create_timezone_option($old="") {
		$option = "";
		$timestamp = time();
		foreach(timezone_identifiers_list() as $key => $zone) {
			date_default_timezone_set($zone);
			$selected = $old == $zone ? "selected" : "";
			$option .= '<option value="'. $zone .'"'.$selected.'>'. 'GMT ' . date('P', $timestamp) .' '.$zone.'</option>';
		}
		echo $option;
	}

}


if ( ! function_exists( 'get_country_list' ))
{
	function get_country_list($selected = '') {	
		if( $selected == "" ){
			echo file_get_contents( app_path().'/Helpers/country.txt' );
		}else{
			$pattern = '<option value="'.$selected.'">';
			$replace = '<option value="'.$selected.'" selected="selected">';
			$country_list = file_get_contents( app_path().'/Helpers/country.txt' );
			$country_list = str_replace($pattern, $replace, $country_list);
			echo $country_list;
		}
	}	
}

if ( ! function_exists('decimalPlace'))
{

	function decimalPlace($number){
		return number_format((float)$number, 2);
	}

}


if( !function_exists('load_language') ){
	function load_language($active=''){
		$path = resource_path() . "/_lang";
		$files = scandir($path);
		$options = "";
		
		foreach($files as $file){
			$name = pathinfo($file, PATHINFO_FILENAME);
			if($name == "." || $name == "" || $name == "language"){
				continue;
			}
			
			$selected = "";
			if($active == $name){
				$selected = "selected";
			}else{
				$selected = "";
			}
			
			$options .= "<option value='$name' $selected>".ucwords($name)."</option>";

		}
		echo $options;
	}
}

if( !function_exists('get_language_list') ){
	function get_language_list(){
		$path = resource_path() . "/_lang";
		$files = scandir($path);
		$array = array();

		$default = get_option('language');
		$array[] = $default;
		
		foreach($files as $file){
			$name = pathinfo($file, PATHINFO_FILENAME);
			if($name == "." || $name == "" || $name == "language" || $name == $default){
				continue;
			}

			$array[] = $name;

		}
		return $array;
	}
}
