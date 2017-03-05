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
                    <label for="urlServico">URL do serviço rest:</label>
                    <input type="text" class="form-control" id="urlServico" placeholder="URL do serviço rest"
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
            </div>
            <div class="col-md-6">
                <h3>Resultado da requisição</h3>
                <div class="form-group">
                    <textarea id="resultadoToken" class="form-control"
                              style="margin: 0px -25px 0px 0px; height: 168px; width: 579px;"></textarea>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <button id="solicitarToken" type="button" class="btn btn-primary" value="Solicitar Token">Solicitar
                    Token
                </button>
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
                getRequisicao('solicitar-token', 'POST', arrData, 'application/json');
            }
        });

        function getRequisicao(strUrl, strMethod, arrData, strContentType) {
            if (strContentType == '') {
                strContentType = null;
            }
            var strUrlServico = $('#urlServico').val();
            if (strUrlServico === '') {
                alert('Informa a url do serviço rest');
                return false;
            } else {
                $.ajax({
                    url: strUrlServico + '/' + strUrl,
                    type: strMethod,
                    data: arrData,
                    contentType: strContentType,
                    success: function (result) {
                        $('#resultadoToken').html(JSON.stringify(result, null, 2));
                    }
                });
            }
        }
    });
</script>
</body>
</html>