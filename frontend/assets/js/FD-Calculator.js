function calculate() {
	const investment = document.getElementById("investment").value;
	const interest = document.getElementById("interest").value;
	const duration = document.getElementById("duration").value;

	const returns = investment * (1 + (interest / 100) * duration);
	document.getElementById("returns").innerHTML = returns.toFixed(2);

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
