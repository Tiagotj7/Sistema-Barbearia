<?php
require 'config.php';
$id=intval($_GET['id']??0);
if($id<=0){header('Location: index.php');exit;}
$e=[];
if($_SERVER['REQUEST_METHOD']==='POST'){
  $n=trim($_POST['nome']??'');$t=trim($_POST['telefone']??'');$s=trim($_POST['servico']??'');$dh=trim($_POST['data_hora']??'');$o=trim($_POST['observacoes']??'');
  if($n==='')$e[]='Nome é obrigatório.';if($t==='')$e[]='Telefone é obrigatório.';if($s==='')$e[]='Serviço é obrigatório.';if($dh==='')$e[]='Data e hora são obrigatórias.';
  if(empty($e)){
    $dh=str_replace('T',' ',$dh);
    $sql="UPDATE agendamentos SET nome=?,telefone=?,servico=?,data_hora=?,observacoes=? WHERE id=?";
    $stmt=mysqli_prepare($con,$sql);
    mysqli_stmt_bind_param($stmt,'sssssi',$n,$t,$s,$dh,$o,$id);
    mysqli_stmt_execute($stmt);mysqli_stmt_close($stmt);
    header('Location: index.php');exit;
  }
}else{
  $sql="SELECT * FROM agendamentos WHERE id=? LIMIT 1";
  $stmt=mysqli_prepare($con,$sql);mysqli_stmt_bind_param($stmt,'i',$id);mysqli_stmt_execute($stmt);
  $res=mysqli_stmt_get_result($stmt);$row=mysqli_fetch_assoc($res);
  if(!$row){header('Location: index.php');exit;}
  $row['data_hora']=date('Y-m-d\\TH:i',strtotime($row['data_hora']));
}
?>
<!doctype html>
<html lang="pt-br">
  <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">

<head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Editar</title><link rel="stylesheet" href="style.css"></head>
<body>
<div class="container form">
  <h2>Editar #<?php echo $id; ?></h2>
  <?php if(!empty($e)):?><div class="errors"><ul><?php foreach($e as $er)echo '<li>'.htmlspecialchars($er).'</li>';?></ul></div><?php endif; ?>
  <form method="post">
    <label>Nome<br><input type="text" name="nome" value="<?php echo htmlspecialchars($_POST['nome']??$row['nome']); ?>"></label>
    <label>Telefone<br><input type="text" name="telefone" value="<?php echo htmlspecialchars($_POST['telefone']??$row['telefone']); ?>"></label>
    <label>Serviço<br><input type="text" name="servico" value="<?php echo htmlspecialchars($_POST['servico']??$row['servico']); ?>"></label>
    <label>Data e Hora<br><input type="datetime-local" name="data_hora" value="<?php echo htmlspecialchars($_POST['data_hora']??$row['data_hora']); ?>"></label>
    <label>Observações<br><textarea name="observacoes"><?php echo htmlspecialchars($_POST['observacoes']??$row['observacoes']); ?></textarea></label>
    <div class="actions"><button type="submit">Atualizar</button> <a class="btn" href="index.php">Voltar</a></div>
  </form>
</div>
</body>
</html>
