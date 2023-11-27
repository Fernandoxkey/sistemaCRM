$(document).ready(function () {
    // Função para listar os contatos em cada estágio do funil
    function listarContatos() {
        $.ajax({
            url: "get_contatos.php",
            method: "GET",
            data: {q : $('#buscar').val()},
            dataType: "json",
            success: function (data) {
                $(".contatos-list").empty();

                $.each(data, function (index, contato) {
                    
                    if(contato.estagio == "Finalizado") {
                        var btns = '<button class="btn btn-primary btn-sm btn-mover" data-estagio="Ativo">Ativo</button>&nbsp;<button class="btn btn-secondary btn-sm btn-mover" data-estagio="Perdido">Perdido</button>&nbsp;';
                    } else{
                        var btns = '<button class="btn btn-info btn-sm btn-mover" data-estagio="' + contato.estagio + '">Mover</button>&nbsp;';
                    }
                    var card = '<li class="contato-card" data-id="' + contato.id + '">' +
                                    '<h4>' + contato.nome + '</h4>' +
                                    '<p>Email: ' + contato.email + '</p>' +
                                    '<p>Telefone: ' + contato.telefone + '</p>' +
                                    btns +
                                    '<button class="btn btn-warning btn-sm btn-editar" data-id="' + contato.id + '">Editar</button>&nbsp;' +
                                    '<button class="btn btn-danger btn-sm btn-excluir" data-id="' + contato.id + '">Excluir</button>&nbsp;' +
                                '</li>';

                    $(".contatos-list[data-estagio='" + contato.estagio + "']").append(card);
                });
            },
            error: function (xhr, status, error) {
                console.log("Erro ao listar contatos: " + error);
            }
        });
    }

    // Listar contatos na inicialização
    listarContatos();

    // Evento de envio do formulário de cadastro
    $("#form-cadastro").submit(function (e) {
        e.preventDefault();
        var formData = new FormData(this);
        console.log(formData)
        $.ajax({
            url: "cadastro_contato.php",
            method: "POST",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                console.log(data)
                var res = JSON.parse(data);

                $("#form-cadastro")[0].reset();
                $("#id").remove()
                $("#exampleModal").modal('hide');
                
                if(res.erro == false) {
                    listarContatos();
                    $('.msgs').html('<div class="alert alert-success alert-dismissible fade show" role="alert">'+
                        res.msg +
                        '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
                            '<span aria-hidden="true">&times;</span>'+
                        '</button>'+
                    '</div>');
                } else {
                    $('.msgs').html('<div class="alert alert-danger alert-dismissible fade show" role="alert">'+
                        res.msg +
                        '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
                            '<span aria-hidden="true">&times;</span>'+
                        '</button>'+
                    '</div>');
                }
            },
            error: function (xhr, status, error) {
                console.log("Erro ao cadastrar contato: " + error);
            }
        });
    });

    // Função para mover o contato entre os estágios do funil
    $(".funil-container").on("click", ".btn-mover", function () {
        var idContato = $(this).closest(".contato-card").data("id");
        var novoEstagio = $(this).data("estagio");

        $.ajax({
            url: "mover_contato.php",
            method: "POST",
            data: { id: idContato, estagio: novoEstagio },
            success: function (data) {
                listarContatos();
            },
            error: function (xhr, status, error) {
                console.log("Erro ao mover contato: " + error);
            }
        });
    });

    $(".funil-container").on("click", ".btn-editar", function () {
        var idContato = $(this).closest(".contato-card").data("id");
        
        $("#exampleModalLabel").html("Editando Contato #"+idContato);

        $.ajax({
            url: "get_contatos.php",
            method: "GET",
            data: { id: idContato },
            success: function (data) {
                var res = JSON.parse(data);
                $("#nome").val(res[0].nome)
                $("#telefone").val(res[0].telefone)
                $("#email").val(res[0].email)
                $("#estagio").val(res[0].estagio)
                $("#anotacoes").val(res[0].anotacoes)
                $("#tarefas").val(res[0].tarefas)
                if(res[0].arquivo) {
                    //$(".thumb").html('<img src="'+res[0].arquivo+'" class="img-thumbnail img-fluid" style="max-width:100px;">');
                    $(".thumb").html('<a href="'+res[0].arquivo+'" class="btn btn-link" download><i class="fas fa-download"></i> Baixar arquivo</a>');
                }
                $('<input>').attr({
                    type: 'hidden',
                    id: 'id',
                    name: 'id',
                    value: res[0].id
                }).appendTo('#form-cadastro');
                $("#exampleModal").modal("show")
            },
            error: function (xhr, status, error) {
                console.log("Erro ao mover contato: " + error);
            }
        });
    });

    $('#exampleModal').on('hidden.bs.modal', function () {
        $("#exampleModalLabel").html("Novo Contato");
        $("#form-cadastro")[0].reset();
        $(".thumb").html("");
    })


    // Evento de exclusão de contato
    $(".funil-container").on("click", ".btn-excluir", function () {
        if (confirm("Tem certeza que deseja excluir o contato?")) {
            var idContato = $(this).closest(".contato-card").data("id");
            excluirContato(idContato);
        }
    });

    function excluirContato(idContato) {
        $.ajax({
            url: "excluir_contato.php",
            method: "POST",
            data: { id: idContato },
            success: function (data) {
                var res = JSON.parse(data);
                listarContatos();

                if(res.erro == false) {
                    $('.msgs').html('<div class="alert alert-success alert-dismissible fade show" role="alert">'+
                        res.msg +
                        '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
                            '<span aria-hidden="true">&times;</span>'+
                        '</button>'+
                    '</div>');
                } else {
                    $('.msgs').html('<div class="alert alert-danger alert-dismissible fade show" role="alert">'+
                        res.msg +
                        '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
                            '<span aria-hidden="true">&times;</span>'+
                        '</button>'+
                    '</div>');
                }
            },
            error: function (xhr, status, error) {
                console.log("Erro ao excluir contato: " + error);
            }
        });
    }

});

