<!DOCTYPE html>
<html lang="es">
<head>
    <?php include 'header.php'; ?>
</head>
<body>
    <div class="container">
        <img src="logo.png" width="100%"></img>
        <br />
        <form method="POST" action="validar.php" autocomplete="off">
            <label for="clave">Introduïx la clau del teu curs:</label>
            <input type="password" id="clave" name="clave" autocomplete="new-password" required>
            <button type="submit">Accedir</button>
        </form>
    </div>
    <?php include 'footer.php'?>
</body>
</html>
<script>
  document.addEventListener("DOMContentLoaded", function() {
    document.querySelectorAll("input").forEach(function(input) {
      input.setAttribute("autocomplete", "off");
    });
  });
</script>