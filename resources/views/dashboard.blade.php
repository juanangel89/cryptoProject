<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Reto Crypto</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
</head>

<body>
    <h1>Reto Crypto</h1>
    
    <input type="text" id="searchCrypto" placeholder="Buscar criptomoneda..." style="padding:8px; width:300px; margin-bottom:20px;">
    <canvas id="cryptoChart" width="400" height="200"></canvas>
    <script src="/js/crypto-chart.js"></script>
    <div id="crypto-list"></div>
</body>

</html>