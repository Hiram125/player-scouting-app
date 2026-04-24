<canvas id="goalsChart" width="400" height="200"></canvas>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const playerNames = @json($players->pluck('name'));
    const playerGoals = @json($players->pluck('goals'));
    const playerAssists = @json($players->pluck('assists'));

    const ctx = document.getElementById('goalsChart').getContext('2d');
    const myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: playerNames,
            datasets: [
                {
                    label: 'Goals',
                    data: playerGoals,
                    backgroundColor: 'rgba(54, 162, 235, 0.7)'
                },
                {
                    label: 'Assists',
                    data: playerAssists,
                    backgroundColor: 'rgba(255, 206, 86, 0.7)'
                }
            ]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>