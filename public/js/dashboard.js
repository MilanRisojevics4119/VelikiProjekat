let button = document.getElementById('editButton');
let partAppear = document.getElementById('editAppear');
let cancelButton = document.getElementById('cancelButton');

button.addEventListener('click', () => {
    partAppear.style.display = 'flex';
    cancelButton.style.display = 'flex';
    setTimeout(() => {
        partAppear.style.opacity = 1;
        cancelButton.style.opacity = 1;
    }, 200)
})

cancelButton.addEventListener('click', () => {
    partAppear.style.opacity = 0;
    partAppear.style.visibility = 0;
    setTimeout(() => {
        partAppear.style.display = 'none';
        cancelButton.style.display = 'none';
    }, 1200);
});