<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\LeaveApplication;

class AppliedLeave implements Rule
{
    protected $employee_id;
    protected $date;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($employee_id, $date)
    {
        $this->employee_id = $employee_id;
        $this->date = $date;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $leave_application = LeaveApplication::where('employee_id', $this->employee_id)
                                                ->whereIn('date', $this->date)
                                                ->first();
        if($leave_application){
            return false;
        }
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return _lang('You have already applied for the particular date.');
    }
}
