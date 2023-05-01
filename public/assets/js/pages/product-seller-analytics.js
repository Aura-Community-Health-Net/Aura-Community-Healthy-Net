const revenueChartCanvas = document.querySelector("#revenue-chart");
const orderCountCanvas = document.querySelector("#order-count-chart");

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

async function getOrderCountData(){
    try{
        const result = await fetch("/product-seller-dashboard/analytics/order-count-chart?period=all_time");
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
        new Chart(orderCountCanvas, {
            type: 'bar',
            data: {
                labels: dates,
                datasets: [{
                    label: 'Orders',
                    data: orders,
                    backgroundColor: 'rgba(30, 40, 200, 0.5)',
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
window.addEventListener("load", async () => {
    await getRevenueData();
    await getOrderCountData();
})