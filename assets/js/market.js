window.addEventListener('load', () => {
    const   productsDiv     = document.querySelector('#products'),
            btnPost     = document.querySelector('#btn_post'),
            inputs          = document.querySelectorAll('.form-control')

    let     formData        = new FormData()

    fetchProducts()

    btnPost.addEventListener('click', () => {

        inputs.forEach(input => {
            if (input.value)
                formData.append(input.name, input.value)
        })
        
        addProduct(formData)
    })

    function fetchProducts() {

        fetch('functions/load_all_products.php', {
                method: 'get'
            })
            .then(res => {
                if (res.status === 200)
                    return res.text()
            })
            .then(products => productsDiv.innerHTML = products)
            .catch(err => console.log(`An error occured: ${err}`))

    }

    function addProduct(item) {

        fetch('functions/insert_product.php', {
                method: 'POST',
                body: item
            })
            .then(res => {
                if (res.status === 200)
                    return res.text()
            })
            .then(data => {
                console.log(data)
                fetchProducts()
                
                inputs.forEach(input => input.value = null);
            })
            .catch(err => console.log(`Something went wrong : ${err}`))
    }

})