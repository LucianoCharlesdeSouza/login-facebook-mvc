<?php

namespace App\Helpers;


class Helper
{
    private static $String;
    private static $Limite;
    private static $Format;
    public static function limitWords($string, $limite, $terminarCom = null) {
        self::$String = strip_tags(trim($string));
        self::$Limite = (int) $limite;
        $ArrayPalavras = explode(' ', self::$String);
        $NumPalavras = count($ArrayPalavras);
        $NovasPalavras = implode(' ', array_slice($ArrayPalavras, 0, self::$Limite));
        $TerminarCom = (empty($terminarCom) ? '...' : ' ' . $terminarCom);
        $Resultado = (self::$Limite < $NumPalavras ? $NovasPalavras . $TerminarCom : self::$String);
        return $Resultado;
    }
    public static function limitChars($string, $limite, $terminarCom = null, $ocorrencia = "") {
        self::$String = strip_tags($string);
        self::$Limite = (int) $limite;
        if (strlen(self::$String) <= self::$Limite) {
            return self::$String;
        } elseif ($ocorrencia != "") {
            $caracteres = strrpos(mb_substr(self::$String, 0, self::$Limite), $ocorrencia);
            return mb_substr(self::$String, 0, $caracteres) . $terminarCom;
        } else {
            $caracteres = mb_substr(self::$String, 0, self::$Limite);
            return $caracteres . $terminarCom;
        }
    }
    public static function slug($string) {
        self::$String = (string) $string;
        self::$String = preg_replace('/[\t\n]/', ' ', self::$String);
        self::$String = preg_replace('/\s{2,}/', ' ', self::$String);
        $list = array(
            'Š' => 'S',
            'š' => 's',
            'Đ' => 'Dj',
            'đ' => 'dj',
            'Ž' => 'Z',
            'ž' => 'z',
            'Č' => 'C',
            'č' => 'c',
            'Ć' => 'C',
            'ć' => 'c',
            'À' => 'A',
            'Á' => 'A',
            'Â' => 'A',
            'Ã' => 'A',
            'Ä' => 'A',
            'Å' => 'A',
            'Æ' => 'A',
            'Ç' => 'C',
            'È' => 'E',
            'É' => 'E',
            'Ê' => 'E',
            'Ë' => 'E',
            'Ì' => 'I',
            'Í' => 'I',
            'Î' => 'I',
            'Ï' => 'I',
            'Ñ' => 'N',
            'Ò' => 'O',
            'Ó' => 'O',
            'Ô' => 'O',
            'Õ' => 'O',
            'Ö' => 'O',
            'Ø' => 'O',
            'Ù' => 'U',
            'Ú' => 'U',
            'Û' => 'U',
            'Ü' => 'U',
            'Ý' => 'Y',
            'Þ' => 'B',
            'ß' => 'Ss',
            'à' => 'a',
            'á' => 'a',
            'â' => 'a',
            'ã' => 'a',
            'ä' => 'a',
            'å' => 'a',
            'æ' => 'a',
            '@' => '-',
            'ç' => 'c',
            'è' => 'e',
            'é' => 'e',
            'ê' => 'e',
            'ë' => 'e',
            'ì' => 'i',
            'í' => 'i',
            'î' => 'i',
            'ï' => 'i',
            'ð' => 'o',
            'ñ' => 'n',
            'ò' => 'o',
            'ó' => 'o',
            'ô' => 'o',
            'õ' => 'o',
            'ö' => 'o',
            'ø' => 'o',
            'ù' => 'u',
            'ú' => 'u',
            'û' => 'u',
            'ý' => 'y',
            'ý' => 'y',
            'þ' => 'b',
            'ÿ' => 'y',
            'Ŕ' => 'R',
            'ŕ' => 'r',
            '#' => '-',
            '$' => '-',
            '%' => '-',
            '&' => '-',
            '*' => '-',
            '()' => '-',
            '(' => '-',
            ')' => '-',
            '_' => '-',
            '-' => '-',
            '+' => '-',
            '=' => '-',
            '*' => '-',
            '/' => '-',
            '\\' => '-',
            '"' => '-',
            '{}' => '-',
            '{' => '-',
            '}' => '-',
            '[]' => '-',
            '[' => '-',
            ']' => '-',
            '?' => '-',
            ';' => '-',
            '.' => '-',
            ',' => '-',
            '<>' => '-',
            '°' => '-',
            'º' => '-',
            'ª' => '-',
            ':' => '-',
            '!' => '-',
            '¨' => '-',
            ' ' => '-'
        );
        self::$String = strtr(self::$String, $list);
        self::$String = preg_replace('/-{2,}/', '-', self::$String);
        self::$String = mb_strtolower(self::$String);
        return self::$String;
    }
    public static function isMail($email) {
        self::$String = (string) $email;
        self::$Format = '/[a-z0-9_\.\-]+@[a-z0-9_\.\-]*[a-z0-9_\.\-]+\.[a-z]{2,4}$/';
        if (preg_match(self::$Format, self::$String)):
            return true;
        else:
            return false;
        endif;
    }

    public static function Redirect($page = null){
        if($page != null){
            header("Location: ".BASE.$page);
            exit();
        }
        header("Location: ".BASE);
        exit();
    }
}