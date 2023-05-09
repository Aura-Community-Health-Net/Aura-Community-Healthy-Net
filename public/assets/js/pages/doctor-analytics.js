const revenueChartCanvas = document.querySelector("#revenue-chart");
const appointmentCountCanvas = document.querySelector("#appointment-count-chart");
const dashboardRevenueChartCanvas = document.querySelector("#doctor-dashboard_revenue_analytics")

// const canvas = document.getElementById('revenue-chart');
// canvas.setAttribute('width', '100');
// const chart = new Chart(canvas, {...});
// chart.resize();

const doctorAnalyticsDropdown = document.querySelector("#doctor-analytics-dropdown");
let revenueChart, appointmentCountChart, dashboardRevenueChart;
async function getRevenueData(period = "this_month"){
    try{
        const result = await fetch(`/doctor-dashboard/analyticsRevenueChart?period=${period}`);
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
                    borderColor: 'rgb(153, 102, 255)',
                    backgroundColor: 'rgba(153, 102, 255, 0.2)',
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

async function getAppointmentCountData(period = "this_month"){
    try{
        const result = await fetch(`/doctor-dashboard/analyticsAppointmentCountChart?period=${period}`);
        const data = await result.json();
        console.log(data);
        const dates = data.map((d) => {
            return d.date;
        })
        const appointments = data.map((d) => {
            return Number(d.appointment_count);
        })
        console.log(dates)
        console.log(appointments)
        console.log(Chart)
        appointmentCountChart = new Chart(appointmentCountCanvas, {
            type: 'bar',
            data: {
                labels: dates,
                datasets: [{
                    label: 'Appointments',
                    data: appointments,
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


async function getDashboardRevenueData(period = "this_week"){
    try{
        const result = await fetch(`/doctor-dashboard/analyticsRevenueChart?period=${period}`);
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

        dashboardRevenueChart = new Chart(dashboardRevenueChartCanvas, {
            type: 'line',
            data: {
                labels: dates,
                datasets: [{
                    label: 'Revenue',
                    data: revenues,
                    borderColor: 'rgb(153, 102, 255)',
                    backgroundColor: 'rgba(153, 102, 255, 0.2)',
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
    await getAppointmentCountData();
    await getDashboardRevenueData();
})
doctorAnalyticsDropdown.addEventListener("change", async () => {
    if (revenueChart){
        revenueChart.destroy();
    }
    if (appointmentCountChart){
        appointmentCountChart.destroy();
    }
    await getRevenueData(doctorAnalyticsDropdown.value);
    await getAppointmentCountData(doctorAnalyticsDropdown.value);
})