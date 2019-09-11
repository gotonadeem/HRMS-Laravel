<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    //
	public function user()
	{
		return $this->belongsTo('App\User');
	}
	public function department()
    {
    	return $this->belongsTo('App\Department');
    }

    public function designation()
    {
    	return $this->belongsTo('App\Designation');
    }
}
