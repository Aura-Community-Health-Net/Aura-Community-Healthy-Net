const adminProductSellersRevenueChartCanvas = document.querySelector("#admin-product-seller-revenue-chart");
const administratorAnalyticsDropdown = document.querySelector("#administrator-analytics-dropdown");
const adminPharmaciesRevenueChartCanvas = document.querySelector("#admin-pharmacy-revenue-chart");
const adminDoctorRevenueChartCanvas = document.querySelector("#admin-doctor-revenue-chart");
const adminCareRiderRevenueChartCanvas = document.querySelector("#admin-care-rider-revenue-chart");
let adminProductSellersRevenueChart,adminPharmacyRevenueChart;
let adminDoctorRevenueChart,adminCareRiderRevenueChart;

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
                    label: 'Product Sellers Revenue',
                    data: revenues,
                    borderColor: 'rgb(249, 217, 73)',
                    backgroundColor: 'rgba(249, 217, 73, 0.5)',
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
                    label: 'Pharmacy Revenue',
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
                    label: 'Doctors Revenue',
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

async function getCareRiderRevenueChartData(){
    try{
        const result = await fetch("/admin-dashboard/analytics/care-rider-revenue-chart?period=this_year");
        const data = await result.json();
        console.log(data)
        const dates = data.map((d)=> {
            return d.date;

        })
        const revenues = data.map((d)=> {
            return d.revenue;
        })

        adminCareRiderRevenueChart = new Chart(adminCareRiderRevenueChartCanvas, {
            type: 'line',
            data: {
                labels: dates,
                datasets: [{
                    label: 'Care Riders Revenue',
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
    await getDoctorRevenueData();
    await getPharmacyRevenueData();
    await getCareRiderRevenueChartData();
})
administratorAnalyticsDropdown.addEventListener("change", async () => {
    if (adminProductSellersRevenueChart){
        adminProductSellersRevenueChart.destroy();
    }
    if (adminDoctorRevenueChart){
        adminDoctorRevenueChart.destroy();
    }
  
    if(adminPharmacyRevenueChart){
        adminPharmacyRevenueChart.destroy();
    }


    if( adminCareRiderRevenueChart){
        adminCareRiderRevenueChart.destroy();
    }
    await getProductSellerRevenueData(administratorAnalyticsDropdown.value);
    await getDoctorRevenueData(administratorAnalyticsDropdown.value);    
    await getPharmacyRevenueData(administratorAnalyticsDropdown.value);
    await getDoctorRevenueData(administratorAnalyticsDropdown.value);
})

