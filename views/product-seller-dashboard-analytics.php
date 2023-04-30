<div class="product-seller-analytics__container">
    <canvas id="revenue-chart">

    </canvas>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.3.0/dist/chart.umd.min.js"></script>

<script>
    const revenueChartCanvas = document.querySelector("#revenue-chart");


    async function getRevenueData(){
        try{
            const result = await fetch("/product-seller-dashboard/analytics/revenue-chart?period=this_month");
            const data = await result.json();
            console.log(data)
            const dates = data.map((d) => {
                return d.date;
            })
            const revenues = data.map((d) => {
                return Number(d.revenue)/100;
            })
            console.log(dates)
            console.log(revenues)
            console.log(Chart)

            new Chart(revenueChartCanvas, {
                type: 'line',
                data: {
                    labels: dates,
                    datasets: [{
                        label: 'revenue',
                        data: revenues,
                        borderColor: 'rgb(20, 240, 60)',
                        backgroundColor: 'rgba(20, 240, 60, 0.5)',
                        fill: 'origin'
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
        } catch (e){
            console.log(e)
        }

    }
    window.addEventListener("load", async () => {
        await getRevenueData();
    })


</script>