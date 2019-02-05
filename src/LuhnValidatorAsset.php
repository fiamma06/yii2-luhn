<?php
/**
 * Created by PhpStorm.
 * User: kistenalex
 * Date: 2019-02-06
 * Time: 01:19
 */

namespace fiamma06\luhn;

use yii\validators\ValidationAsset;

class LuhnValidatorAsset extends ValidationAsset
{
    /**
     * @var string
     */
    public $sourcePath = '@bower/luhn-alg';

    /**
     * @var array
     */
    public $js = [
        'index.js'
    ];
}