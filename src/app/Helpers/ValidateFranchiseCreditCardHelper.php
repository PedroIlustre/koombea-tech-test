<?php

namespace App\Helpers;

use App\Helpers\GetFranchiseHelper;

class ValidateFranchiseCreditCardHelper
{
    public static function validFranchise ($number) : bool
    {
        return boolval(GetFranchiseHelper::franchise($number));
    }

}