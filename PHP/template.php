
<!DOCTYPE html>
<html>
<head>
  <title>Meu Template</title>
  <style>
    /* Estilos CSS */
    body {
      font-family: Arial, sans-serif;
    }
    h1 {
      color: #333;
    }
    .content {
      padding: 20px;
      background-color: #f5f5f5;
    }
  </style>
</head>
<body>
  <div class="content">
    <h1>Bem-vindo(a) ao Meu Site</h1>
    
    <p><?php echo "Hoje é " . date('d/m/Y'); ?></p>
    
    <p><?php echo "Seja bem-vindo(a), " . $nome . "!"; ?></p>
  </div>
</body>
</html>