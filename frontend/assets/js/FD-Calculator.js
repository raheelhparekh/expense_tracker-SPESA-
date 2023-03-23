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



calculate();
