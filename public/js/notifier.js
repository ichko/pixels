class Notifier {
    makeNotification(type, text, showTimeout = 200, duration = 2000) {
        setTimeout(() => {
            const element = document.createElement('div');
            element.classList.add('notification');
            element.classList.add(type);
            element.innerHTML = text;

            document.body.appendChild(element);

            setTimeout(() => {
                document.body.removeChild(element);
            }, duration)
        }, showTimeout);
    }

    success(text, duration) {
        this.makeNotification('success', text, duration);
    }

    error(text, duration) {
        this.makeNotification('error', text, duration);
    }
}
