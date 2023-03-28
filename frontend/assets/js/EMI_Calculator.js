function calculateEMI() {
    var loanAmount = document.getElementById("loanAmount").value;
    var interestRate = document.getElementById("interestRate").value;
    var loanTerm = document.getElementById("loanTerm").value;

    var monthlyInterestRate = interestRate / 12 / 100;
    var totalInterest = monthlyInterestRate * loanAmount * loanTerm;
    var totalAmount = parseFloat(loanAmount) + totalInterest;
    var monthlyEMI = totalAmount / loanTerm;

    var result = document.getElementById("result");
    result.innerHTML =
      "Your monthly EMI is Rs. " + monthlyEMI.toFixed(2) + "<br><br>";
    result.innerHTML +=
      "Total interest payable is Rs. " + totalInterest.toFixed(2) + "<br>";
    result.innerHTML +=
      "Total amount payable is Rs. " + totalAmount.toFixed(2);
    
    const chart = document.getElementById("chart").getContext("2d");
    new Chart(chart, {
        type: "pie",
        data: {
            labels: ["Received Amount", "Total Intrest", "Payable Amount"],
            datasets: [{
                data: [loanAmount, totalInterest, totalAmount],
                backgroundColor: ["#FF6384", "#36A2EB", "#FFCE56"]
            }]
        },
        options: {
            responsive: true
        }
    });
    }
    
function updateMonthlyInvestment() {
    const investment = document.getElementById("loanAmount").value;
    document.getElementById("loan-amount-slider").value = investment;
}

function updateInterestRate() {
    const interest = document.getElementById("interestRate").value;
    document.getElementById("interest-rate-slider").value = interest;
}
function updateTimePeriod() {
	const timePeriodSlider = document.getElementById("time-period-slider");
	const duration = document.getElementById("loanTerm");
	duration.value = timePeriodSlider.value;
  }
  
  // Add event listeners to update input values and recalculate results and chart
const monthlyInvestmentSlider = document.getElementById('loan-amount-slider');
monthlyInvestmentSlider.addEventListener('input', function updateMonthlyInvestment() {
    document.getElementById('loanAmount').value = monthlyInvestmentSlider.value;
    // calculate();
});

const interestRateSlider = document.getElementById('interest-rate-slider');
interestRateSlider.addEventListener('input', function updateInterestRate() {
    document.getElementById('interestRate').value = interestRateSlider.value;
    // calculate();
});

const timePeriodSlider = document.getElementById('time-period-slider');
timePeriodSlider.addEventListener('input', function updateTimePeriod() {
    document.getElementById('loanTerm').value = timePeriodSlider.value;
    calculate();
});

// Initialize input values and calculate results and chart on page load
document.getElementById('loanAmount').value = monthlyInvestmentSlider.value;
document.getElementById('interestRate').value = interestRateSlider.value;
document.getElementById('loanTerm').value = timePeriodSlider.value;
calculate();


calculate();



