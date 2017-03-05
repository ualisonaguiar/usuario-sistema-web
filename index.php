<html>
<head>
    <title>Cliente Rest</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
    <h2>Client Rest</h2>

    <div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="urlServidor">URL do sistema rest:</label>
                    <input type="text" class="form-control" id="urlServidor" placeholder="URL do serviço rest"
                           value="http://usuario-rest.local">
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div>
        <div class="row">
            <div class="col-md-6">
                <h3>Solicitar Token</h3>

                <div class="form-group">
                    <label for="usuario">Usuário:</label>
                    <input type="text" class="form-control" id="usuario" placeholder="Informe usuário">
                </div>
                <div class="form-group">
                    <label for="pwd">Senha:</label>
                    <input type="password" class="form-control" id="pwd" placeholder="Informe a senha">
                </div>
                <div class="form-group">
                    <button id="solicitarToken" type="button" class="btn btn-primary" value="Solicitar Token">Solicitar
                        Token
                    </button>
                </div>
            </div>
            <div class="col-md-6">
                <h3>Envio da requisição</h3>

                <div class="form-group">
                    <textarea id="envioRequisicao" class="form-control"
                              style="margin: 0px -25px 0px 0px; height: 168px; width: 579px;"></textarea>
                </div>
            </div>
            <div class="col-md-6">
                <h3>Resultado da requisição</h3>

                <div class="form-group">
                    <textarea id="resultadoToken" class="form-control"
                              style="margin: 0px -25px 0px 0px; height: 168px; width: 579px;"></textarea>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div>
        <h3>CRUD de usuário</h3>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="usuario">Token:</label>
                    <input type="text" class="form-control" id="token" placeholder="Informe o token">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">
                <div class="form-group">
                    <label for="Metodo">Metodo:</label>
                    <select name="metodo" id="metodo" class="form-control">
                        <option value="">Selecione</option>
                        <option value="GET">GET</option>
                        <option value="POST">POST</option>
                        <option value="PUT">PUT</option>
                        <option value="DELETE">DELETE</option>
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <label for="Metodo">Url do serviço:</label>
                <input type="text" class="form-control" name="urlServico" id="urlServico">
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <button id="enviaRquisicao" type="button" class="btn btn-primary" value="Enviar">Enviar
                    </button>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6" style="margin-top: -254px;margin-left: 590px;">
                <h3>Dados de Envio</h3>

                <div class="form-group">
                    <textarea id="textoRequisicao" class="form-control"
                              style="margin: 0px -25px 0px 0px; height: 168px; width: 579px;"></textarea>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="application/javascript">
    $(document).ready(function () {
        $('#solicitarToken').click(function () {
            if ($('#usuario').val() === '' && $('#pwd').val() === '') {
                alert('Informe usuário/senha para solicitar token');
            } else {
                var arrData = {
                    usuario: $('#usuario').val(),
                    senha: $('#pwd').val()
                };
                getRequisicao('solicitar-token', 'POST', JSON.stringify(arrData), 'application/json');
            }
        });

        $('#enviaRquisicao').click(function() {
            var strContentType = '';
            if ($('#metodo').val() !== 'GET') {
                strContentType = 'application/json';
            }
            var arrHeader = {
                Authorization: 'Bearer ' + $('#token').val(),
            };
            getRequisicao($('#urlServico').val(), $('#metodo').val(), $('#textoRequisicao').val(), strContentType, arrHeader);
        });

        function getRequisicao(strUrl, strMethod, arrData, strContentType, arrHeader) {
            if (strContentType == '') {
                strContentType = null;
            }
            if (arrHeader == '') {
                arrHeader = [];
            }
            var strUrlServico = $('#urlServidor').val();
            if (strUrlServico === '') {
                alert('Informa a url do serviço rest');
                return false;
            } else {
                strUrl = strUrlServico + '/' + strUrl;
                $.ajax({
                    url: strUrl,
                    type: strMethod,
                    data: arrData,
                    contentType: strContentType,
                    headers: arrHeader,
                    success: function (result) {
                        $('#resultadoToken').html(JSON.stringify(result, null, 2));
                    }
                });
                exibeDetalheRequiscao(strMethod, strUrl, arrHeader, arrData);
            }
        }

        function exibeDetalheRequiscao(strMethod, strUrl, arrHeader, arrData)
        {
            var strEnvio = 'Metodo: ' + strMethod + '\n';
            strEnvio += 'URL: ' + strUrl + '\n';
            if (arrHeader) {
                strEnvio += 'Header:\n';
                strEnvio += JSON.stringify(arrHeader, null, 2);
            }
            strEnvio += '\nData \n';
            strEnvio += arrData;
            $('#envioRequisicao').html(strEnvio);
        }
    });
</script>
</body>
</html>