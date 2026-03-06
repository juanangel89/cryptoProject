let allCrypto = [];

async function loadCryptoData() {
    try {
        const response = await fetch("/api/crypto");
        allCrypto = await response.json();

        renderCrypto(allCrypto);
    } catch (error) {
        console.error(error);
    }
}

function renderCrypto(data) {
    const labels = data.map((coin) => coin.symbol);
    const prices = data.map((coin) => coin.price);
    const percentChange24h = data.map((coin) => coin.percent_change_24h);

    const ctx = document.getElementById("cryptoChart");

    if (window.cryptoChart instanceof Chart) {
        window.cryptoChart.destroy();
    }

    window.cryptoChart = new Chart(ctx, {
        data: {
            labels,
            datasets: [
                {
                    type: "line",
                    label: "Precio USD",
                    data: prices,
                    borderColor: "blue",
                    backgroundColor: "rgba(0,0,255,0.1)",
                    yAxisID: "y-price",
                    tension: 0.2,
                    fill: true,
                },
                {
                    type: "bar",
                    label: "% Cambio 24h",
                    data: percentChange24h,
                    backgroundColor: percentChange24h.map((pc) =>
                        pc >= 0 ? "green" : "red",
                    ),
                    yAxisID: "y-percent",
                },
            ],
        },
        options: {
            responsive: true,
            interaction: { mode: "index", intersect: false },
            stacked: false,
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function (context) {
                            const coin = data[context.dataIndex];
                            return [
                                `💲 Precio: $${coin.price.toLocaleString()}`,
                                `📈 24h: ${coin.percent_change_24h}%`,
                                `🔁 Volumen 24h: $${coin.volume_24h.toLocaleString()}`,
                                `🏦 Market Cap: $${coin.market_cap.toLocaleString()}`,
                            ];
                        },
                    },
                },
                legend: { position: "top" },
            },
            scales: {
                "y-price": {
                    type: "linear",
                    position: "left",
                    title: { display: true, text: "Precio USD" },
                },
                "y-percent": {
                    type: "linear",
                    position: "right",
                    title: { display: true, text: "% Cambio 24h" },
                    grid: { drawOnChartArea: false },
                },
            },
        },
    });

    const container = document.getElementById("crypto-list");
    container.innerHTML = "";

    data.forEach((coin) => {
        container.innerHTML += `
            <div class="crypto-item" style="border:1px solid #ccc; padding:10px; margin:10px; border-radius:6px; display:flex; align-items:center;">
                <img src="${coin.logo}" width="40" style="margin-right:10px;">
                <div>
                    <h3 style="margin:0;">${coin.name} (${coin.symbol})</h3>
                    <p style="margin:0;">💲 $${coin.price.toLocaleString()}</p>
                    <p style="margin:0;">📈 ${coin.percent_change_24h}%</p>
                    <p style="margin:0;">🔁 $${coin.volume_24h.toLocaleString()}</p>
                    <p style="margin:0;">🏦 $${coin.market_cap.toLocaleString()}</p>
                </div>
            </div>
        `;
    });
}

document.getElementById("searchCrypto").addEventListener("input", (e) => {
    const term = e.target.value.toLowerCase();

    const filtered = allCrypto.filter(
        (coin) =>
            coin.name.toLowerCase().includes(term) ||
            coin.symbol.toLowerCase().includes(term),
    );

    renderCrypto(filtered);
});


loadCryptoData();


setInterval(loadCryptoData, 60000);
