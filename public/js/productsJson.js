const productParent = document.getElementById('products-parent');
console.log('in productsJson')
fetch('https://127.0.0.1:8000/products/products-json', {
    method: 'GET',
    headers: {
        'Content-type': 'application/json'
    },
}).then(response => response.json())
    .then(products => {
        console.log(products);
        const carteProducts = products.map((product) =>
        `
        <div>
           <h2>${product.name}</h2>
           <p>${product.description}</p> 
           <p>Price : ${product.price} €</p> 
         </div>
        `
        )

        productParent.innerHTML = carteProducts.join(' ');
    })
.catch(error => console.log(error));