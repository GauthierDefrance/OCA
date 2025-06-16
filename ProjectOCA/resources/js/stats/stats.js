function createCombinedChart(canvasId, periodLabel, dataKeys, colors) {
    const ctx = document.getElementById(canvasId)?.getContext('2d');
    if (!ctx) return;

    const labels = window.chartData[dataKeys[0]].labels;

    const datasets = dataKeys.map((key, index) => ({
        label: `${periodLabel[index]}`,
        data: window.chartData[key].data,
        borderColor: colors[index],
        fill: false,
        tension: 0.2,
    }));

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: datasets,
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                },
                x: {
                    ticks: {
                        maxRotation: 60,
                        minRotation: 45
                    }
                }
            }
        }
    });
}

document.addEventListener('DOMContentLoaded', function () {
    // Charts individuels déjà créés ici…

    // 🎯 Nouveau : graphique combiné par jour
    createCombinedChart(
        'combinedPerDayChart',
        [
            window.chartLabels.users_day,
            window.chartLabels.messages_day,
            window.chartLabels.conversations_day,
        ],
        ['usersPerDay', 'messagesPerDay', 'conversationsPerDay'],
        ['blue', 'green', 'orange']
    );

    // 🎯 Nouveau : graphique combiné par mois
    createCombinedChart(
        'combinedPerMonthChart',
        [
            window.chartLabels.users_month,
            window.chartLabels.messages_month,
            window.chartLabels.conversations_month,
        ],
        ['usersPerMonth', 'messagesPerMonth', 'conversationsPerMonth'],
        ['lightblue', 'lightgreen', 'gold']
    );
});
