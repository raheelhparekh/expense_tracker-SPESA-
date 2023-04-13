function calculate() {
	var amount = document.getElementById("amount").value;
	var gst = document.getElementById("gst").value;
	var result = (amount * gst) / 100;
	document.getElementById("result").value = result;
}
