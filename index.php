<?php
$title = "Declaração de Conteúdo";
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title><?=$title?></title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/sb-admin.css" rel="stylesheet">
</head>

<style type="text/css">
    #page-wrapper{
        width: 100%;
        margin: 1%;
    }

    .center {
        margin-top: 12%;
    }

    .grupo {
        display: inline-block;
        width: 100%;
        height: 100%;
        margin: .25rem;
        background-color: #FFF;
        border: 1px solid #dee2e6 !important;
        border-color: #6c757d !important;
        box-sizing: border-box;
        padding: 1%;
        border-radius: .50rem !important;
    }
</style>

<body>
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="navbar-header">
            <a class="navbar-brand" href="index.php"><?=$title?></a>
        </div>
    </nav>
    <div id="page-wrapper">
        <form action="declaracao.php" method="POST">
            <div id="div_remetente"></div>
            <div id="div_destinatario"></div>
            <div class="container-fluid">
                <span class="grupo">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Descrição do Item</label>
                                <input type="text" class="form-control" name="item" id="item" placeholder="Informe o nome do item">
                            </div>
                        </div>
                        <div class="col-lg-1">
                            <div class="form-group">
                                <label>Quantidade</label>
                                <input type="text" class="form-control" name="quantidade" id="quantidade" placeholder="Informe aquantidade">
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label>Valor Total</label>
                                <input type="text" class="form-control" name="valor_total" id="valor_total" placeholder="Informe o valor total">
                            </div>
                        </div>
                        <div class="col-lg-1">
                            <div class="form-group center">
                                <button type="submit" class="btn btn-success center" id="">Enviar</button>
                            </div>
                        </div>
                    </div>
                </span>
            </div>
        </form>
    </div>
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/mask.min.js"></script>
    <script>
        $(document).ready(function(){
            $(".cpf").mask('000.000.000-00');
            $(".cep").mask('00000-000');

            $("#div_remetente").load("remetente.php");
            $("#div_destinatario").load("destinatario.php");

            $(document).on("click","button.btnConsultaCep",function(){
                let field = this.id.replace('btn_','');

                let cep = $("input." + field + "_cep").val();

                if(cep.length > 8){
                    cep = cep.replace("-","");
                } else {
                    return false;
                }

                let url = "https://viacep.com.br/ws/" + cep + "/json/";

                $.ajax({
                    url: url,
                    type: "GET"
                }).done(function(data) {
                    
                    $("input." + field + "_endereco").val(data.logradouro);
                    $("input." + field + "_bairro").val(data.bairro);
                    $("select." + field + '_estado option').removeAttr('selected').filter('[value='+ data.uf +']').prop('selected', true);
                    $("select." + field + "_cidade").html("<option value='" + data.localidade + "' selected>" + data.localidade + "</option>");
                    $("input." + field + "_numero").focus();
                });
            });

        });
    </script>
</body>
</html>
