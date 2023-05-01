const revenueChartCanvas = document.querySelector("#revenue-chart");
const orderCountCanvas = document.querySelector("#order-count-chart");
const productVsRevenueCanvas = document.querySelector("#product-vs-revenue-chart");
const productAnalyticsDropdown = document.querySelector("#product-analytics-dropdown");
let revenueChart, orderCountChart, productVsRevenueChart;
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

        revenueChart = new Chart(revenueChartCanvas, {
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
        orderCountChart = new Chart(orderCountCanvas, {
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
                    label: 'Products',
                    data: revenues,
                    backgroundColor: ['#DC0000', '#3EC70B', '#FFB100', '#070A52', '#EB455F', '#00FFAB','#D21312', '#FCE22A', '#F56EB3', '#B2B2B2',],
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
    if (revenueChart){
        revenueChart.destroy();
    }
    if (orderCountChart){
        orderCountChart.destroy();
    }
    if (productVsRevenueChart){
        productVsRevenueChart.destroy();
    }
    await getRevenueData(productAnalyticsDropdown.value);
    await getOrderCountData(productAnalyticsDropdown.value);
    await getProductVsRevenueData(productAnalyticsDropdown.value);
})