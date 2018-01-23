class Requester {
    constructor(baseUrl = '') {
        this.baseUrl = baseUrl;
    }

    get(serviceUrl) {
        return this.makeRequest('GET', this.getUrl(serviceUrl), null);
    }

    post(serviceUrl, data) {
        return this.makeRequest('POST', this.getUrl(serviceUrl), data);
    }

    getUrl(serviceUrl) {
        return `${this.baseUrl}/${serviceUrl}`;
    }

    makeRequest(type, url, data) {
        return new Promise((resolve, reject) => {
            const xhr = new XMLHttpRequest();
            xhr.open(type, url, true);
            xhr.setRequestHeaders("Content-type", "application/json");

            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    var json = JSON.parse(xhr.responseText);
                    resolve(json);
                }
            };

            xhr.send(JSON.stringify(data));
        });
    }
}
