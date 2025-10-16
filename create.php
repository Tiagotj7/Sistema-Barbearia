<?php
require 'config.php';
$e=[];
if($_SERVER['REQUEST_METHOD']==='POST'){
  $n=trim($_POST['nome']??'');
  $t=trim($_POST['telefone']??'');
  $s=trim($_POST['servico']??'');
  $dh=trim($_POST['data_hora']??'');
  $o=trim($_POST['observacoes']??'');
  if($n==='')$e[]='Nome é obrigatório.';
  if($t==='')$e[]='Telefone é obrigatório.';
  if($s==='')$e[]='Serviço é obrigatório.';
  if($dh==='')$e[]='Data e hora são obrigatórias.';
  if(empty($e)){
    $dh=str_replace('T',' ',$dh);
    $sql="INSERT INTO agendamentos (nome,telefone,servico,data_hora,observacoes) VALUES (?,?,?,?,?)";
    $stmt=mysqli_prepare($con,$sql);
    mysqli_stmt_bind_param($stmt,'sssss',$n,$t,$s,$dh,$o);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header('Location: index.php');exit;
  }
}
?>
<!doctype html>
<html lang="pt-br">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">

<title>Novo Agendamento - Tesoura Real</title>
<link rel="stylesheet" href="create.css">
</head>
<body>
<header>
  <h1>💈 Tesoura Real</h1>
  <p>Novo Agendamento</p>
</header>

<div class="container">
  <h2>Registrar Atendimento</h2>
  <form method="POST">
    <label>Nome do Cliente</label>
    <input type="text" name="nome" required>

    <label>Telefone</label>
    <input type="text" name="telefone" required>

    <label>Serviço</label>
    <select name="servico" required>
      <option value="">Selecione</option>
      <option>Corte Masculino</option>
      <option>Barba Completa</option>
      <option>Corte + Barba</option>
      <option>Sobrancelha</option>
    </select>

    <label>Data e Hora</label>
    <input type="datetime-local" name="data_hora" required>

    <label>Observações</label>
    <textarea name="observacoes" rows="3"></textarea>

    <button type="submit">Salvar</button>
  </form>
  <a href="index.php">⬅ Voltar</a>
</div>
</body>
</html>

<style>
body {
  font-family: 'Poppins', sans-serif;
  background-color: #121212;
  color: #f5f5f5;
  margin: 0;
  padding: 0;
  display: flex;
  flex-direction: column;
  align-items: center;
  min-height: 100vh;
}

header {
  width: 100%;
  background: linear-gradient(135deg, #1a1a1a, #2b2b2b);
  color: #f5f5f5;
  text-align: center;
  padding: 20px 0;
  box-shadow: 0 2px 10px rgba(255, 215, 0, 0.2);
}

header h1 {
  font-size: 2rem;
  color: #f0c93d;
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 10px;
}

.container {
  background: #1e1e1e;
  margin-top: 40px;
  padding: 30px;
  border-radius: 15px;
  box-shadow: 0 0 20px rgba(255, 215, 0, 0.15);
  width: 90%;
  max-width: 500px;
}

.container h2 {
  text-align: center;
  color: #f0c93d;
  margin-bottom: 25px;
  font-size: 1.5rem;
}

form {
  display: flex;
  flex-direction: column;
  gap: 15px;
}

label {
  font-weight: 500;
  color: #ddd;
}

input, textarea, select {
  padding: 10px;
  border-radius: 8px;
  border: none;
  background-color: #2b2b2b;
  color: #fff;
  font-size: 1rem;
  outline: none;
  transition: 0.3s;
}

input:focus, textarea:focus, select:focus {
  border: 1px solid #f0c93d;
  box-shadow: 0 0 8px rgba(255, 215, 0, 0.3);
}

button {
  padding: 12px;
  border: none;
  border-radius: 10px;
  font-size: 1rem;
  background-color: #f0c93d;
  color: #000;
  font-weight: bold;
  cursor: pointer;
  transition: all 0.3s ease;
}

button:hover {
  background-color: #ffdb4d;
  transform: scale(1.03);
}

a {
  display: block;
  text-align: center;
  color: #f0c93d;
  text-decoration: none;
  margin-top: 15px;
  font-weight: 500;
  transition: 0.3s;
}

a:hover {
  color: #ffe57a;
}

</style>
