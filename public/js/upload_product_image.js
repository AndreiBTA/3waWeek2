const addPhotoToCollection = (e) => {
    console.log('clicked');
    console.log(e.currentTarget);
    const collectionHolder = document.querySelector(e.currentTarget.dataset.collection);
    //collection comes from here, what's after data- => data-collection ="#photos";
    console.log(collectionHolder);

    const collectionItemHolder = document.createElement('div');
    collectionItemHolder.className = 'mt-2 bordered';

    collectionItemHolder.innerHTML = collectionHolder
        .dataset
        .prototype
        .replace(
            /__name__/g,
            collectionHolder.dataset.index
        );

    const btnDeletePhoto = document.createElement('button');
    btnDeletePhoto.className ='btn btn-danger mt- btn-delete-photo';
    btnDeletePhoto.id = 'btn-delete-photo';
    btnDeletePhoto.innerHTML = 'Delete';
    collectionItemHolder.appendChild(btnDeletePhoto);

    collectionHolder.append(collectionItemHolder);

    collectionHolder.dataset.index++;

    document.querySelectorAll('.btn-delete-photo').forEach(button => button.addEventListener('click', (e) => e.currentTarget.parentElement.remove()));
}

const buttonsAddProductPhotos = document.querySelectorAll('.btn-add-product-photo');
console.log(buttonsAddProductPhotos);
for(const button of buttonsAddProductPhotos) {
    button.addEventListener('click', addPhotoToCollection);
}

