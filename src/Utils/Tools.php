<?php

namespace App\Utils;

class Tools
{
    /**
     * Permet de générer le username grace au prénom & au nom de la personne.
     *
     * @param $firstname
     * @param $lastname
     * @param int $cutLenth
     *
     * @return string
     */
    public static function generateUsername($firstname, $lastname, $cutLenth = 4)
    {
        if (\mb_strlen($firstname) < $cutLenth || \mb_strlen($lastname) < $cutLenth) {
            throw new \LogicException('Vous devez passé un firstname ou lastname supérieur ou égale à '.$cutLenth.' caractères.');
        }
        $search = explode(',', 'ç,æ,œ,á,é,í,ó,ú,à,è,ì,ò,ù,ä,ë,ï,ö,ü,ÿ,â,ê,î,ô,û,å,e,i,ø,u, ');
        $replace = explode(',', 'c,ae,oe,a,e,i,o,u,a,e,i,o,u,a,e,i,o,u,y,a,e,i,o,u,a,e,i,o,u');
        $firstname = str_replace($search, $replace, $firstname);
        $lastname = str_replace($search, $replace, $lastname);

        return mb_strtolower(mb_substr($firstname, 0, $cutLenth)).mb_strtolower(mb_substr($lastname, 0, $cutLenth));
    }
}
