function createGraph() {
    let seasonAverageElement = document.querySelector('.seasonAverage');
    if (seasonAverageElement) {
        let seasonAverageData = {
            pts: seasonAverageElement.getAttribute('pts'),
            ast: seasonAverageElement.getAttribute('ast'),
            turnover: seasonAverageElement.getAttribute('turnover'),
            pf: seasonAverageElement.getAttribute('pf'),
            fga: seasonAverageElement.getAttribute('fga'),
            fgm: seasonAverageElement.getAttribute('fgm'),
            fta: seasonAverageElement.getAttribute('fta'),
            ftm: seasonAverageElement.getAttribute('ftm'),
            reb: seasonAverageElement.getAttribute('reb'),
            stl: seasonAverageElement.getAttribute('stl'),
            blk: seasonAverageElement.getAttribute('blk')
        };

        console.log(seasonAverageData);

        const ctx = document.getElementById('myChart').getContext('2d');

        let labels = Object.keys(seasonAverageData);
        let data = Object.values(seasonAverageData);

        let existingChart = Chart.getChart('myChart');
        if (existingChart) {
            existingChart.destroy();
        } else {
            console.log("Cant find");
        }

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Season Average Stats',
                    data: data,
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    }
}

document.addEventListener('DOMContentLoaded', createGraph);
