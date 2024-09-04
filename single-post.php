<?php include './partials/header.php'; ?>
<?php include './partials/navigation.php'; ?>



<style>
    .single-post {
        max-width: 350px;
        margin: 50px auto;
    }
    .single-post .thumbnail {
        width: 100%;
        height: 390px;
        margin-bottom: 30px;
    }
    .single-post .thumbnail img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .single-post .title h3 {
        font-size: 28px;
        font-weight: 700;
        line-height: 45px;
        letter-spacing: 0em;
        text-align: left;
        margin-bottom: 30px;
        color: #000000;
    }
    .single-post .content p {
        font-size: 18px;
        font-weight: 400;
        line-height: 34px;
        letter-spacing: 0em;
        text-align: left;
        color: #4A4A4A;

    }
    .single-post .content a.read-more {
        font-size: 16px;
        font-weight: 400;
        line-height: 23px;
        letter-spacing: 0em;
        text-align: left;
        color: #000;
        text-decoration: underline;
        display: flex;
        margin-bottom: 10px;
    }
    .tags {
        margin: 50px 0;
        display: flex;
        flex-flow: row wrap;
        align-items: center;
    }
    .tags li {
        margin-bottom: 10px;
        font-size: 16px;
        font-weight: 400;
        line-height: 30px;
        letter-spacing: 0em;
        text-align: center;
        background: #EBEBEB;
        border-radius: 20px;
        margin-right: 10px;
        padding: 10px 20px;
    }
    /* Media query for desktop */
    @media (min-width: 769px) {
        .single-post {
            max-width: 80%;
        }
    }
    @media (min-width: 1200px) {
        .single-post {
            max-width: 800px;
        }
    }
</style>

<style>
    .blog {
        max-width: 1200px;
        margin: 50px auto;
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        grid-gap: 20px;
    }
    .blog .thumbnail {
        width: 100%;
        height: 286px;
        margin-bottom: 20px;
    }
    
    .blog .thumbnail img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .blog .title h3 {
        font-size: 22px;
        font-weight: 700;
        line-height: 36px;
        letter-spacing: 0em;
        margin-bottom: 10px;
    }
    .blog .summary p {
        font-size: 16px;
        font-weight: 400;
        line-height: 23px;
        letter-spacing: 0em;
        margin-bottom: 10px;
    }
    .blog a.read-more {
        font-size: 16px;
        font-weight: 400;
        line-height: 23px;
        letter-spacing: 0em;
        text-align: left;
        color: #000;
        text-decoration: underline;
        display: flex;
        margin-bottom: 10px;
    }
</style>


<style>
    .share-links {
        max-width: 800px;
        /* margin: 70px auto; */
        margin: 0px auto 100px auto;
    }
    .share-links h2 {
        font-size: 18px;
        font-weight: 500;
        line-height: 36px;
        letter-spacing: 0em;
        text-align: left;
        color: #000000;
        margin-bottom: 15px;
    }
    .share-buttons {
        display: flex;
        flex-flow: row nowrap;
    }
    .share-buttons button {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background: transparent;
        border: none;
        outline: none;
        display: flex;
        flex-flow: column nowrap;
        align-items: center;
        justify-content: center;
        margin-right: 5px;
    }
    .share-buttons button img {
        width: 45px;
        height: 45px;
        object-fit: cover;
    }
    .share-buttons button span {
        font-size: 12px;
        font-weight: 400;
        line-height: 36px;
        letter-spacing: 0em;
        text-align: center;
        color: #7E7E7E;
    }
</style>


<!-- Views -->
<style>
    .post-footer {
        max-width: 350px;
        margin: 0 auto;
        display: flex;
        flex-flow: row nowrap;
        align-items: center;
        justify-content: space-between;
    }
    .post-footer .views {
        /* margin-top: 40px; */
        margin-right: 10px;
    }
    .post-footer .views {
        display: flex;
        flex-flow: row nowrap;
        align-items: center;
    }
    .post-footer .views i {
        font-size: 25px;
        margin-right: 5px;
    }
    .post-footer .views span {
        font-size: 13px;
    }
    
    @media screen and (min-width: 577px) {
        .post-footer {
            max-width: 100%;
        }
    }
    @media screen and (min-width: 1200px) {
        .post-footer {
            max-width: 800px;
        }
    }
</style>


<!-- Blog -->
<?php
    $blog = new Blog;
    echo $blog->single_post($_GET['slug']);
?>









<script defer>
    // Replace "YOUR_POST_URL" with the actual URL of the post you want to share.
    const postUrl = window.location.href;

    // WhatsApp button
    document.getElementById("whatsappBtn").addEventListener("click", function() {
        const whatsappUrl = `https://api.whatsapp.com/send?text=${encodeURIComponent(postUrl)}`;
        window.open(whatsappUrl, "_blank");
    });

    // Facebook button
    document.getElementById("facebookBtn").addEventListener("click", function() {
        const facebookUrl = `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(postUrl)}`;
        window.open(facebookUrl, "_blank");
    });

    // Twitter button
    document.getElementById("twitterBtn").addEventListener("click", function() {
        const twitterUrl = `https://twitter.com/intent/tweet?url=${encodeURIComponent(postUrl)}`;
        window.open(twitterUrl, "_blank");
    });

    // Copy Link button
    document.getElementById("copyLinkBtn").addEventListener("click", function() {
        const tempInput = document.createElement("input");
        tempInput.value = postUrl;
        document.body.appendChild(tempInput);
        tempInput.select();
        document.execCommand("copy");
        document.body.removeChild(tempInput);
        alert("Link copied to clipboard!");
    });
</script>






<?php include './partials/footer.php'; ?>