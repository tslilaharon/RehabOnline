let exerciseBox = document.getElementById('ex1');
let exerciseBox2 = document.getElementById('ex2');
let exerciseBox3 = document.getElementById('ex3');

fetch('./includes/exercises_list.json')
    .then(response => response.json())
    .then((data) => {
        data.forEach(element => {
            let option = document.createElement('option');
            option.innerHTML = element.ex_title;
            option.value = element.ex_id;
            exerciseBox.appendChild(option);
            exerciseBox2.appendChild(option.cloneNode(true));
            exerciseBox3.appendChild(option.cloneNode(true));
        });        
    }
)