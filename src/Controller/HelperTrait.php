<?php
/**
 * Created by PhpStorm.
 * User: Etudiant
 * Date: 13/02/2019
 * Time: 08:31
 */

namespace App\Controller;


use Behat\Transliterator\Transliterator;

trait HelperTrait
{
    public function slugify($text)
    {
        return Transliterator::transliterate($text);
    }

}