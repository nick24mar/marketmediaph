
window.addEventListener('load', start);

function start() {
    let     currentState    = 0; //State for toggling back n fort the collapse

    const   urlParams       = new URLSearchParams(window.location.search),
            formData        = new FormData();

    const   productId = urlParams.get('id');

    formData.append('p_id', productId);

    loadProduct(formData)
        .then(p => {
            render(p);
            initializeView(currentState, formData);
        })
        .catch(error => console.log(error));

}

function loadProduct(formBody) {
    return new Promise((resolve, reject) => {

        fetch('functions/load_product.php', {method: 'POST', body: formBody})
            .then(res => res.text())
            .then(data => resolve(data))
            .catch(error => reject(error));

    });
}

function deleteProduct(formBody) {
    return new Promise((resolve, reject) => {

        fetch('functions/remove_product.php', {method: 'POST', body: formBody})
            .then(res => res.text())
            .then(data => resolve(data))
            .catch(error => reject(error));

    });
}

function updateProduct(formBody) {
    return new Promise((resolve, reject) => {

        fetch('functions/update_product.php', {method: 'POST', body: formBody})
        .then(res => res.text())
        .then(data => resolve(data))
        .catch(error => reject(error));

    });
}

function render(data) {
    const   resultView      = document.querySelector('#result');

    resultView.innerHTML = data;
}

function initializeView(currentState, formData) {
    const   btnUpdate   = getElement('#btnUpdate'),
            btnDelete   = getElement('#btnDelete'),
            btnClose    = getElement('#btnClose'),
            btnSubmit   = getElement('#btnSubmit'),
            prodDetails = getElement('.product-details'),
            collapseForm= getElement('#collapse-form'),
            updateForm  = getElement('#updateForm');

    if (btnUpdate) {
        btnUpdate.addEventListener('click', () => {
            currentState++;

            prodDetails.classList.add('collapse');

            if (currentState == 2) {
                prodDetails.classList.remove('collapse');
                currentState = 0;
            }
        });
    }
    
    if (btnClose) {
        btnClose.addEventListener('click', () => {
            currentState++;

            prodDetails.classList.add('collapse');

            if (currentState == 2) {
                prodDetails.classList.remove('collapse');
                currentState = 0;
            }
        });
    }
    
    if(btnDelete) {
        btnDelete.addEventListener('click', () => {
            if (confirm('You sure you wanna delete this product?')) {
                deleteProduct(formData)
                    .then(res => {
                        console.log(res)
                        console.log('redirecting to market...')
                        setTimeout(() => location.href = 'market.php', 1000)
                    })
                    .catch(error => console.log(error));
            }
        });
    }

    if (updateForm) {
        updateForm.addEventListener('submit', (e) => {
            e.preventDefault();

            const inputs = getAllElements('.form-control');

            inputs.forEach(input => formData.append(input.name, input.value));

            updateProduct(formData)
                .then(res => {
                    prodDetails.classList.remove('collapse');
                    collapseForm.classList.remove('show');
                    loadProduct(formData)
                        .then(res => {
                            console.log(res);
                            render(res);
                        })
                        .catch(error => console.log(error));
                })
                .catch(error => console.log(error));
        });
    }
}

function getElement(query) {
    return document.querySelector(query);
}

function getAllElements(query) {
    return document.querySelectorAll(query);
}