class Loader {

    start() {
        this.element = document.createElement('div');

        this.element.classList.add('loader');
        this.element.innerHTML = 'Loading';
        document.body.appendChild(this.element);

        return this;
    }

    stop(timeout = 200) {
        setTimeout(() => {
            document.body.removeChild(this.element);
        }, timeout);
    }
}
