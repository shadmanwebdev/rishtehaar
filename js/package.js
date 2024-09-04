
$("#image").change(function(){
    $imageSrc = document.getElementById('image').value;
    $imageSrcArr = $imageSrc.split('\\');
    $imgName = $imageSrcArr.at(-1);
    $imgNameArr = $imgName.split('.');
    $imgType = $imgName.at(-1);
    document.getElementById('img-name-display').value = $imgName;
    document.getElementById('card-6-next').classList.add('packageSubmit');
});

function fireButton(event) {
    event.preventDefault();
    document.getElementById('image').click()
}


function hideCards() {
    var cardNodelist = document.querySelectorAll('.form-card');   
    for (let i = 0; i < cardNodelist.length; i++) {
        cardNodelist[i].style.position = 'absolute';
        cardNodelist[i].style.zIndex = -10;
        cardNodelist[i].style.opacity = 0;
    }
}

hideCards();

document.getElementById('form-card-1').style.position = 'static';
document.getElementById('form-card-1').style.opacity = 1;

function toggleCards(id) {
    var idArr = id.split('-');
    cardNo = idArr[1];
    direction = idArr[2];
    console.log(cardNo, direction);

    
    var card1 = document.getElementById('form-card-1');
    var card2 = document.getElementById('form-card-2');
    var card3 = document.getElementById('form-card-3');
    var card4 = document.getElementById('form-card-4');
    var card5 = document.getElementById('form-card-5');
    var card6 = document.getElementById('form-card-6');

    


    if(cardNo == 1 && direction == 'next') {
        var package = document.getElementById('package');
        // Validate Inputs
        if(package) {
            hideCards();
            card2.style.position = 'static';
            card2.style.opacity = 1;
            // card2.style.zIndex = 1;
            // card2.style.opacity = 1;
            return;
        } else {
            return;
        }
    }
    if(cardNo == 2 && direction == 'next') {
        var payMethodInp = document.getElementById('pay_method');

        // Validate Inputs
        if(payMethodInp.value) {
            hideCards();
            if(payMethodInp.value == 'bank') {
                card3.style.position = 'static';
                card3.style.opacity = 1;
            }
            if(payMethodInp.value == 'easypaisa') {
                card4.style.position = 'static';
                card4.style.opacity = 1;
            }
            if(payMethodInp.value == 'jazzcash') {
                card5.style.position = 'static';
                card5.style.opacity = 1;
            }
            return;
        } else {
            return;
        }
    }
    if(cardNo == 3 && direction == 'next') {      
        hideCards();
        card6.style.position = 'static';
        card6.style.opacity = 1;
        return;
    }
    if(cardNo == 4 && direction == 'next') {      
        hideCards();
        card6.style.position = 'static';
        card6.style.opacity = 1;
        return;
    }
    if(cardNo == 5 && direction == 'next') {      
        hideCards();
        card6.style.position = 'static';
        card6.style.opacity = 1;
        return;
    }
    if(cardNo == 2 && direction == 'back') {
        hideCards();
        card1.style.position = 'static';
        card1.style.opacity = 1;
    }
    if(cardNo == 3 && direction == 'back') {
        hideCards();
        card2.style.position = 'static';
        card2.style.opacity = 1;
    }
    if(cardNo == 4 && direction == 'back') {
        hideCards();
        card2.style.position = 'static';
        card2.style.opacity = 1;
    }
    if(cardNo == 5 && direction == 'back') {
        hideCards();
        card2.style.position = 'static';
        card2.style.opacity = 1;
    }
    if(cardNo == 6 && direction == 'back') {
        hideCards();
        card2.style.position = 'static';
        card2.style.opacity = 1;
    }
    
    if(cardNo == 6 && direction == 'next') {
        $imageSrc = document.getElementById('image').value;
        $imageSrcArr = $imageSrc.split('\\');
        $imgName = $imageSrcArr.at(-1);
        $imgNameArr = $imgName.split('.');
        $imgType = $imgNameArr.at(-1);
        document.getElementById('img-name-display').value = $imgName;

        var payMethodInp = document.getElementById('pay_method');
        var user_id = document.getElementById('user_id').value;

        // console.log(user_id, payMethodInp.value, $imgName, $imgType);
        if(user_id && payMethodInp.value && $imgName && ($imgType == 'jpg' || $imgType == 'jpeg' || $imgType == 'png') ) {
            var loader = document.getElementById('loader');
            loader.classList.add('loader-animation');
            setTimeout(function(){ 
                var form = $('form')[0];
                var formData = new FormData(form);
                $.ajax({
                    url : './controllers/user-handler.php',
                    type: 'POST', 
                    data : formData,
                    cache : false,
                    contentType: false,
                    processData: false,
                    success: function(response, textStatus, jqXHR) {
                        window.location.href = './status';
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        console.log(jqXHR);
                        console.log(textStatus);
                        console.log(errorThrown);
                    }
                });
            }, 2000);
        }
    }
}

