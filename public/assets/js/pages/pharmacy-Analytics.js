const medRevenueChartCanvas = document.querySelector("#revenue-chart");
const medOrderCountCanvas = document.querySelector("#order-count-chart");
const medicineVsRevenueCanvas = document.querySelector("#medicine-vs-revenue-chart");
const medicineAnalyticsDropdown = document.querySelector("#pharmacy-analytics-dropdown");

let medRevenueChart,medOrderCountChart,medicineVsRevenueChart;


async function getMedOrderCountData(){

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




async function getMedicineVsRevenueData(){

}









window.addEventListener("load",async ()=>{
    await getMedRevenueData();
    await getMedOrderCountData();
    await getMedicineVsRevenueData();

})

medicineAnalyticsDropdown.addEventListener("change",async ()=>{
    if(medRevenueChart){
        medRevenueChart.destroy();
    }

    if(medOrderCountChart){
        medOrderCountChart.destroy();
    }
    if(medicineVsRevenueChart){
        medicineVsRevenueChart.destroy();
    }

    await  getMedRevenueData(medicineAnalyticsDropdown.value);
    await getMedOrderCountData(medicineAnalyticsDropdown.value);
    await getMedicineVsRevenueData(medicineAnalyticsDropdown.value);
})


