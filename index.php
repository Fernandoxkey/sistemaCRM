<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRM - Funil de Vendas</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
</head>
<body>

<nav class="navbar navbar-expand-lg bg-dark navbar-dark">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active"><a class="nav-link" href="index.php">CRM</a></li>
            <li class="nav-item "><a class="nav-link" href="contatos_ativos.php">Contatos Ativos</a></li>
            <li class="nav-item "><a class="nav-link" href="contatos_perdidos.php">Contatos Perdidos</a></li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Buscar" aria-label="Buscar" id="buscar" name="buscar" value="<?= @$_GET['buscar'] ?>">
            <button class="btn my-2 my-sm-0" type="submit"><i class="fas fa-search"></i></button>
        </form>
    </div>
</nav>


<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item">Funil de Vendas</li>
  </ol>
</nav>

<div class="container-fluid">
<div class="msgs"></div>
<div class="row col-md-12 pull-right">
    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">
      Novo Contato
    </button>
</div>
<div class="funil-container">
    <div class="estagio" data-estagio="Interesse">
        <h2>Interesse</h2>
        <ul class="contatos-list" data-estagio="Interesse"></ul>
    </div>
    <div class="estagio" data-estagio="Contato Feito">
        <h2>Contato Feito</h2>
        <ul class="contatos-list" data-estagio="Contato Feito"></ul>
    </div>
    <div class="estagio" data-estagio="Proposta">
        <h2>Proposta</h2>
        <ul class="contatos-list" data-estagio="Proposta"></ul>
    </div>
    <div class="estagio" data-estagio="Finalizado">
        <h2>Finalizado</h2>
        <ul class="contatos-list" data-estagio="Finalizado"></ul>
    </div>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">

        <div class="modal-content">
            <form id="form-cadastro" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Novo Contato</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
            
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nome">Nome:</label>
                        <input class="form-control" type="text" id="nome" name="nome" required>
                    </div>
                    <div class="form-group">
                        <label for="telefone">Telefone:</label>
                        <input class="form-control" type="text" id="telefone" name="telefone" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input class="form-control" type="email" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="estagio">Estágio:</label>
                        <select class="form-control" id="estagio" name="estagio" required>
                            <option value="Interesse">Interesse</option>
                            <option value="Contato Feito">Contato Feito</option>
                            <option value="Proposta">Proposta</option>
                            <option value="Finalizado">Finalizado</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="anotacoes">Anotações:</label>
                        <textarea class="form-control" id="anotacoes" name="anotacoes" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="tarefas">Tarefas:</label>
                        <textarea class="form-control" id="tarefas" name="tarefas" rows="3"></textarea>
                    </div>
                    <div class="thumb"></div>
                    <div class="form-group">
                       <label for="arquivo">Documento:</label>
                       <input class="form-control-file" type="file" id="arquivo" name="arquivo">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="script.js"></script>


<footer class="fixed-bottom footer_section">
    <div class="container">
        <span>Suporte : +55 44 99883-3535</span>&nbsp;|
        <span>E-mail : crm.vendas@gmail.com</span>
      <p>
        &copy; <span id="displayYear"></span> All Rights Reserved By
        <b>CRM BRASIL</b>
      </p>
    </div>
</footer>
</body>
</html>
