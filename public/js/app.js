class App {
    #form = document.getElementById('form');
    #input = document.querySelector('input[type="text"]');
    #result = document.getElementById('result');
    #link = document.getElementById('link');
    #error = document.getElementById('error');
    #csrf = document.querySelector('[name="_token"]');
    #copyBtn = document.getElementById('copy');

    observe = () => {
        this.#form.addEventListener('submit', (e) => {
            e.preventDefault();
            this.#send();
        });

        this.#input.addEventListener('focus', () => {
            this.#reset();
        });

        this.#copyBtn.addEventListener('click', async () => {
            await this.#copy();
        });
    }

    #send = () => {
        let options = {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': this.#csrf.value
            },
            body: JSON.stringify({ url: this.#input.value })
        };

        fetch(this.#form.action, options)
            .then(response => {
                if (!response.ok) {
                    this.#showError();
                    throw new Error('Request failed');
                }
                return response.json();
            })
            .then(data => {
                this.#showSuccess(data);
            })
            .catch(error => {
                this.#showError();
            });
    }

    #showError = (message = 'Something went wrong. Try again.') => {
        this.#reset();
        this.#error.innerText = message;
        this.#error.classList.add('show');
    }

    #showSuccess = (data) => {
        this.#reset();
        this.#link.innerText = data.hash;
        this.#result.classList.add('show');
    }

    #reset = () => {
        this.#input.value = '';
        this.#error.classList.remove('show');
        this.#result.classList.remove('show');
    }

    #copy = async () => {
        await navigator.clipboard.writeText(this.#link.innerText);
    }
}

(new App()).observe();
