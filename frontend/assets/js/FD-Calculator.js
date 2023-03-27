function calculate() {
	const investment = document.getElementById("investment").value;
	const interest = document.getElementById("interest").value;
	const duration = document.getElementById("duration").value;

	const futureValue = investment * (1 + (interest / 100) * duration);
	// document.getElementById("futureValue").innerHTML = futureValue.toFixed(2);

    const returns = futureValue - investment;
    document.getElementById("returns").innerHTML = "Total Returns: " +returns.toFixed(2);

	const chart = document.getElementById("chart").getContext("2d");
	new Chart(chart, {
		type: "pie",
		data: {
			labels: ["Total Investment", "Total Returns"],
			datasets: [{
				data: [investment, returns],
				backgroundColor: ["#FF6384", "#36A2EB"]
			}]
		},
		options: {
			responsive: true
		}
	});
}
function updateMonthlyInvestment() {
    const investment = document.getElementById("investment").value;
    document.getElementById("monthly-investment-slider").value = investment;
}

function updateInterestRate() {
    const interest = document.getElementById("interest").value;
    document.getElementById("interest-rate-slider").value = interest;
}
function updateTimePeriod() {
	const timePeriodSlider = document.getElementById("time-period-slider");
	const duration = document.getElementById("duration");
	duration.value = timePeriodSlider.value;
  }
  

// Add event listeners to update input values and recalculate results and chart
const monthlyInvestmentSlider = document.getElementById('monthly-investment-slider');
monthlyInvestmentSlider.addEventListener('input', function updateMonthlyInvestment() {
    document.getElementById('investment').value = monthlyInvestmentSlider.value;
    // calculate();
});

const interestRateSlider = document.getElementById('interest-rate-slider');
interestRateSlider.addEventListener('input', function updateInterestRate() {
    document.getElementById('interest').value = interestRateSlider.value;
    // calculate();
});

const timePeriodSlider = document.getElementById('time-period-slider');
timePeriodSlider.addEventListener('input', function updateTimePeriod() {
    document.getElementById('duration').value = timePeriodSlider.value;
    calculate();
});

// Initialize input values and calculate results and chart on page load
document.getElementById('investment').value = monthlyInvestmentSlider.value;
document.getElementById('interest').value = interestRateSlider.value;
document.getElementById('duration').value = timePeriodSlider.value;
calculate();



calculate();
