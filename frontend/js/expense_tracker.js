// Get the form elements

const incomeForm = document.getElementsByTagName('form')[0];
const expenditureForm = document.getElementsByTagName('form')[1];
const incomeRange = document.getElementById('incomeRange');
const expensesRange = document.getElementById('expensesRange');
const incomeOutput = document.getElementById('incomeOutput');
const expensesOutput = document.getElementById('expensesOutput');

// Add event listener to income range slider
incomeRange.addEventListener('input', () => {
    incomeOutput.textContent = `$${incomeRange.value}`;
});

// Add event listener to expenditure range slider
expensesRange.addEventListener('input', () => {
    expensesOutput.textContent = `$${expensesRange.value}`;
});


// Get the canvas elements
// Get the canvas elements
const pieChartCanvas = document.getElementById('pie-chart');
const barChartCanvas = document.getElementById('bar-chart');

// Initialize the chart data
let incomeTotal = 0;
let expensesTotal = 0;
let categoryLabels = [];
let categoryAmounts = [];

// Create the pie chart object
const pieChart = new Chart(pieChartCanvas, {
    type: 'pie',
    data: {
        labels: ['Income', 'Expenses'],
        datasets: [{
            label: 'Budget',
            data: [incomeTotal, expensesTotal],
            backgroundColor: ['#007bff', '#dc3545']
        }]
    }
});

// Create the bar chart object
const barChart = new Chart(barChartCanvas, {
    type: 'bar',
    data: {
        labels: categoryLabels,
        datasets: [{
            label: 'Expenses',
            data: categoryAmounts,
            backgroundColor: ['#007bff', '#dc3545', '#28a745', '#ffc107', '#6c757d']
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});

// Add event listener to income form submit button
incomeForm.addEventListener('submit', (event) => {
    event.preventDefault();

    // Get the input values
    const category = document.getElementById('income-category').value;
    const amount = parseInt(incomeRange.value);

    // Add income data to total
    incomeTotal += amount;

    // Update the chart data
    pieChart.data.datasets[0].data[0] = incomeTotal;
    pieChart.update();

    // Add category label and amount to arrays
    categoryLabels.push(category);
    categoryAmounts.push(amount);

    // Update the bar chart data
    barChart.data.labels = categoryLabels;
    barChart.data.datasets[0].data = categoryAmounts;
    barChart.update();

    // Reset the form
    incomeForm.reset();
    incomeOutput.textContent = '$0';
});

// Add event listener to expenditure form submit button
expenditureForm.addEventListener('submit', (event) => {
    event.preventDefault();

    // Get the input values
    const category = document.getElementById('expenditure-category').value;
    const amount = parseInt(expenditureRange.value);

    // Add expenditure data to total
    expensesTotal += amount;

    // Update the chart data
    pieChart.data.datasets[0].data[1] = expensesTotal;
    pieChart.update();

    // Add category label and amount to arrays
    categoryLabels.push(category);
    categoryAmounts.push(amount);

    // Update the bar chart data
    barChart.data.labels = categoryLabels;
    barChart.data.datasets[0].data = categoryAmounts;
    barChart.update();

    // Reset the form
    expenditureForm.reset();
    expenditureOutput.textContent = '$0';
});