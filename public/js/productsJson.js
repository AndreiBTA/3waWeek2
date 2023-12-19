const productParent = document.getElementById('products-parent');

fetch('https://localhost:8000/products/products-json-show', {
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
         </div>
        `
        )

        productParent.innerHTML = carteProducts.join(' ');
        // productParent.replaceChildren(carteProducts.join(' '));
    })
.catch(error => console.log(error));