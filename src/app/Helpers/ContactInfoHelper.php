<?php

namespace App\Helpers;

use App\Helpers\CreditCardHelper;
use Illuminate\Support\Facades\Validator;

class ContactInfoHelper
{
    public static function validateFields(array $fields) : array
    {
        $general_fields = Validator::make($fields, [
            'name' => 'required|max:255|regex:/^[a-zA-ZÑñ\s]+$/',
            'birth_date' => 'required|date_format:Y/m/d',
            'email' => 'required|email|unique:users'
        ]);
        $valid_franchise = CreditCardHelper::validFranchise($fields['credit_card']);

        $valid_credit_card = CreditCardHelper::validCreditCard($fields['credit_card']);

        return self::validationMsg($general_fields, $valid_franchise, $valid_credit_card);
    }

    private static function validationMsg($general_fields, $valid_franchise, $valid_credit_card)
    {
        $status = 'success';
        $msg = '';
        if (
            $general_fields->fails() || 
            !$valid_franchise        ||
            !$valid_credit_card
            ) {

            $msg = 'An error saving the following field(s): ';
            $status = 'error';

            if ($general_fields->fails()){
                foreach ($general_fields->errors()->messages() as $field => $value){
                    $msg .= $field. ': '.implode(', ', $value);
                }
            }
            
            if (!$valid_franchise)
            $msg .= ' Credit card error: Invalid Franchise.';
            
            if (!$valid_credit_card)
            $msg .= ' Credit card error: Invalidt Credit Card.';
        }

        return array('status' => $status, 'msg' => $msg);

    }
}