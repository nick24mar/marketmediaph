window.addEventListener('load', () => {
    
    const   urlParams   = new URLSearchParams(window.location.search),
            formData    = new FormData();

    const   productId   = urlParams.get('id');

    formData.append('p_id', productId);

    loadItem(formData);

    getElement('#btn_delete')
        .addEventListener('click', () => {
            if(confirm('Are you sure you want to delete this item?'))
                deleteItem(formData);
        });

    getElement('#btn_save')
        .addEventListener('click', () => {

            getAllElements('.form-control')
                .forEach(input => formData.append(input.name, input.value));

            updateItem(formData);

        })

    function loadItem(formBody) {
        fetch('functions/load_product.php', { method: 'POST', body: formBody })
            .then(res => res.json())
            .then(response => {
                if (response.length > 0) {
                    const controls = getElement('#controls');

                    if (controls.classList.contains('hide')) {
                        controls.classList.remove('hide');
                        controls.classList.add('show');
                    }

                    renderViewWithInput(response.product);
                    renderView(response.product);

                } else renderError(response);
            })
            .catch(error => console.log(error));
    }
    
    function deleteItem(formBody) {
        fetch('functions/remove_product.php', { method: 'POST', body: formBody})
            .then(res => res.json())
            .then(response => {
                renderMessage(response.message);
                getElement('#result').innerHTML = '';

                if (controls.classList.contains('show')) {
                    controls.classList.remove('show');
                    controls.classList.add('hide');
                }
            })
            .catch(error => console.log(error));
    }
    
    function updateItem(formBody) {
        fetch('functions/update_product.php', { method: 'POST', body: formBody })
            .then(res => res.json())
            .then(response => {
                renderView(response);
            })
            .catch(error => console.log(error));
    }

    function renderViewWithInput(response) {
        getElement('#updateForm')
            .querySelectorAll('.form-control')
                .forEach(input => {
                    switch(input.name) {
                        case 'p_name':
                            input.value = response.product_name
                            break;
                        case 'p_price':
                            input.value = response.product_price
                            break;
                        case 'p_desc':
                            input.value = response.product_description
                            break;
                    }
                });
    }
    
    function renderView(item) {
        getElement('#result')
            .innerHTML = `
                <h4>${item.product_name}</h4>
                <p>${item.product_description}</p>
            `;
    }

    function renderMessage(message) {
        getElement('.message')
            .innerHTML = `
                <div class="alert alert-success">
                    ${message}
                </div>
            `;
    }

    function renderError(response) {
        getElement('#result')
            .innerHTML = `
                <div class="alert alert-warning">
                    Ooops! something fishy. The page you requested is not available or maybe someone deleted it already.
                </div>
                <a href="market.php">go back</a>
            `;
    }
    
    function getElement(query) {
        return document.querySelector(query);
    }
    
    function getAllElements(query) {
        return document.querySelectorAll(query);
    }
});

