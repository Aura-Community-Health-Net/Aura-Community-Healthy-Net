const revenueRideChartCanvas = document.querySelector("#care-rider-revenue-chart");
const requestCountCanvas = document.querySelector("#care-rider-request-count-chart");
const careRiderAnalyticsDropdown = document.querySelector("#care-rider-analytics-dropdown");
// const careRiderAnalyticsDropdown = document.querySelector("#care-rider-analytics-dropdown");

let revenueRideChart,requestCountChart;

async function getRideRevenueData(){
    try{
        const result = await fetch("/care-rider-dashboard/analytics/revenue-chart?period=this_year");
        const data = await result.json();
        console.log(data)
        const dates = data.map((d)=> {
            return d.date;

        })
        const revenues = data.map((d)=> {
            return d.revenue;
        })

        revenueRideChart = new Chart(revenueRideChartCanvas, {
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


//count-bar-chart
async function getRequestCountData(period = "this_month"){
    try{
        const result = await fetch(`/care-rider-dashboard/analytics/request-count-chart?period=${period}`);
        const data = await result.json();
        console.log(data);
        const dates = data.map((d) => {
            return d.date;
        })
        const requests = data.map((d) => {
            return Number(d.request_count);
        })
        console.log(dates)
        console.log(requests)
        console.log(Chart)
        requestCountChart = new Chart(requestCountCanvas, {
            type: 'bar',
            data: {
                labels: dates,
                datasets: [{
                    label: 'requests',
                    data: requests,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgb(75, 192, 192)',
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

window.addEventListener("load",async () => {
    await getRideRevenueData();
})

    window.addEventListener("load",async ()=>{
    await getRequestCountData();

})

    careRiderAnalyticsDropdown.addEventListener("change",async ()=>{
        if(revenueRideChart){
            revenueRideChart.destroy();
        }
        await  getRideRevenueData(careRiderAnalyticsDropdown.value);

        if(requestCountChart){
            requestCountChart.destroy();
        }
        await getRequestCountData(careRiderAnalyticsDropdown.value);



})
