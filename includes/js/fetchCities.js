let addressBox = document.getElementById('address');

fetch('./includes/israel-cities.json')
    .then(response => response.json())
    .then((data) => {
        data.forEach(element => {
            let option = document.createElement('option');
            option.innerHTML = element.engName + " - " + element.name;
            option.value = element.id;
            addressBox.appendChild(option);
        });        
    }
)



