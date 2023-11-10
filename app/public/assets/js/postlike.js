const likeBtn = document.querySelectorAll('.like-btn');

let likedPostId = []

if (localStorage.getItem('likedPostsId'))
{
    likedPostId = localStorage.getItem('likedPostsId').split(',').filter(e => {
        if (e) return true;
    });
}


function updateView()
{
    const likedBtn = document.querySelectorAll('.like-btn');

    likedBtn.forEach(e => {

        const postId = e.parentElement.parentElement.getAttribute('id').split('-')[1];
        const likedPosts = localStorage.getItem('likedPostsId').split(',');
        let isPostLiked = false;

        likedPosts.map(element => {
            if (postId == element) isPostLiked = true;
        });

        if (isPostLiked)
        {
            e.setAttribute('src', '/assets/icons/star-fill.svg');
        } else {
            e.setAttribute('src', '/assets/icons/star.svg');
        }


    });


}  


likeBtn.forEach(element => {

    element.addEventListener('click', e => {
        const target = e.target;


        const postId = e.target.parentElement.parentElement.getAttribute('id').split('-')[1];

        let isPostLiked = false;

        likedPostId.map(postsId => {

            if (postsId == postId)
            {
                isPostLiked = true;
            }

        });

        if (!isPostLiked)
        {
            likedPostId.push(postId);
            localStorage.setItem('likedPostsId', likedPostId);
            updateView();

        } else {

            unlikedPostIndex = likedPostId.indexOf(postId)
            delete likedPostId[unlikedPostIndex]
            likedPostId.sort();
            localStorage.setItem('likedPostsId', likedPostId);

            updateView();
        }

    });


});

updateView();