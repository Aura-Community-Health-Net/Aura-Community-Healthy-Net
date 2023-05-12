const productRevenueChartCanvas = document.querySelector("#product-revenue-chart");
const orderCountCanvas = document.querySelector("#product-order-count-chart");
const productVsRevenueCanvas = document.querySelector("#product-vs-revenue-chart");
const productAnalyticsDropdown = document.querySelector("#product-analytics-dropdown");
let productRevenueChart, productOrderCountChart, productVsRevenueChart;
async function getRevenueData(period = "this_month"){
    try{
        const result = await fetch(`/product-seller-dashboard/analytics/revenue-chart?period=${period}`);
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

        productRevenueChart = new Chart(productRevenueChartCanvas, {
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

async function getOrderCountData(period = "this_month"){
    try{
        const result = await fetch(`/product-seller-dashboard/analytics/order-count-chart?period=${period}`);
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
        productOrderCountChart = new Chart(orderCountCanvas, {
            type: 'bar',
            data: {
                labels: dates,
                datasets: [{
                    label: 'Orders Count',
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

async function getProductVsRevenueData(period = "this_month"){
    try{
        const result = await fetch(`/product-seller-dashboard/analytics/product-vs-revenue-chart?period=${period}`);
        const data = await result.json();
        console.log(data);
        const products = data.map((d) => {
            return d.product_name;
        })
        const revenues = data.map((d) => {
            return Number(d.revenue)/100;
        })

        console.log(Chart)
        productVsRevenueChart = new Chart(productVsRevenueCanvas, {
            type: 'pie',
            data: {
                labels: products,
                datasets: [{
                    label: 'Products vs Revenue',
                    data: revenues,
                    // backgroundColor: ['rgb(255, 99, 132)', 'rgb(54, 162, 235)', 'rgb(255, 205, 86)', '#F9D949', '#00FFCA', '#00FFAB','#D21312', '#FCE22A', '#F56EB3', '#B2B2B2',],
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
    await getProductVsRevenueData();
})
productAnalyticsDropdown.addEventListener("change", async () => {
    if (productRevenueChart){
        productRevenueChart.destroy();
    }
    if (productOrderCountChart){
        productOrderCountChart.destroy();
    }
    if (productVsRevenueChart){
        productVsRevenueChart.destroy();
    }
    await getRevenueData(productAnalyticsDropdown.value);
    await getOrderCountData(productAnalyticsDropdown.value);
    await getProductVsRevenueData(productAnalyticsDropdown.value);
})