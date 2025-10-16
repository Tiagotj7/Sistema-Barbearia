<?php
require 'config.php';
$id = intval($_GET['id'] ?? 0);
if ($id <= 0) { header('Location: index.php'); exit; }

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sql = "DELETE FROM agendamentos WHERE id=?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header('Location: index.php'); exit;
}

$sql = "SELECT * FROM agendamentos WHERE id=? LIMIT 1";
$stmt = mysqli_prepare($con, $sql);
mysqli_stmt_bind_param($stmt, 'i', $id);
mysqli_stmt_execute($stmt);
$res = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($res);
if (!$row) { header('Location: index.php'); exit; }
?>
<!doctype html>
<html lang="pt-br">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Excluir Agendamento</title>
<link rel="stylesheet" href="style.css">
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
</head>
<body>
<div class="container form">
  <h2>Confirmar Exclusão</h2>
  <p>Deseja realmente excluir o agendamento de <strong><?php echo htmlspecialchars($row['nome']); ?></strong> (<?php echo htmlspecialchars($row['servico']); ?>) em <?php echo date('d/m/Y H:i', strtotime($row['data_hora'])); ?>?</p>
  <form method="post" class="actions">
    <button type="submit">Sim, excluir</button>
    <a class="btn" href="index.php">Cancelar</a>
  </form>
</div>
</body>
</html>
