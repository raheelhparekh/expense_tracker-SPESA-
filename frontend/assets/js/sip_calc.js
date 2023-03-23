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

    const chart = document.getElementById("chart").getContext("2d");
	new Chart(chart, {
		type: "bar",
		data: {
			labels: ["Total Investment", "Total Returns"],
			datasets: [{
				data: [totalInvestment, totalReturns],
				backgroundColor: ["#FF6384", "#36A2EB"]
			}]
		},
		options: {
			responsive: true
		}
	});

}