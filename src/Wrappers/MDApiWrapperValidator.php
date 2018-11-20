<?php
/**
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 *
 * @author    202-ecommerce <tech@202-ecommerce.com>
 * @copyright Copyright (c) 202-ecommerce
 * @license   https://opensource.org/licenses/OSL-3.0 Open Software License (OSL 3.0)
 */

namespace MapaDirectSDK\Wrappers;

use MapaDirectSDK\Logger\MDApiLogger;

/**
 * @desc: abstract wrapper of a webservice
 */
class MDApiWrapperValidator
{

    /**
     * @param string $siret
     * @return $this
     */
    public static function isSiret($siret)
    {
        if (strlen($siret) != 14) {
            return false;
        }
        if (!is_numeric($siret)) {
            return false;
        }
        // no need to check more. testing SIRET are not really exist
        return true;
        /**
        // on prend chaque chiffre un par un
        // si son index (position dans la chaîne en commence à 0 au premier caractère) est pair
        // on double sa valeur et si cette dernière est supérieure à 9, on lui retranche 9
        // on ajoute cette valeur à la somme totale
        $sum = 0;
        for ($index = 0; $index < 14; $index ++) {
            $number = (int) $siret[$index];
            if (($index % 2) == 0) {
                if (($number *= 2) > 9) {
                    $number -= 9;
                }
            }
            $sum += $number;
        }

        // le numéro est valide si la somme des chiffres est multiple de 10
        if (($sum % 10) != 0) {
            return false;
        } else {
            return true;
        }
        */
    }

    /**
     * @param string $siret
     * @return $this
     */
    public static function isEan13($ean13)
    {
        if (strlen($ean13) != 13) {
            return false;
        }
        if (!is_numeric($ean13)) {
            return false;
        }

        // on prend chaque chiffre un par un
        // si son index (position dans la chaîne en commence à 0 au premier caractère) est impair
        // on triple sa valeur
        // on ajoute cette valeur à la somme totale
        $sum = 0;
        for ($index = 0; $index < 12; $index ++) {
            $number = (int) $ean13[$index];
            if (($index % 2) != 0) {
                $number *= 3;
            }
            $sum += $number;
        }

        $key = $ean13[12]; // clé de contrôle égale au dernier chiffre

        // la clé de contrôle doit être égale à : 10 - (reste de la division de la somme des 12 premiers chiffres)
        if (10 - ($sum % 10) != $key) {
            return false;
        } else {
            return true;
        }
    }

    public static function validateDate($date)
    {
        if (preg_match('/^(\d{4})-(\d{2})-(\d{2})T(\d{2}):(\d{2}):(\d{2})/', $date, $parts) == true) {
            return true;
        } else {
            return false;
        }
    }
}
