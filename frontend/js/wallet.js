let income = 0;
let incomeCategory = '';

function setIncome() {
  const incomeAmountInput = document.getElementById('income-amount');
  const incomeCategoryInput = document.getElementById('income-category');
  
  income = parseFloat(incomeAmountInput.value);
  incomeCategory = incomeCategoryInput.value;
  
  incomeAmountInput.value = '';
  
  console.log(`Income set to ${income} in the ${incomeCategory} category`);
}

