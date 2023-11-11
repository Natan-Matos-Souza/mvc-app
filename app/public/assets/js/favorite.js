
let likeBtn = [];

function getLikePostsId() {
  return localStorage
    .getItem("likedPostsId")
    .split(",")
    .filter((e) => {
      if (e) return true;
    });
}

async function getPostsInfo(postsId) {

  postsId.map((e) => {
    $.ajax({
      url: `http://localhost:8082/api/posts/${e}`,
      type: "GET",
      dataType: "JSON",
    }).done(function (result) {
      const data = result[0];

      renderPost(data);
      setTimeout(() => {
        unlikePost(data.id);
      }, 1* 1000);

    });
  });
}

async function renderPost(data) {
  const postArea = document.querySelector(".post-container-area");

  postArea.innerHTML += `<div class="post-container" id="post-${data.id}">

            <div class="like-btn-area">
                <img src="/assets/icons/star-fill.svg" alt="like button" class="like-btn">
            </div>

            <div class="post-title-area">
                <h2>${data.post_title}</h2>
            </div>

            <div class="post-content-area">
                <p>${data.post_content}</p>
            </div>

            <div class="post-info-area">
                <span>${data.post_author} - ${data.post_data}</span>
            </div>
            </div>`;
}

getPostsInfo(getLikePostsId());

function unlikePost(id)
{
  
  const postContainer = document.getElementById(`post-${id}`);

  const likeBtn = postContainer.firstElementChild.firstElementChild;

  likeBtn.addEventListener('click', () => {
    postContainer.remove();

    let likedPosts = localStorage.getItem('likedPostsId').split(',');

    likedPosts = likedPosts.filter(element => {
      
      if (element == id) return false;
      else return true;

    });

    localStorage.setItem('likedPostsId', likedPosts);


  });

}

