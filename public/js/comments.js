const commentParent = document.getElementById('comment-parent');
console.log(commentParent)
const commentForm = document.querySelector('.comments');
console.log(commentForm)

commentForm.addEventListener('submit', function(event) {
    event.preventDefault();
    const formData = new FormData(commentForm);
    let currentUrl = window.location.href;
    console.log(formData);
    let id = currentUrl.match(/\/(\d+)\/product-details$/)?.[1] || null;
    console.log(id)
    if(id) {
        fetch(this.action, {
            method: this.method,
            body: formData,
        })
            .then(response => response.json())
            .then(data => {
                console.log(data);
                const new_comment = document.createElement('div');
                new_comment.innerHTML= `
                <h3>${data.name}</h3>
                <p>${data.content}</p>
                `
                commentParent.appendChild(new_comment);
                commentForm.reset();
                window.location.reload();
            })
            .catch(error => console.log(error));
    }
});