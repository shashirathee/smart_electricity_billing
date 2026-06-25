function calculateBill() {
  const prev = parseFloat(document.getElementById("previous_reading")?.value) || 0;
  const curr = parseFloat(document.getElementById("current_reading")?.value) || 0;
  const rate = parseFloat(document.getElementById("unit_rate")?.value) || 0;

  let units = curr - prev;
  let amount = units * rate;

  if (units < 0) {
    units = 0;
    amount = 0;
  }

  const unitsBox = document.getElementById("units_consumed");
  const amountBox = document.getElementById("bill_amount");
  if (unitsBox) unitsBox.value = units.toFixed(2);
  if (amountBox) amountBox.value = amount.toFixed(2);
}

function calculateBillUpdate() {
  const prev = parseFloat(document.getElementById("u_previous")?.value) || 0;
  const curr = parseFloat(document.getElementById("u_current")?.value) || 0;
  const rate = parseFloat(document.getElementById("u_rate")?.value) || 0;

  let units = curr - prev;
  let amount = units * rate;

  if (units < 0) { units = 0; amount = 0; }

  const uUnits = document.getElementById("u_units");
  const uAmount = document.getElementById("u_amount");
  if (uUnits) uUnits.value = units.toFixed(2);
  if (uAmount) uAmount.value = amount.toFixed(2);
}
