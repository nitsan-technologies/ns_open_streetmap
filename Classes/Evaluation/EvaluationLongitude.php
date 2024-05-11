<?php

namespace Nitsan\NsOpenStreetmap\Evaluation;

/**
 * Class for field value validation/evaluation to be used in 'eval' of TCA
 */
class EvaluationLongitude
{



    /**
     * JavaScript code for client side validation/evaluation
     *
     * @return string JavaScript code for client side validation/evaluation
     */
    public function returnFieldJS()
    {
        return 'return value + " [added by JavaScript on field blur]";';
    }

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
      return (preg_match("/^-?([1-8]?[1-9]|[1-9]0)\.{1}\d{1,6}$/", $value)) ? $value : '';
    }

} 
