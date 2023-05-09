const adminProductSellersRevenueChartCanvas = document.querySelector("#admin-product-seller-revenue-chart");
const administratorAnalyticsDropdown = document.querySelector("#administrator-analytics-dropdown");

const adminDoctorRevenueChartCanvas = document.querySelector("#admin-doctor-revenue-chart");

let adminProductSellersRevenueChart;
let adminDoctorRevenueChart;
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

async function getDoctorRevenueData(period = "this_month"){
    try{
        const result = await fetch(`/admin-dashboard/analytics/doctor-revenue-chart?period=${period}`);
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

        adminDoctorRevenueChart = new Chart(adminDoctorRevenueChartCanvas, {
            type: 'line',
            data: {
                labels: dates,
                datasets: [{
                    label: 'Revenue',
                    data: revenues,
                    borderColor: 'rgb(54, 162, 235)',
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
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
    await getDoctorRevenueData();
})
administratorAnalyticsDropdown.addEventListener("change", async () => {
    if (adminProductSellersRevenueChart){
        adminProductSellersRevenueChart.destroy();
    }
    if (adminDoctorRevenueChart){
        adminDoctorRevenueChart.destroy();
    }
    await getProductSellerRevenueData(administratorAnalyticsDropdown.value);
    await getDoctorRevenueData(administratorAnalyticsDropdown.value);
})