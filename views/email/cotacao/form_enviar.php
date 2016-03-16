<div id="tudo">
    <form action="" method="post" class="form-horizontal form-label-left">

        <div id="cabecalho">
            <input hidden type="number" name="count" id="count" value="1">
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="host"> Host
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <select class="form-control col-md-7 col-xs-12" id="host" name="host">
                        <?php
                        require_once '../../../dao/daohost.php';

                        $daohost = DaoHost::getInstance();
                        $listaHosts = $daohost->SelecionaTudo();

                        foreach ($listaHosts as $host) {
                            echo '<option value="' . $host->getIdHost() . '">' . $host->getNome() . '</option>';
                        }
                        ?>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="destinatario"> Destinatário
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input class="form-control col-md-7 col-xs-12" id="destinatario" type="text"
                           name="destinatario">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="transportadora"> Transportadora
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input class="form-control col-md-7 col-xs-12" id="transportadora" type="text"
                           name="transportadora">
                </div>
            </div>


            <!-- campos de cotação -->
            <div id="forms">
                <div class="expensive-form" id="expensive-form1">
                    <h4>Cotação 1</h4>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nome_empresa1"> Nome da Empresa
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input class="form-control col-md-7 col-xs-12" id="nome_empresa1" type="text"
                                   name="nome_empresa1">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cnpj1"> CNPJ
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input class="form-control col-md-7 col-xs-12" id="cnpj1" type="number"
                                   name="cnpj1">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cidade1"> Cidade
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input class="form-control col-md-7 col-xs-12" id="cidade1" type="text"
                                   name="cidade1">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="volume1"> Volume
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input class="form-control col-md-7 col-xs-12" id="volume1" type="text"
                                   name="volume1">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="litros1"> Litros
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input class="form-control col-md-7 col-xs-12" id="litros1" type="number" step="any"
                                   name="litros1">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="valor_nfe1"> Valor NF-e
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input class="form-control col-md-7 col-xs-12" id="valor_nfe1" type="number" step="0.01"
                                   name="valor_nfe1">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="frete1"> Frete
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input class="form-control col-md-7 col-xs-12" id="frete1" type="text"
                                   name="frete1">
                        </div>
                    </div>
                </div>
            </div>
            <!-- ------------------------ -->

            <div id="final-form">
                <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                        <span class="pull-right"><a onclick='addCotacao()'>Adicionar cotação</a></span>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                        <span class="pull-right"><a onclick='removeLastCotacao()'>Remover cotação</a></span>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                        <button class="btn btn-success pull-right" type="submit">Enviar</button>
                    </div>
                </div>
            </div>
            <script>
                $(document).ready(function () {
                    document.getElementById("count").value = 1;
                });

                function addCotacao() {
                    document.getElementById("count").value++;
                    var count = document.getElementById("count").value;
                    $('#forms').append('<div class="expensive-form" id="expensive-form' + count + '"> <br> <h4>Cotação ' + count + '</h4> <div class="form-group"> <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nome_empresa' + count + '"> Nome da Empresa </label> <div class="col-md-6 col-sm-6 col-xs-12"> <input class="form-control col-md-7 col-xs-12" id="nome_empresa' + count + '" type="text" name="nome_empresa' + count + '"> </div> </div> <div class="form-group"> <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cnpj' + count + '"> CNPJ </label> <div class="col-md-6 col-sm-6 col-xs-12"> <input class="form-control col-md-7 col-xs-12" id="cnpj' + count + '" type="number"name="cnpj' + count + '"> </div> </div> <div class="form-group"> <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cidade' + count + '"> Cidade </label> <div class="col-md-6 col-sm-6 col-xs-12"> <input class="form-control col-md-7 col-xs-12" id="cidade' + count + '" type="text" name="cidade' + count + '"> </div> </div> <div class="form-group"> <label class="control-label col-md-3 col-sm-3 col-xs-12" for="volume' + count + '"> Volume </label> <div class="col-md-6 col-sm-6 col-xs-12"> <input class="form-control col-md-7 col-xs-12" id="volume' + count + '" type="text"name="volume' + count + '"> </div> </div><div class="form-group"> <label class="control-label col-md-3 col-sm-3 col-xs-12" for="litros' + count + '"> Litros </label> <div class="col-md-6 col-sm-6 col-xs-12"> <input class="form-control col-md-7 col-xs-12" id="litros' + count + '" type="number" step="any" name="litros' + count + '">     </div> </div> <div class="form-group"> <label class="control-label col-md-3 col-sm-3 col-xs-12" for="valor_nfe' + count + '"> Valor NF-e </label> <div class="col-md-6 col-sm-6 col-xs-12"> <input class="form-control col-md-7 col-xs-12" id="valor_nfe' + count + '" type="number" step="0.01" name="valor_nfe' + count + '"> </div> </div> <div class="form-group"> <label class="control-label col-md-3 col-sm-3 col-xs-12" for="frete' + count + '"> Frete </label> <div class="col-md-6 col-sm-6 col-xs-12"> <input class="form-control col-md-7 col-xs-12" id="frete' + count + '" type="text"name="frete' + count + '">     </div> </div> </div>');
                }

                function removeLastCotacao() {
                    var count = document.getElementById("count").value;
                    if (count == 1) {
                        alert("O formulário deverá conter ao menos uma cotação!");
                    } else if (count > 1) {
                        var forms = document.getElementById("forms");
                        forms.removeChild(forms.lastChild);
                        document.getElementById("count").value--;
                    }
                }
            </script>
            <style>
                h4 {
                    text-align: center;
                }

                a {
                    cursor: pointer;
                }

                table {
                    width: 40%;
                }

                .expensive-form table tr td input, #cabecalho input, #cabecalho select {
                    width: 100%;
                }
            </style>
    </form>
</div>