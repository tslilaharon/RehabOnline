window.onload = () => {
    showData();
    makeSelected();
};

function makeSelected() {
    const selectObj = document.querySelector('#treatExercise');
    ind = selectObj.dataset.selected;
    console.log(ind);
    selectObj.options[ind - 1].selected = true;
}

function showData(data) {

	for (const key in data.exercises){
        console.log(data.exercises[key].ex_title);
	} 
}

fetch("../exercises.json")
	.then(response => response.json())
	.then(data => showData(data));