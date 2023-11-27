$(document).ready(function () {
    // Função para listar os contatos em cada estágio do funil
    function getContato() {
        $.ajax({
            url: "get_contatos.php",
            method: "GET",
            data: { id: $("#contato_id").val() },
            success: function (data) {
                var res = JSON.parse(data);

                if(res[0].arquivo) {
                    //var img = '<img class="img-fluid mx-auto d-block" src="'+res[0].arquivo+'">'
                    var img = '<a href="'+res[0].arquivo+'" class="btn btn-link" download><i class="fas fa-download"></i> Baixar arquivo</a>';
                    $('.img').html(img);
                }

                var info = '<ul class="list-group list-group-flush">'+
                    '<li class="list-group-item"><b>Nome:</b> '+res[0].nome+'</li>'+
                    '<li class="list-group-item"><b>Telefone:</b> '+res[0].telefone+'</li>'+
                    '<li class="list-group-item"><b>E-mail:</b> '+res[0].email+'</li>'+
                    '<li class="list-group-item"><b>Estágio:</b> '+res[0].estagio+'</li>'+
                    '<li class="list-group-item"><b>Anotações:</b> '+res[0].anotacoes+'</li>'+
                    '<li class="list-group-item"><b>Tarefas:</b> '+res[0].tarefas+'</li>'+
                    '<li class="list-group-item"><b>Ativo:</b> '+res[0].ativo+'</li>'+
                '</ul>';

                $('.info').html(info);
            },
            error: function (xhr, status, error) {
                console.log("Erro ao mover contato: " + error);
            }
        });
    }

    // Listar contatos na inicialização
    getContato();   
});
