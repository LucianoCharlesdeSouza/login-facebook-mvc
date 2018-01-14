<?php

namespace App\Helpers;

/**
 * Description of Alert
 * Classe de alerta de Erros e Sucessos!
 * @author Luciano Charles de Souza
 */
class Alert
{

    public static function AjaxSuccess($descricao, $titulo = "")
    {
        if ($titulo != ""):
            return ["alert alert-success", "fa fa-check", $titulo, $descricao];
        else:
            return ["alert alert-success", "fa fa-check", " Sucesso!", $descricao];
        endif;
    }

    public static function AjaxInfo($descricao, $titulo = "")
    {
        if ($titulo != ""):
            return ["alert alert-info", "fa fa-info", $titulo, $descricao];
        else:
            return ["alert alert-info", "fa fa-info", " Informação!", $descricao];
        endif;
    }

    public static function AjaxWarning($descricao, $titulo = "")
    {
        if ($titulo != ""):
            return ["alert alert-warning", "fa fa-warning", $titulo, $descricao];
        else:
            return ["alert alert-warning", "fa fa-warning", " Atenção!", $descricao];
        endif;
    }

    public static function AjaxDanger($descricao, $titulo = "")
    {
        if ($titulo != ""):
            return ["alert alert-danger", "fa fa-ban", $titulo, $descricao];
        else:
            return ["alert alert-danger", "fa fa-ban", " Cuidado!", $descricao];
        endif;
    }

    public static function AjaxRedirect($praOnde, $tempo = null)
    {
        if ($tempo != null):
            return [$praOnde, $tempo];
        else:
            return [$praOnde, 3200];
        endif;
    }

}
