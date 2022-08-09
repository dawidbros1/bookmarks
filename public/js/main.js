function initCloseAlertButtons() {
    var buttons = document.getElementsByClassName('close-button');

    for (let i = 0; i < buttons.length; i++) {
        buttons[i].addEventListener('click', () => {
            alert = document.getElementsByClassName('message-alert')[i];
            alert.classList.add('d-none');
        })
    }
}

function initDeleteButton() {
    index = 1;
    values = ['USUŃ', "UKRYJ"];
    button = document.getElementById('delete');

    button.addEventListener('click', () => {
        button.innerHTML = values[index++ % 2];
    });
}

function copyToClipBoard(element) {
    navigator.clipboard.writeText(element.dataset.link);
}