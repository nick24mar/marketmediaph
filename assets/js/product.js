
window.addEventListener('load', () => {

    const   urlParams   = new URLSearchParams(window.location.search),
            formData    = new FormData();

    const   btnUpdate   = document.querySelector('#btnUpdate'),
            btnDelete   = document.querySelector('#btnDelete'),
            btnClose    = document.querySelector('#btnClose'),
            prodDetails = document.querySelector('.product-details'),
            updateForm  = document.querySelector('#updateForm');

    let     currentState = 0;
    
    const id = urlParams.get('id');
    formData.append('p_id', id);

    if(btnDelete) {
        btnDelete.addEventListener('click', () => {
            if (confirm('You sure you wanna delete this product?')) {
                deleteItem(formData);
            }
        });
    }
    
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

    if (updateForm) {
        updateForm.addEventListener('submit', (e) => {
            e.preventDefault();
    
            const inputs = updateForm.querySelectorAll('.form-control');
    
            inputs.forEach(input => {
                formData.append(input.name, input.value);
            });
    
            updateItem(formData);
        });
    }
    
    function updateItem(formBody) {

        fetch('functions/update_product.php', {method: 'POST', body: formBody})
            .then(res => res.text())
            .then(data => {
                location.href = 'product.php?update=success';
                console.log(data);
            })
            .catch(error => console.log(error));

    }

    function deleteItem(id) {

        fetch('functions/remove_product.php', {method: 'POST', body: id})
            .then(res => res.text())
            .then(data => {
                location.href = 'product.php?delete=success';
                console.log(data);
            })
            .catch(error => console.log(error));

    }

});