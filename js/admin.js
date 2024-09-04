
$(document).ready(function() {
    $('.actions').on("click", function(e) {
        e.stopPropagation();
    });
    $(".profile-head").on("click", function(e) {
        e.preventDefault();
        if ($(this).hasClass("active")) {
            $(this).removeClass("active");
            $(this).siblings(".profile-body").slideUp(200);
            $(this).find("i").removeClass("fa-angle-up").addClass("fa-angle-down");
            $(this).css("background-color", "#fff");
            return;
        } else {
            // $(".profile-head > i").removeClass("fa-angle-down").addClass("fa-angle-up");
            $(this).find("i").removeClass("fa-angle-down").addClass("fa-angle-up");
            $(".profile-head").removeClass("active");
            $(this).addClass("active");
            $(".profile-body").slideUp(200);
            $(this).siblings(".profile-body").slideDown(200);
            $(this).css("background-color", "rgb(249,249,249");
            return;
        }
    });
});

function changePackageStatus() {
    var packages_status = document.getElementById('packages_status').value;
    if(packages_status == '2') {
        package_status = 'enabled';
    } else if(packages_status == '1') {
        package_status = 'disabled';
    }
    $.ajax({
        url : './controllers/packages-handler.php',
        type: 'POST', 
        data : 'packages='+package_status,
        success: function(response, textStatus, jqXHR) {
            window.location.href = './packages';
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(jqXHR);
            console.log(textStatus);
            console.log(errorThrown);
        }
    });
}
function updatePackage($i) {
    var loader = document.getElementById('loader');
    loader.classList.add('loader-animation');
    setTimeout(function(){ 
        var form = $('form')[$i];
        var formData = new FormData(form);
        
        $.ajax({
            url : './controllers/packages-handler.php',
            type: 'POST', 
            data : formData,
            cache : false,
            contentType: false,
            processData: false,
            success: function(response, textStatus, jqXHR) {
                window.location.href = './packages';
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(jqXHR);
                console.log(textStatus);
                console.log(errorThrown);
            }
        });
    }, 2000);
}
// 
function submitBanners(event) {
    event.preventDefault();
    var loader = document.getElementById('loader');
    loader.classList.add('loader-animation');
    setTimeout(function(){ 
        var form = $('form')[0];
        var formData = new FormData(form);
        console.log(form);
        $.ajax({
            url : './controllers/banner-handler.php',
            type: 'POST', 
            data : formData,
            cache : false,
            contentType: false,
            processData: false,
            success: function(response, textStatus, jqXHR) {
                window.location.href = './appearance';
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(jqXHR);
                console.log(textStatus);
                console.log(errorThrown);
            }
        });
    }, 3000);
}