editBtn.addEventListener('click', () => {
    const editable = document.querySelectorAll('.show');
    if (editable.length > 0) { // if there is something to edit
        window.location = './edit.php';    // go to edit page

    }
    else {
        return;
    }
    
});