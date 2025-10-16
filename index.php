<?php
require 'config.php';
$q='';
if(isset($_GET['q']))$q=trim($_GET['q']);
$sql="SELECT * FROM agendamentos";
if($q!==''){
  $sql.=" WHERE nome LIKE ? OR servico LIKE ? OR telefone LIKE ?";
  $like="%{$q}%";
}
$sql.=" ORDER BY data_hora ASC";
if($q!==''){
  $stmt=mysqli_prepare($con,$sql);
  mysqli_stmt_bind_param($stmt,'sss',$like,$like,$like);
  mysqli_stmt_execute($stmt);
  $res=mysqli_stmt_get_result($stmt);
}else{
  $res=mysqli_query($con,$sql);
}
?>
<!doctype html>
<html lang="pt-br">
<head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>Barbearia - Agendamentos</title>
<link rel="stylesheet" href="style.css">
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">

</head>
<body>
<div class="container">
  <h1>Agendamentos</h1>
  <div class="top">
    <form method="get" class="search">
      <input type="text" name="q" placeholder="Buscar por nome, serviço ou telefone" value="<?php echo htmlspecialchars($q); ?>">
      <button type="submit">Buscar</button>
    </form>
    <a class="btn" href="create.php">Novo Agendamento</a>
  </div>
  <table>
    <thead>
      <tr><th>ID</th><th>Nome</th><th>Telefone</th><th>Serviço</th><th>Data e Hora</th><th>Observações</th><th>Data Reg.</th><th>Ações</th></tr>
    </thead>
    <tbody>
    <?php if($res && mysqli_num_rows($res)>0):while($row=mysqli_fetch_assoc($res)): ?>
      <tr>
<td data-label="ID"><?php echo $row['id']; ?></td>
<td data-label="Nome"><?php echo htmlspecialchars($row['nome']); ?></td>
<td data-label="Telefone"><?php echo htmlspecialchars($row['telefone']); ?></td>
<td data-label="Serviço"><?php echo htmlspecialchars($row['servico']); ?></td>
<td data-label="Data e Hora"><?php echo date('d/m/Y H:i',strtotime($row['data_hora'])); ?></td>
<td data-label="Observações"><?php echo nl2br(htmlspecialchars($row['observacoes'])); ?></td>
<td data-label="Data Reg."><?php echo date('d/m/Y H:i',strtotime($row['data_registro'])); ?></td>
<td data-label="Ações">
  <a href="edit.php?id=<?php echo $row['id']; ?>">Editar</a> | 
  <a href="delete.php?id=<?php echo $row['id']; ?>">Excluir</a>
</td>

      </tr>
    <?php endwhile;else: ?>
      <tr><td colspan="8">Nenhum agendamento encontrado.</td></tr>
    <?php endif; ?>
    </tbody>
  </table>
</div>
</body>
</html>
