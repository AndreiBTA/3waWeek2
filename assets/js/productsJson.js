const productParent = document.getElementById('products-parent');
console.log('in productsJson')
fetch('https://127.0.0.1:8000/products/products-json', {
    method: 'GET',
    headers: {
        'Content-type': 'application/json'
    },
}).then(response => response.json())
    .then(products => {

        const carteProducts = products.map((product) => {
            const distributeurs = product.distributeurs.map(d => d.name).join(', ')
          return   `
        <div>
           <h3>Name: ${product.name}</h3>
           <p>Description: ${product.description}</p> 
           <p>Price : ${product.price} €</p> 
           <p>Category : ${product.category.name}</p> 
           <p>Reference : ${product.reference.name} </p> 
           <p>Distributeurs : ${distributeurs}</p> 
         </div>
        `
        })

        productParent.innerHTML = carteProducts.join(' ');
    })
.catch(error => console.log(error));