<?php

namespace App\Helpers;

class CreditCardHelper
{
    public static function validCreditCard ($number) : bool
    {
        // Set the string length and parity
        $number_length = strlen($number);
        $parity = $number_length % 2;

        // Loop through each digit and do the maths
        $total = 0;
        for ($i = 0; $i < $number_length; $i++) {
            $digit = $number[$i];

            // Multiply alternate digits by two
            if ($i % 2 == $parity) {
                $digit *= 2;

                // If the sum is two digits, add them together (in effect)
                if ($digit > 9) {
                    $digit -= 9;
                }
            }
            
            // Total up the digits
            $total += $digit;
        }

        // If the total mod 10 equals 0, the number is valid
        return boolval($total % 10 == 0);
    }

    public static function franchise ($number)
    {
        $francise = self::franchiseLib();
        $matches = array();
        $pattern = "#^(?:".implode("|", $francise['franchise_name_pattern']).")$#";
        $result = preg_match($pattern, str_replace(" ", "", $number), $matches);
        return $result ? $francise['names'][sizeof($matches)-2] : false;
    }

    private static function franchiseLib ()
    {
        $franchise_name_pattern = array(
            "visa" => "(4\d{12}(?:\d{3})?)",
            "amex" => "(3[47]\d{13})",
            "jcb" => "(35[2-8][89]\d\d\d{10})",
            "maestro" => "((?:5020|5038|6304|6579|6761)\d{12}(?:\d\d)?)",
            "solo" => "((?:6334|6767)\d{12}(?:\d\d)?\d?)",
            "mastercard" => "(5[1-5]\d{14})",
            "switch" => "(?:(?:(?:4903|4905|4911|4936|6333|6759)\d{12})|(?:(?:564182|633110)\d{10})(\d\d)?\d?)"
        );

        $franchise_validated_pattern = array(
            "visa" => "(/^([4]{1})([0-9]{12,15})$/)",
            "amex" => "(/^([34|37]{2})([0-9]{13})$/)",
            "jcb" => "(?:2131|1800|35\d{3})\d{11})",
            "maestro" => "xxxxxxxx",
            "solo" => "xxxxxxx",
            "mastercard" => "(/^([51|52|53|54|55]{2})([0-9]{14})$/)",
            "switch" => "xxxxxxx"
        );

        $names = array(
            "Visa", 
            "American Express", 
            "JCB", 
            "Maestro", 
            "Solo", 
            "Mastercard", 
            "Switch"
        );

        return array('franchise_name_pattern'=>$franchise_name_pattern, 'names'=>$names);
    }

    public static function validFranchise ($number) : bool
    {
        return boolval(self::franchise($number));
    }
}