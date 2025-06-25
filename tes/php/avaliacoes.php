<?php
$produto_id = 1; // ID do produto atual, substitua pelo método que você utiliza para obter este ID.

$servername = "localhost";
$username = "root";
$password = "pedrinho13";
$dbname = "zero21";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Falha na conexão: " . $conn->connect_error);
}

$sql = "SELECT nome_usuario, avaliacao, estrelas, data FROM avaliacoes WHERE produto_id = ? ORDER BY data DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $produto_id);
$stmt->execute();
$result = $stmt->get_result();
$avaliacoes = [];

if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $avaliacoes[] = $row;
  }
}

$stmt->close();
$conn->close();
?>

<div id="reviews">
  <?php foreach ($avaliacoes as $avaliacao) : ?>
    <div class="review">
      <p><strong><?php echo htmlspecialchars($avaliacao['nome_usuario']); ?>:</strong> <?php echo htmlspecialchars($avaliacao['avaliacao']); ?> - <?php echo $avaliacao['estrelas']; ?> estrelas</p>
      <p><em><?php echo $avaliacao['data']; ?></em></p>
    </div>
  <?php endforeach; ?>
</div>
