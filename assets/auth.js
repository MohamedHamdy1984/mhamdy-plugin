document.addEventListener('DOMContentLoaded', function (e) {
    const showAuthBtn = document.getElementById('mhamdy-show-auth-form'),
        authContainer = document.getElementById('mhamdy-auth-container'),
        close = document.getElementById('mhamdy-auth-close'),
        authForm = document.getElementById('mhamdy-auth-form'),
        status = document.querySelector('[data-message="status"]');
    
    showAuthBtn.addEventListener('click', () => {
        authContainer.classList.add('show');        
        showAuthBtn.parentElement.classList.add('hide');
    });

    close.addEventListener('click', () => {
        authContainer.classList.remove('show');
        showAuthBtn.parentElement.classList.remove('hide');
    });

    authForm.addEventListener('submit', e => {
        e.preventDefault();

        resetMessages();

        let data = {
            name: authForm.querySelector('[name="username"]').value,
            password: authForm.querySelector('[name="password"]').value,
            nonce: authForm.querySelector('[name="mhamdy_auth"]').value
        }

        if( !data.name || !data.password ){
            status.innerHTML = "Missing data";
            status.classList.add('error');
            return;
        }

        let url = authForm.dataset.url;
        let params = new URLSearchParams(new FormData(authForm));

        authForm.querySelector('[name="submit"]').value = "Loggin in ...";
        authForm.querySelector('[name="submit"]').disabled = true;

        fetch(url, {
            method: "POST",
            body: params
        }).then(res => res.json())
            .catch(error => {
                resetMessages();
            })
            .then(response => {
                resetMessages();

                if(response === 0 || !response.status){
                    status.innerHTML = response.message;
                    status.classList.add('error');
                    return;
                }

                status.innerHTML = response.message;
                status.classList.add('success');

                authForm.reset();

                location.reload();
            })
    });

    function resetMessages(){
        status.innerHTML = "";
        status.classList.remove('success', 'error');

        authForm.querySelector('[name="submit"]').value = "Login";
        authForm.querySelector('[name="submit"]').disabled = false;
    }
});