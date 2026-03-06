<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class CryptoController extends Controller
{
    public function index()
    {
        $symbols = ['BTC', 'ETH', 'USDT', 'BNB', 'XRP', 'SOL', 'USDC', 'DOGE', 'ADA'];


$infoResponse = Cache::remember('crypto_info', 86400, function () use ($symbols) {
    return Http::withHeaders([
        'X-CMC_PRO_API_KEY' => env('CMC_API_KEY'),
    ])->get(
        'https://pro-api.coinmarketcap.com/v2/cryptocurrency/info',
        [
            'symbol' => implode(',', $symbols)
        ]
    )->json();
});

$quoteResponse = Cache::remember('crypto_quotes', 60, function () use ($symbols) {
    return Http::withHeaders([
        'X-CMC_PRO_API_KEY' => env('CMC_API_KEY'),
    ])->get(
        'https://pro-api.coinmarketcap.com/v2/cryptocurrency/quotes/latest',
        [
            'symbol' => implode(',', $symbols),
            'convert' => 'USD'
        ]
    )->json();
});

        $result = [];

        foreach ($symbols as $symbol) {
            $info = collect($infoResponse['data'][$symbol])->first();
            $quote = $quoteResponse['data'][$symbol][0]['quote']['USD'];

            $result[] = [
                'name' => $info['name'],
                'symbol' => $symbol,
                'logo' => $info['logo'],
                'description' => $info['description'],

                'price' => round($quote['price'], 2),
                'percent_change_1h' => round($quote['percent_change_1h'], 2),
                'percent_change_24h' => round($quote['percent_change_24h'], 2),
                'volume_24h' => round($quote['volume_24h']),
                'market_cap' => round($quote['market_cap']),
            ];
        }

        return response()->json($result);
    }
}
