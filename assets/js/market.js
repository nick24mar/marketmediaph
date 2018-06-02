window.addEventListener('load', () => {

    fetchItems();

    const formData = new FormData();
    const inputs = getElement('#newItemForm').querySelectorAll('.form-control');

    getElement('#btn_post')
        .addEventListener('click', () => {
            inputs.forEach(input => formData.append(input.name, input.value));
            addItem(formData);
        });


});


function fetchItems() {

    fetch('controllers/load_products.php', {method: 'GET'})
        .then(res => res.json())
        .then(response => {
            if(response.length > 0) {
                if(response.items) 
                    getElement('#results').innerHTML = '';

                response.items.forEach(item => renderItems(item));
            } else
                getElement('#results')
                    .innerHTML = response.message;
        })
        .catch(err => console.log(err));

}

function addItem(item) {
    fetch('controllers/insert_product.php', {method: 'POST',body: item})
        .then(res => {
            if (res.status === 200)
                return res.text()
        })
        .then(response => fetchItems())
        .catch(error => console.log(error));
}

function renderItems(item) {
    const itemView = createElement('a');

    itemView.setAttribute('href', `product.php?id=${item.id}`);
    itemView.innerHTML = `
         <a href="product.php?id=${item.id}">
             <div class="card text-dark shadow">
 
                 <div class="card-header d-flex">
 
                     <img class="align-self-start mt-1 mr-3" src="https://eabiawak.com/wp-content/uploads/2017/07/photo.png" 
                         alt="Generic placeholder image" width="54" height="54">
 
                     <div class="mt-2">
                         <span class="mt-0">Anonymous User</span>
                         <p>
                             <small class="text-muted">${item.product_posted}</small>
                         </p>
                     </div>
 
                 </div>
                 
                 <img class="card-img"
                 src="https://blog.twitter.com/content/dam/blog-twitter/official/en_us/products/2017/rethinking-our-default-profile-photo/Avatar-Blog2-Round1.png.img.fullhd.medium.png" alt="Card image cap">
             
                 <div class="card-body">
                     <div class="d-flex">
                         <h5 class="card-title mt-2 flex-grow-1">${item.product_name}</h5>
                         <h4 class="card-title mt-2">
                             <span class="badge badge-pill badge-dark"><b>&#8369;${item.product_price}</b></span>
                         </h4>
                     </div>
 
                     <p class="card-text">${item.product_description}</p>
                 </div>
             </div>
         </a>
    `;
    getElement('#results')
        .appendChild(itemView);
 }

 function getElement(query) {
     return document.querySelector(query);
 }

 function createElement(el) {
     return document.createElement(el);
 }