<?php

namespace Nitsan\NsOpenStreetmap\Evaluation;

/**
 * Class for field value validation/evaluation to be used in 'eval' of TCA
 */
class EvaluationLatitude
{

   /**
     * Server-side validation/evaluation on saving the record
     *
     * @param string $value The field value to be evaluated
     * @param string $is_in The "is_in" value of the field configuration from TCA
     * @param bool $set Boolean defining if the value is written to the database or not.
     * @return string Evaluated field value
     */
    public function evaluateFieldValue($value, $is_in, &$set) : string
    {
      return (preg_match("/^(\+|-)?(?:90(?:(?:\.0{1,6})?)|(?:[0-9]|[1-8][0-9])(?:(?:\.[0-9]{1,15})?))$/", $value)) ? $value : '';
    }

} 
