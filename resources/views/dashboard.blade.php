<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Reto Crypto</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
</head>

<body class="flex flex-col items-center justify-center min-h-screen gap-6 bg-gray-100">
    <h1 class="text-2xl font-bold text-center bg-blue-400 w-full p-4">
    Reto Crypto
</h1>
    
    <input type="text" id="searchCrypto" placeholder="Buscar criptomoneda..." 
           class="p-2 w-[300px] border border-gray-300 rounded">

    <canvas id="cryptoChart" width="400" height="200" class="max-w-full"></canvas>
    
    <div id="crypto-list"></div>

    <script src="/js/crypto-chart.js"></script>
</body>

</html>