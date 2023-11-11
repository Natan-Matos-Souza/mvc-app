deleteBtn = document.querySelectorAll('.delete-btn');

deleteBtn.forEach(element => {
    element.addEventListener('click', e => {
        const target = e.target;
        
        const parentElement = target.parentElement.parentElement;

        const postId = parentElement.getAttribute('id').split('-')[1];

        console.log(postId);

        $.ajax({
            url: 'http://localhost:8082/dashboard/post/apagar',
            type: 'DELETE',
            data: {
                id: postId
            },
            dataType: 'JSON'
        }).done(function() {
            parentElement.remove();
        });
    });
});