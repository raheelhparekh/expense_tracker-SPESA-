const expenseForm = document.getElementById('expense-form');
const categorySelect = document.getElementById('category');
const amountInput = document.getElementById('amount');
const noteInput = document.getElementById('note');
const pieChart = document.getElementById('pie-chart');

let expenses = {
  groceries: 0,
  utilities: 0,
  rent: 0,
  transportation: 0,
  entertainment: 0,
  other: 0
};

let chartData = {
  labels: Object.keys(expenses),
  datasets: [{
    data: Object.values(expenses),
    backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#8BC34A', '#9C27B0', '#607D8B']
  }]
};

expenseForm.addEventListener('submit', (event) => {
  event.preventDefault();

  const date = document.getElementById('date').value;
  const category = categorySelect.value;
  const amount = parseFloat(amountInput.value);
  const note = noteInput.value;

  expenses[category] += amount;

  // clear form inputs
  expenseForm.reset();

  updateChart();
});

function updateChart() {
  chartData.labels = Object.keys(expenses);
  chartData.datasets[0].data = Object.values(expenses);

  myPieChart.update();
}

let myPieChart;

window.onload = function() {
  const chartOptions = {
    responsive: true,
    maintainAspectRatio: true,
  };
  
  myPieChart = new Chart(pieChart, {
    type: 'pie',
    data: chartData,
    options: chartOptions
  });

  pieChart.style.width = '50px';
  pieChart.style.height = '50px';
};
