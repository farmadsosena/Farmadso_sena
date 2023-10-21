// Puedes utilizar JavaScript para llenar los días en función del mes y el año seleccionados
const mesSelect = document.getElementById("mes");
const diaSelect = document.getElementById("dia");

mesSelect.addEventListener("change", function () {
	diaSelect.innerHTML = "";
	const selectedMonth = mesSelect.value;
	const selectedYear = document.getElementById("ano").value;
	if (selectedMonth && selectedYear) {
		const daysInMonth = new Date(selectedYear, new Date(selectedMonth).getMonth() + 1, 0).getDate();
		for (let i = 1; i <= daysInMonth; i++) {
			const option = document.createElement("option");
			option.value = i;
			option.textContent = i;
			diaSelect.appendChild(option);
		}
	}
});

  