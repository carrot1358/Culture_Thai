// JavaScript code to populate checkboxes based on the selected region

document.getElementById('north').addEventListener('click', function() {
    populateProvinces(['Province1', 'Province2', 'Province3']); // Replace with actual provinces for the North region
});

document.getElementById('central').addEventListener('click', function() {
    populateProvinces(['Province4', 'Province5', 'Province6']); // Replace with actual provinces for the Central region
});

document.getElementById('northeast').addEventListener('click', function() {
    populateProvinces(['Province7', 'Province8', 'Province9']); // Replace with actual provinces for the Northeast region
});

document.getElementById('south').addEventListener('click', function() {
    populateProvinces(['Province10', 'Province11', 'Province12']); // Replace with actual provinces for the South region
});

function populateProvinces(provinceArray) {
    const provinceCheckboxes = document.getElementById('provinceCheckboxes');
    provinceCheckboxes.innerHTML = ''; // Clear any existing checkboxes

    provinceArray.forEach(function(province) {
        const checkbox = document.createElement('input');
        checkbox.type = 'checkbox';
        checkbox.name = 'province[]';
        checkbox.value = province;
        checkbox.id = province.replace(/\s+/g, ''); // Remove spaces from province name for the ID

        const label = document.createElement('label');
        label.setAttribute('for', checkbox.id);
        label.innerText = province;

        const div = document.createElement('div');
        div.className = 'form-check';
        div.appendChild(checkbox);
        div.appendChild(label);

        provinceCheckboxes.appendChild(div);
    });
}
