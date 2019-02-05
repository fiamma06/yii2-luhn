<?php
/**
 * Created by PhpStorm.
 * User: kistenalex
 * Date: 2019-02-06
 * Time: 00:07
 */

namespace fiamma06\luhn;

use yii\bootstrap\Html;
use yii\validators\Validator;

class LuhnValidator extends Validator
{
    /**
     * Error message
     *
     * @var string
     */
    public $message = 'Invalid IMEI';

    /**
     * Default length of string
     *
     * @var int
     */
    public $length = 15;

    /**
     * @param \yii\base\Model $model
     * @param string $attribute
     * @return bool
     */
    public function validateAttribute($model, $attribute)
    {
        $check = false;
        $value = $model->$attribute;
        $contl = $this->length - 1;

        if (mb_strlen($value) == $this->length && is_string($value)) {
            for ($i = 0, $sum = 0; $i < $contl; $i++) {
                $tmp = $value[$i] * (($i%2) + 1 );
                $sum += ($tmp%10) + intval($tmp/10);
            }
            $check = (((10 - ($sum%10)) %10) == $value[$contl]);
        }

        if($check === false) {
            $model->addError($attribute, $this->message);
        }
    }

    public function clientValidateAttribute($model, $attribute, $view)
    {
        LuhnValidatorAsset::register($view);

        return <<<JS
if (!luhn(value)) {
    messages.push("$this->message");
}
JS;
    }
}