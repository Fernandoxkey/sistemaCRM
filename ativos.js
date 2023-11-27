$(document).ready(function () {
    // Função para listar os contatos em cada estágio do funil
    function listarContatos() {
        $.ajax({
            url: "get_contatos.php",
            method: "GET",
            dataType: "json",
            data:{status:"Ativo", q:$('#buscar').val()},
            success: function (data) {
                $(".contatos-list").empty();

                $.each(data, function (index, contato) {
                                
                    var card = '<div class="col-sm-3">'+
                            '<div class="card" data-id="' + contato.id + '">'+
                                '<div class="card-body">'+
                                    '<h5 class="card-title">' + contato.nome + '</h5>'+
                                    '<p class="card-text">' + contato.email + '</p>'+
                                    '<p class="card-text">' + contato.telefone + '</p>'+
                                    '<a href="detalhes.php?id='+contato.id+'" class="btn btn-sm btn-primary">Ver Detalhes</a>&nbsp;'+
                                    '<button class="btn btn-default btn-sm btn-retornar">Retornar</button>'+
                                '</div>'+
                            '</div>'+
                        '</div>';

                    $(".contatos-list").append(card);
                });
            },
            error: function (xhr, status, error) {
                console.log("Erro ao listar contatos: " + error);
            }
        });
    }

    // Listar contatos na inicialização
    listarContatos();

   $(".container-fluid").on("click", ".btn-retornar", function () {
        var idContato = $(this).closest(".card").data("id");

        $.ajax({
            url: "mover_contato.php",
            method: "POST",
            data: { id: idContato, estagio: "Finalizado" },
            success: function (data) {
                listarContatos();
            },
            error: function (xhr, status, error) {
                console.log("Erro ao mover contato: " + error);
            }
        });
    });
});
