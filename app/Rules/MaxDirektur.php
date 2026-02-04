<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\User;

class MaxDirektur implements Rule
{
    protected $max;
    protected $ignoreId;

    public function __construct($ignoreId = null)
    {
        $this->max = config('limits.max_direktur', 2);
        $this->ignoreId = $ignoreId;
    }

    public function passes($attribute, $value)
    {
        // Only validate when role requested is 'direktur'
        if ($value !== 'direktur') {
            return true;
        }

        $query = User::where('role', 'direktur')->where('status', 'aktif');
        if ($this->ignoreId) {
            $query->where('id', '!=', $this->ignoreId);
        }

        return $query->count() < $this->max;
    }

    public function message()
    {
        return "Kuota direktur telah mencapai maksimum (" . $this->max . ").";
    }
}
