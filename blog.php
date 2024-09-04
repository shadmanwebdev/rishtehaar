<?php include './partials/header.php'; ?>
<?php include './partials/navigation.php'; ?>



<style>
    #blog-wrapper {
        width: 100%;
    }
    .blog {
        max-width: 90%;
        margin: 50px auto;
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300, 1fr));
        grid-gap: 20px;
    }
    /* .blog .post {
        width: 100%;
    } */
    .thumbnail {
        width: 100%;
        height: 286px;
        margin-bottom: 20px;
    }
    .thumbnail img {
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
    /* Media query for desktop */
    @media (min-width: 769px) {
        .blog {
            max-width: 80%;
        }
        .blog {
            grid-template-columns: repeat(2, 1fr);
        }
    }
    @media (min-width: 1200px) {
        .blog {
            max-width: 1180px;
        }
    }
</style>


<div id='blog-wrapper'>



    <!-- Blog -->
    <?php
        $blog = new Blog;
        echo $blog->blog();
    ?>


</div>




<script defer>
    
    function blogpage(event, page) {
        event.preventDefault();

        var formData = new FormData();

        console.log(page);

        
        if(page) {

            formData.append('page', page);

            fetch('./blog', {
                method: 'POST',
                body: formData
            })
            .then(response => {
                return response.text()      
            })
            .then(response => {
                
                console.log(response);
                $('#blog-wrapper').html(response);

                document.getElementById("blog-wrapper").scrollIntoView({ behavior: "smooth" });
                
            });
        }

    }
</script>



<?php include './partials/footer.php'; ?>