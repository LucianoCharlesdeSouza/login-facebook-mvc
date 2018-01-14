$(function() {
    var alerts = ["alert", "alert-info", "alert-success", "alert-danger", "alert-warning"];
    var icones = ["fa fa-ban", "fa fa-info", "fa fa-warning", "fa fa-check"];

    $(".form").submit(function() {
        var form = $(this);
        var controller = form.attr('data-controller');
        var dados = new FormData($(this)[0]);
        $.ajax({
            url: BASE + controller,
            data: dados,
            type: "POST",
            dataType: 'json',
            processData: false,
            contentType: false,
            beforeSend: function(data) {
                $(".boxerror").css({display: 'none'});
                $.each(alerts, function(key, value) {
                    $('.alerta').removeClass(value);
                });
                $.each(icones, function(key, value) {
                    $('.icones').removeClass(value);
                });
            },
            success: function(data) {
                if (data.retorno) {
                    $('.icones').addClass(data.retorno[1]);
                    $('.alerta').addClass(data.retorno[0]);

                    $(".boxerror").css({display: 'block'});
                    $('.titulo').html(data.retorno[2]);
                    $('.result').html(data.retorno[3]);
                }

                /*podemos fazer o tempo de fechamento ser dinamico
                basta para isso passarmos um gatilho*/
                if (data.fecharBoxAlerta) {
                    $('.alerta').fadeOut(6200);
                }

                /*Limpar campos do formulario após preencher e inserir*/
                if (data.limparCampos) {
                    form.each(function() {
                        this.reset();
                    });
                }

                /*Redirecionar*/
                if (data.redirect) {
                    window.setTimeout(function() {
                        window.location.href = BASE + data.redirect[0];
                    }, data.redirect[1]);
                }
            }
        });
        return false;
    });
    /*Fim do motor AJAX*/


});

