function calculateSip() {
    const monthlyInvestment = parseInt(document.getElementById('monthly-investment').value);
    const interestRate = parseFloat(document.getElementById('interest-rate').value);
    const timePeriod = parseInt(document.getElementById('time-period').value);

    const monthlyInterestRate = (interestRate / 100) / 12;
    const totalMonths = timePeriod * 12;

    let futureValue = 0;
    for (let i = 0; i < totalMonths; i++) {
        futureValue += monthlyInvestment + (futureValue * monthlyInterestRate);
    }

    const totalInvestment = monthlyInvestment * totalMonths;
    const totalReturns = futureValue - totalInvestment;

    const result = `Total Investment: Rs. ${totalInvestment.toFixed(2)}<br>
                    Total Returns: Rs. ${totalReturns.toFixed(2)}<br>
                    Future Value: Rs. ${futureValue.toFixed(2)}`;

    document.getElementById("returns").innerHTML = result;

    const chartData = [totalInvestment, totalReturns];
    const chart = document.getElementById("chart").getContext("2d");
    if (window.sipChart) {
        window.sipChart.data.datasets[0].data = chartData;
        window.sipChart.update();
    } else {
        window.sipChart = new Chart(chart, {
            type: "pie",
            data: {
                labels: ["Total Investment", "Total Returns"],
                datasets: [{
                    data: chartData,
                    backgroundColor: ["#FF6384", "#36A2EB"]
                }]
            },
            options: {
                responsive: true
            }
        });
    }
}

// Add event listeners to update input values and recalculate results and chart
const monthlyInvestmentSlider = document.getElementById('monthly-investment-slider');
monthlyInvestmentSlider.addEventListener('input', function() {
    document.getElementById('monthly-investment').value = monthlyInvestmentSlider.value;
    calculateSip();
});

const interestRateSlider = document.getElementById('interest-rate-slider');
interestRateSlider.addEventListener('input', function() {
    document.getElementById('interest-rate').value = interestRateSlider.value;
    calculateSip();
});

const timePeriodSlider = document.getElementById('time-period-slider');
timePeriodSlider.addEventListener('input', function() {
    document.getElementById('time-period').value = timePeriodSlider.value;
    calculateSip();
});

// Initialize input values and calculate results and chart on page load
document.getElementById('monthly-investment').value = monthlyInvestmentSlider.value;
document.getElementById('interest-rate').value = interestRateSlider.value;
document.getElementById('time-period').value = timePeriodSlider.value;
calculateSip();
