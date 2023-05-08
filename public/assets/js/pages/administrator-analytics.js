const adminProductSellersRevenueChartCanvas = document.querySelector("#admin-product-seller-revenue-chart");
const administratorAnalyticsDropdown = document.querySelector("#administrator-analytics-dropdown");
let adminProductSellersRevenueChart;
async function getProductSellerRevenueData(period = "this_month"){
    try{
        const result = await fetch(`/admin-dashboard/analytics/product-sellers-revenue-chart?period=${period}`);
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

        adminProductSellersRevenueChart = new Chart(adminProductSellersRevenueChartCanvas, {
            type: 'line',
            data: {
                labels: dates,
                datasets: [{
                    label: 'Revenue',
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
    await getProductSellerRevenueData();
})
administratorAnalyticsDropdown.addEventListener("change", async () => {
    if (adminProductSellersRevenueChart){
        adminProductSellersRevenueChart.destroy();
    }
    await getProductSellerRevenueData(administratorAnalyticsDropdown.value);
})