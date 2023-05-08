const adminProductSellersRevenueChartCanvas = document.querySelector("#admin-product-seller-revenue-chart");
const administratorAnalyticsDropdown = document.querySelector("#administrator-analytics-dropdown");
const adminPharmaciesRevenueChartCanvas = document.querySelector("#admin-pharmacy-revenue-chart")
let adminProductSellersRevenueChart,adminPharmacyRevenueChart;
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
                    borderColor: 'rgb(252, 79, 0)',
                    backgroundColor: 'rgba(252, 79, 0, 0.5)',
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



async function getPharmacyRevenueData(period = "this_month"){
    try{
        const result = await fetch(`/admin-dashboard/analytics/pharmacy-revenue-chart?period=${period}`);
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

        adminPharmacyRevenueChart = new Chart(adminPharmaciesRevenueChartCanvas, {
            type: 'line',
            data: {
                labels: dates,
                datasets: [{
                    label: 'Revenue',
                    data: revenues,
                    borderColor: 'rgb(252, 79, 0)',
                    backgroundColor: 'rgba(252, 79, 0, 0.5)',
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
    await getPharmacyRevenueData();
})
administratorAnalyticsDropdown.addEventListener("change", async () => {
    if (adminProductSellersRevenueChart){
        adminProductSellersRevenueChart.destroy();
    }
    await getProductSellerRevenueData(administratorAnalyticsDropdown.value);

    if(adminPharmacyRevenueChart){
        adminPharmacyRevenueChart.destroy();
    }
    await getPharmacyRevenueData(administratorAnalyticsDropdown.value);
})









