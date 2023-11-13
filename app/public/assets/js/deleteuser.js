const deleteBtn = document.querySelectorAll('.delete-btn');

deleteBtn.forEach(element => {
    element.addEventListener('click', e => {
        const target = e.target;

        const parentElement = target.parentElement.parentElement;

        const userId = parentElement.getAttribute('id').split('-')[1];

        $.ajax({
            url: 'http://localhost:8082/dashboard/user/apagar',
            type: 'DELETE',
            data: {
                id: userId
            },
            dataType: 'JSON'
        }).done(function() {
            parentElement.remove();
        });

    });
});