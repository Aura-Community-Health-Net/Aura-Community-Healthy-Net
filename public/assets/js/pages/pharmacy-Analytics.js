const medRevenueChartCanvas = document.querySelector("#revenue-chart");
const medOrderCountCanvas = document.querySelector("#order-count-chart");
// const medicineVsRevenueCanvas = document.querySelector("#medicine-vs-revenue-chart");
const medicineAnalyticsDropdown = document.querySelector("#medicine-analytics-dropdown");

let medRevenueChart,medOrderCountChart,medicineVsRevenueChart;


async function getMedOrderCountData(period="this_month"){

    try{
        const result = await fetch(`/pharmacy-dashboard/analytics/order-count-chart?period=${period}`);
        const data = await result.json();
        console.log(data);
        const dates = data.map((d) => {
            return d.date;
        })
        const orders = data.map((d) => {
            return Number(d.order_count);
        })
        console.log(dates)
        console.log(orders)
        console.log(Chart)

        medOrderCountChart = new Chart(medOrderCountCanvas, {
            type: 'bar',
            data: {
                labels: dates,
                datasets: [{
                    label: 'Orders',
                    data: orders,
                    backgroundColor: '#F7D716',
                    borderColor: 'rgb(30, 40, 200)',
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





async  function getMedRevenueData(period="this_month"){
    try{

        const result = await fetch(`/pharmacy-dashboard/analytics/revenue-chart?period=${period}`);
        const data = await result.json();
        console.log(data)
        const dates = data.map((d)=> {
            return d.date;
        })

        const revenues = data.map((d)=>{
            return Number(d.revenue)/100;
        })
        console.log(dates)
        console.log(revenues)
        console.log(Chart)

        medRevenueChart = new Chart(medRevenueChartCanvas, {
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

    }catch (e){
        console.log(e)
    }
}



//
// async function getMedicineVsRevenueData(){
//
// }









window.addEventListener("load",async ()=>{
    await getMedRevenueData();


})

window.addEventListener("load",async ()=>{
    await getMedOrderCountData();

})

medicineAnalyticsDropdown.addEventListener("change",async ()=>{
    if(medRevenueChart){
        medRevenueChart.destroy();
    }
    await  getMedRevenueData(medicineAnalyticsDropdown.value);

    if(medOrderCountChart){
        medOrderCountChart.destroy();
    }
    await getMedOrderCountData(medicineAnalyticsDropdown.value);

    // if(medicineVsRevenueChart){
    //     medicineVsRevenueChart.destroy();
    // }
    //
    // await getMedicineVsRevenueData(medicineAnalyticsDropdown.value);
})


