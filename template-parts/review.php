<style>
    #write-a-review {
        position: fixed;
        width: 800px;
        height: 700px;
        top: 50%;
        left: 50%;
        margin-top: -350px;
        margin-left: -400px;
        z-index: 100;
        border: 1px solid gray;
        background-color: #fff;
        color: #000;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    #writeReviewWrapper {
        width: 80%;
        display: flex;
        flex-flow: column nowrap;
        row-gap: 30px;
    }
    .rating {
        display: flex;
        flex-flow: column nowrap;
        /* align-items: center; */
        row-gap: 5px;
        column-gap: 10px;
    }
    .rating:nth-child(1) { 
        text-transform: uppercase;
    }
    .rating-stars {
        display: flex;
        flex-flow: row nowrap;
        align-items: center;
        column-gap: 5px;
    }
    .rating-stars span {
        width: 20px;
        height: 30px;
        display: flex;
        align-items: center;
        position: relative;
    }
    .rating-stars span:before {
        content: '\f408';
        color: gray;
        font-size: 30px;
        font-family: Genericons;
        position: absolute;
        left: -3px;
    }
    .rating-stars span.rated:before {
        color: #fea31c !important;
    }
    textarea {
        height: 150px;
    }
    .upload-photo {
        display: flex;
        flex-flow: column nowrap;
        row-gap: 10px;
    }
    @media screen and (max-width: 800px) {
        #write-a-review {
            width: 600px;
            height: 700px;
            top: 5%;
            margin-top: 0;
            margin-left: -300px;
        }
        #writeReviewWrapper {
            width: 90%;
        }
    }
    @media screen and (max-width: 414px) {
        #write-a-review {
            width: 350px;
            height: 700px;
            top: 2%;
            left: 50%;
            margin-top: 0;
            margin-left: -175px;
        }
        #writeReviewWrapper {
            width: 90%;
        }
    }
</style>

<div id='write-a-review'>
    <div id='writeReviewWrapper'>
        <div class='form-header'>
            <div class='form-heading'>
                <h3>Write a Review</h3>
            </div>
        </div>
        <form onsubmit='return validateReview(event)' autocomplete='off' action='./controllers/review-handler' id='signUpForm' class='sign_up' method='POST' enctype="multipart/form-data">                 
            <div class='input-group'>
                <input type='text' class='name' name='name' id='name' placeholder='NAME'>
                <div class='error' id='nameError'></div>
            </div>
            <div class='input-group'>
                <input type='text' class='surname' name='surname' id='surname' placeholder='SURNAME'>
                <div class='error' id='surnameError'></div>
            </div>
            <input type="hidden" name='product' id='product' value=''>
            <input type="hidden" name='rating_input' id='rating_input' value='0'>
            <div class='rating'>
                <div>Rating: </div>
                <div class='rating-stars'>
                    <span id='rating-1' onclick='return ratingVal(this.id);'></span>
                    <span id='rating-2' onclick='return ratingVal(this.id);'></span>
                    <span id='rating-3' onclick='return ratingVal(this.id);'></span>
                    <span id='rating-4' onclick='return ratingVal(this.id);'></span>
                    <span id='rating-5' onclick='return ratingVal(this.id);'></span>
                </div>
                <div class='error' id='ratingError'></div>
            </div>
            <div class='input-group'>
                <textarea name='comment' id='comment' cols='30' rows='12' placeholder='COMMENT'></textarea>
                <div class='error' id='commentError'></div>
            </div>
            <div class='upload-photo'>
                <div>Upload a phpto</div>
                <div>
                    <input class="input" id="photo" type="file" name="photo">
                </div>
            </div>
            <div class='input-group'>
                <input type='submit' class='send' name='send' value='Done'>
            </div>
        </form>
    </div>
</div>



<script>
    // Review
    bgOverlay.addEventListener('click', function() {
        var writeAReview = document.getElementById('write-a-review');
        if(typeof(writeAReview) != 'undefined' && writeAReview != null){
            writeAReview.parentNode.removeChild(writeAReview);
        }
        if(!bgOverlay.classList.contains('light')) {
            if(bgOverlay.classList.contains('dark')) {
                bgOverlay.classList.remove('dark');
            }
            bgOverlay.classList.add('light');
        }
    });

    function ratingVal(id) {
        var ratingStars = document.querySelectorAll('.rating-stars span');
        for (let i = 0; i < ratingStars.length; i++) {
            if(ratingStars[i].classList.contains('rated')) {
                ratingStars[i].classList.remove('rated');
            }
        }
        var idArr = id.split("-");
        var v = parseInt(idArr[1]);
        var ratingInput = document.getElementById('rating_input');
        
        ratingInput.value = v;
        console.log(v);
        for (let i = 0; i < v; i++) {
            if(!ratingStars[i].classList.contains('rated')) {
                ratingStars[i].classList.add('rated');
            } else {
                ratingStars[i].classList.remove('rated');
            }
        } 
    }
    function validateReview(event) {
        // Name
        var nameValue = document.getElementById('name').value;
        var nameError = document.getElementById('nameError');
        // Surname
        var surnameValue = document.getElementById('surname').value;
        var surnameError = document.getElementById('surnameError');
        // Surname
        var ratingValue = parseInt(document.getElementById('rating_input').value);
        var ratingError = document.getElementById('ratingError');
        if(nameValue && surnameValue && ratingValue > 0) {
            return;
        }else {
            if(nameValue) {
                nameError.innerHTML = '';
            } else {
                event.preventDefault();
                nameError.innerHTML = '<div>Name cannot be empty</div>';
            }
            if(surnameValue) {
                surnameError.innerHTML = '';
            } else {
                event.preventDefault();
                surnameError.innerHTML = '<div>Surname canont be empty</div>';
            }
            if(ratingValue > 0) {
                ratingError.innerHTML = '';
            } else {
                event.preventDefault();
                ratingError.innerHTML = '<div>Rate the product</div>';
            }
        }
    }
</script>