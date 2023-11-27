<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRM - Contatos Ativos</title>
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
            <li class="nav-item"><a class="nav-link" href="index.php">CRM</a></li>
            <li class="nav-item "><a class="nav-link" href="contatos_ativos.php">Contatos Ativos</a></li>
            <li class="nav-item "><a class="nav-link" href="contatos_perdidos.php">Contatos Perdidos</a></li>
        </ul>
        <form action="index.php" class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Buscar" aria-label="Buscar" id="buscar" name="buscar" value="" disabled>
            <button class="btn my-2 my-sm-0" type="submit" disabled><i class="fas fa-search"></i></button>
        </form>
    </div>
</nav>

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item">Funil de Vendas</li>
    <li class="breadcrumb-item active" aria-current="page">Detalhes do contato #<?= $_GET["id"] ?></li>
  </ol>
</nav>

<div class="container-fluid">
    <input type="hidden" id="contato_id" name="contato_id" value="<?= $_GET['id'] ?>">
    <div class="col-md-12 img"></div>
    <div class="col-md-12 info"></div>
    <br>
    <a href="javascript:javascript:history.go(-1)" class="btn btn-secondary btn-sm">Voltar</a>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="detalhes.js"></script>

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
