const COLORS = {
    success: '#42ba96',
    warning: '#ffcc00',
    error: '#cc3300',
}
const URL = "http://0.0.0.0:8087";

class Popup {
    constructor(title, text, type = 'success') {
        this.title = title;
        this.text = text;
        this.color = COLORS[type];
    }

    setTitle(title) {
        this.title = title;
    }

    setText(text) {
        this.text = text;
    }

    setColor(color) {
        this.color = COLORS[color];
    }

    notify(time = 10000) {
        this.createHtmlElement()
        this.show();
        setTimeout(() => this.hide(), time)
    }

    createHtmlElement() {
        const notifyContainer = document.getElementById('notify-container');
        this.notificationDiv = document.createElement('div');

        this.notificationDiv.id = 'notify';
        this.notificationDiv.style.position = 'absolute';
        this.notificationDiv.style.top = '0';
        this.notificationDiv.style.left = 'calc(100% - 22.5vh)';
        this.notificationDiv.style.background = this.color;
        this.notificationDiv.style.width = '200px';
        this.notificationDiv.style.height = '130px';
        this.notificationDiv.style.zIndex = '10';
        this.notificationDiv.style.borderRadius = '15px'
        this.notificationDiv.style.padding = '10px';
        this.notificationDiv.style.opacity = '0';
        this.notificationDiv.style.textAlign = 'center';
        this.notificationDiv.style.transition = 'opacity 900ms';
        this.notificationDiv.innerHTML = `<h4>${this.title}</h4> <h6>${this.text}</h6>`
        notifyContainer.appendChild(this.notificationDiv);
    }

    removeHtmlElement() {
        this.notificationDiv.remove()
    }

    show() {
        this.notificationDiv.style.opacity = '0.9';
    }

    hide() {
        this.notificationDiv.style.opacity = '0';
        setTimeout(() => this.removeHtmlElement(), 1000)
    }
}

let popup = new Popup('Успешно', 'Вы успешно зарегистрировались');

const formElement = document.getElementById('register-form');
if (formElement !== null) {
    formElement.addEventListener('submit', async (e) => {
        e.preventDefault();
        const formData = new FormData(formElement);

        let data = await fetch("/register", {
            body: formData,
            method: 'post',
        })
        let jsonData = await data.json();
        if (parseInt(jsonData.status) === 500) {
            popup.setText(jsonData.message)
            popup.setTitle('Ошибка')
            popup.setColor('error')
            popup.notify(1000);
        } else {
            popup.setText(jsonData.message)
            popup.setTitle('Успешно')
            popup.setColor('success')
            await popup.notify(1000);

            window.location.replace(`${URL}/login`);
        }

    })
}

const formLoginElement = document.getElementById('login-form');

if (formLoginElement !== null) {
    formLoginElement.addEventListener('submit', async (e) => {
        e.preventDefault();
        const formData = new FormData(formLoginElement);

        let data = await fetch("/login", {
            body: formData,
            method: 'post',
        })
        let jsonData = await data.json();
        if (parseInt(jsonData.status) === 500) {
            popup.setText(jsonData.message)
            popup.setTitle('Ошибка')
            popup.setColor('error')
            popup.notify(1000);
        } else {
            popup.setText(jsonData.message)
            popup.setTitle('Успешно')
            popup.setColor('success')
            await popup.notify(1000);

            window.location.replace(`${URL}/profile`);
        }

    })
}


