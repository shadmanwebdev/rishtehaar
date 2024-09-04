/* 
    Menu
    select
*/
function scroll_to_element(id, event) {
    event.preventDefault();
    var element = document.getElementById(id);
    element.scrollIntoView({ behavior: 'smooth', block: "start", inline: "nearest"});
}
function bookmark(id) {
    var formData = new FormData();
    if (id) {
        formData.append('profile_id', id);
        formData.append('bookmark', 'true');

        fetch('./controllers/bookmark-handler', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            return response.text();
        })
        .then(response => {
            // console.log(response);
            if ($.trim(response) == '1') {
                $('.bookmark-filled-' + id).css({ 'display': 'block' });
                $('.bookmark-'+id).css({ 'display': 'none' });
            } else {
                console.log(response);
                $('.bookmark-filled-'+id).css({ 'display': 'none' });
                $('.bookmark-'+id).css({ 'display': 'block' });
            }
        })
        .catch(err => console.log(err));
    } else {
        $('#code').addClass('invalid');
        $('#codeError').html('<div>Code cannot be blank</div>');
    }
}
function redirect_to_register() {
    window.location.href = './registration';
}
// Remove sidebar filter
var w = window.innerWidth;
if(w < 1300) {
    var sidebarFilter = document.querySelector('.sidebar #filter');
    if(typeof(sidebarFilter) != 'undefined' && sidebarFilter != null){
        sidebarFilter.parentNode.removeChild(sidebarFilter);
    }
}


// Page name
var url = window.location.href;
var urlArr = url.split('/');
console.log(urlArr); // ["http:", "", "localhost", "blackhat", "contact"]
var protocol = urlArr[0];
var host = urlArr[2];
var before_last = urlArr[urlArr.length - 2];
var last = urlArr[urlArr.length - 1];

// Check host
if(protocol === 'http:' && host === 'localhost') {
    if(urlArr.length === 5 && (last === '' || last.startsWith("?"))) {
        // Check if page is home page
        var page = '';
    } else if(urlArr.length === 5 && (last != '' || !last.startsWith("?"))) {
        var page = last;
    } else if(urlArr.length === 6  && (last != '' || !last.startsWith("?"))) {
        var page = last;
    }
} else if(protocol === 'https:') {
    if(urlArr.length === 4 && (last === '' || last.startsWith("?"))) {
        // Check if page is home page
        var page = '';
    } else if(urlArr.length === 4 && (last != '' || !last.startsWith("?"))) {
        var page = last;
    } else if(urlArr.length === 5  && (last != '' || !last.startsWith("?"))) {
        var page = last;
    }
}
function togglePhone(el, event) {
    event.preventDefault();
  
    var d = $(el).data('href'); // Use jQuery data() method to get the value of data-href
    var reducted = $('.reducted-' + d); // Get elements with class 'reducted-{d}'
    var whatsapp = $('.whatsapp-' + d); // Get elements with class 'whatsapp-{d}'
    var showBtn = $('div[data-href="' + d + '"]');
  
    if (reducted.hasClass('show-ph')) {
        reducted.addClass('hide-ph').removeClass('show-ph');
        whatsapp.removeClass('hide-ph').addClass('show-ph');
        showBtn.text('Hide'); // Use jQuery text() method to set text content
    } else {
        whatsapp.addClass('hide-ph').removeClass('show-ph');
        reducted.removeClass('hide-ph').addClass('show-ph');
        showBtn.text('Show'); // Use jQuery text() method to set text content
    }
}
  
function fgt_password(event) {
    event.preventDefault();
    var formData = new FormData();

    const emailValue = $('#email').val();

    if(emailValue && emailValue.match(/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/)) {

        formData.append('forgot_password', 'true');
        formData.append('email', emailValue);

        // $('#loader').addClass('loader-animation');

        // setTimeout( function() { 
            fetch('./controllers/user-handler.php', {
                method: 'POST',
                body: formData
            })
            .then(response => {
                return response.text()      
            })
            .then(response => {
                var alert = document.getElementById('msg-response');
                alert.classList.add('alert');

                if($.trim(response) == '1') {
                    alert.innerHTML = "<div class='success'>Reset email sent</div>";
                } else if ($.trim(response) == '2') {
                    alert.innerHTML = "<div class='error'>This email is not registered</div>";
                } else {
                    alert.innerHTML = "<div class='error'>There was an error.</div>";
                }
                console.log(response);
                // $('#loader').removeClass('loader-animation');
            })
            .catch( err => console.log(err));
        // }, 500);
    }
}
function update_password(event) {
    event.preventDefault();
    var formData = new FormData();

    const selector = $('#selector').val();
    const validator = $('#validator').val();
    const new_password = $('#password').val();
    const repeat_password = $('#repeat_password').val();

    if(new_password) {
        $('#pwdError').html("");
    }
    if(repeat_password) {
        $('#repeatPwdError').html("");
    }
    if (new_password == repeat_password) {
        $('#repeatPwdError').html("");
    }
    
    if(new_password && repeat_password && new_password == repeat_password) {
        
        formData.append('update_password', 'true');
        formData.append('selector', selector);
        formData.append('validator', validator);
        formData.append('new_password', new_password);
        formData.append('repeat_password', repeat_password);
    
        fetch('./controllers/user-handler', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            return response.text()      
        })
        .then(response => {
            // var alert = document.getElementById('msg-response');
            // alert.classList.add('alert');

            // if($.trim(response) == '1') {
            //     alert.innerHTML = "<div class='success'>Password updated</div>";
            // } else if ($.trim(response) == '2') {
            //     alert.innerHTML = "<div class='error'>Passwords don't match</div>";
            // } else {
            //     alert.innerHTML = "<div class='error'>There was an error.</div>";
            // }
            console.log(response);
            window.location.href = './confirmation?reset=success';
        })
        .catch( err => console.log(err));
    } else if (!new_password || !repeat_password) {
        console.log('empty');
        if(!new_password) {
            $('#pwdError').html("<div>Field cannot be empty</div>");
        }
        if(!repeat_password) {
            $('#repeatPwdError').html("<div>Field cannot be empty</div>");
        }
    } else if (new_password != repeat_password) {
        console.log('mismatch');
        $('#repeatPwdError').html("<div>Passwords don't match</div>");
    }
}
// if(page.startsWith('index')) {
//     var uri = last.split('?');
//     console.log(uri[1], 'aaaaaaaaaaaaa');
//     if(!uri[1].startsWith("occupation")) {
//         uri_last = uri[uri.length - 1].replaceAll("%20", "+");
//         var paramsArr = uri_last.split('&');
//         console.log(paramsArr);
    
//         var filterMaritalStatus = document.getElementById('filterMaritalStatus');
//         var filterAge = document.getElementById('filterAge');
//         var filterEducation = document.getElementById('filterEducation');
//         var filterCity = document.getElementById('filterCity');
    
//         for (let i = 0; i < paramsArr.length; i++) {
//             var activeArr = paramsArr[i].split('=');
//             console.log(activeArr[1]);
//             if(activeArr[0] != 'page') {
//                 if(i == 0 && activeArr[1] != 'Any') {
//                     var strArr = activeArr[1].split('+');
//                     newStrArr = [];
//                     strArr.forEach(element => {
//                         // var newElem = capitalize(element);
//                         newStrArr.push(element);
//                     });
//                     var filterStr = newStrArr.join(' ');
        
//                     document.getElementById('marital_status').value = filterStr;
//                     document.getElementById('selectedMaritalStatus').textContent = filterStr;
//                     filterMaritalStatus.style.color = 'rgb(255,130,9)';
//                     filterMaritalStatus.style.border = '1px solid rgb(255,130,9)';
//                     filterMaritalStatus.style.backgroundColor = 'rgb(255,255,255)';
//                 }
//                 if(i == 1 && activeArr[1] != 'Any') {
//                     var strArr = activeArr[1].split('+');
//                     newStrArr = [];
//                     strArr.forEach(element => {
//                         // var newElem = capitalize(element);
//                         newStrArr.push(element);
//                     });
//                     var filterStr = newStrArr.join(' ');
        
//                     if(activeArr[1] != '40') {
//                         document.getElementById('age').value = filterStr;
//                         document.getElementById('selectedAge').textContent = filterStr;
//                     } else {
//                         document.getElementById('age').value = filterStr;
//                         document.getElementById('selectedAge').textContent = '40+';
//                     }
//                     filterAge.style.color = 'rgb(255,130,9)';
//                     filterAge.style.border = '1px solid rgb(255,130,9)';
//                     filterAge.style.backgroundColor = 'rgb(255,255,255)';
//                 }
//                 if(i == 2 && activeArr[1] != 'Any') {
//                     var strArr = activeArr[1].split('+');
//                     newStrArr = [];
//                     strArr.forEach(element => {
//                         // var newElem = capitalize(element);
//                         newStrArr.push(element);
//                     });
//                     var filterStr = newStrArr.join(' ');
        
//                     document.getElementById('city').value = filterStr;
//                     document.getElementById('selectedCity').textContent = filterStr;
//                     filterCity.style.color = 'rgb(255,130,9)';
//                     filterCity.style.border = '1px solid rgb(255,130,9)';
//                     filterCity.style.backgroundColor = 'rgb(255,255,255)';
//                 }
//             }
//         }
//         page = '';
//     }
    
// }



// Change Nav item color
// var navNodelist = document.querySelectorAll('.navigation_list > li > a');
// for (let i = 0; i < navNodelist.length; i++) {
//     var href = navNodelist[i].getAttribute("href").replace('./','');
//     if(href === page) {
//         navNodelist[i].style.color = '#009cf7';
//     }
// }


// MAIN SLIDER
function Timer(fn, t) {
    var timerObj = setInterval(fn, t);

    this.stop = function() {
        if (timerObj) {
            clearInterval(timerObj);
            timerObj = null;
        }
        return this;
    }

    // start timer using current settings (if it's not already running)
    this.start = function() {
        if (!timerObj) {
            this.stop();
            timerObj = setInterval(fn, t);
        }
        return this;
    }

    // start with new or original interval, stop current interval
    this.reset = function(newT = t) {
        t = newT;
        return this.stop().start();
    }
}
// Display slideshow if page is index
// if(page == '') {
//     // GET ALL SLIDE AND DOTS
//     var slideAll = document.querySelectorAll('.slide');
//     var dotAll = document.querySelectorAll('.dot');
//     // CHANGE FIRST SLIDE
//     var dotOne = dotAll[0];
//     dotOne.style.backgroundColor = 'rgb(241,195,149)';
//     // SHOW FIRST SLIDE
//     var slideOne = slideAll[0];
//     if(typeof(slideOne) != 'undefined' && slideOne != null){
//         slideOne.classList.remove('hide-slide');
//         slideOne.classList.add('show-slide');
//     }
    
//     // NEXT SLIDE
//     var autoswitch = true;
//     var switch_speed = 5000;
//     var timer = new Timer(function() {   
//         var slideActive = document.querySelectorAll('.show-slide')[0];
//         var slideActiveId = slideActive.id;
//         console.log(slideActiveId);
//         var dotActive = document.getElementById('dot-'+slideActiveId.split("-")[1]);
//         console.log(dotActive);
//         if(slideActive.nextElementSibling) {
//             slideActive.nextElementSibling.classList.remove('hide-slide');
//             slideActive.nextElementSibling.classList.add('show-slide');
//             dotActive.nextElementSibling.style.backgroundColor = 'rgb(241,195,149)';
//         } else {
//             slideAll[0].classList.remove('hide-slide');
//             slideAll[0].classList.add('show-slide');
//             dotAll[0].style.backgroundColor = 'rgb(241,195,149)';
//         }
//         slideActive.classList.remove('show-slide');
//         slideActive.classList.add('hide-slide');
//         dotActive.style.backgroundColor = '#fff';
//     }, switch_speed);
//     timer.reset(switch_speed);
//     timer.stop();
//     timer.start();
// }
// RUN FUNCTION ON CLICK
function showSlide(id) {
    var toArr = id.split("-");
    var n = toArr[1];
    var dot = document.getElementById(id);
    var slide = document.getElementById('slide-'+n);
    // CHANGE ALL DOTS
    dotAll.forEach(el => {
        el.style.backgroundColor = '#fff';
    });
    // CHANGE CLICKED DOT
    dot.style.backgroundColor = 'rgb(241,195,149)';
    // HIDE ALL SLIDES
    slideAll.forEach(el => {
        if(el.classList.contains("show-slide")) {
            el.classList.remove('show-slide');
            el.classList.add('hide-slide');
        }
    });
    // SHOW CLICKED SLIDE
    if(slide.classList.contains("hide-slide")) {
        slide.classList.remove('hide-slide');
        slide.classList.add('show-slide');
    }
    timer.reset(switch_speed);
    // stop the timer
    timer.stop();
    // start the timer
    timer.start();
}


// Menu
var navNodelist = document.querySelectorAll('.navigation_list li');
console.log(navNodelist); // NodeList(4) [li.list-item, li.list-item, li.list-item, li.list-item]
for (let i = 0; i < navNodelist.length; i++) {
    navNodelist[i].addEventListener('mouseover', function() {
        for (let n = 0; n < navNodelist.length; n++) {
            var itemChildren = navNodelist[n].children;
            var childCount = navNodelist[n].children.length;
            if(childCount === 2) {
                if(itemChildren[1].classList.contains('mega-menu')) {
                    itemChildren[1].classList.add('mega-menu-hide');
                    if(itemChildren[1].classList.contains('mega-menu-show')) {
                        itemChildren[1].classList.remove('mega-menu-show');
                    }
                }
            }
        }
        var itemChildren = navNodelist[i].children;
        var childCount = navNodelist[i].children.length;
        if(childCount === 2) {
            if(itemChildren[1].classList.contains('mega-menu')) {
                itemChildren[1].classList.add('mega-menu-show');
                if(itemChildren[1].classList.contains('mega-menu-hide')) {
                    itemChildren[1].classList.remove('mega-menu-hide');
                }
            }
        }
    });
    navNodelist[i].addEventListener('mouseout', function() {;
        var itemChildren = navNodelist[i].children;
        var childCount = navNodelist[i].children.length;
        if(childCount === 2) {
            itemChildren[1].addEventListener('mouseout', function() {
                if(itemChildren[1].classList.contains('mega-menu')) {
                    itemChildren[1].classList.add('mega-menu-hide');
                    if(itemChildren[1].classList.contains('mega-menu-show')) {
                        itemChildren[1].classList.remove('mega-menu-show');
                    }
                }
            });
        }
    });
}

var navBtn = document.getElementById('navBtn');
var mobList  = document.getElementById('mobList');
var bgOverlay  = document.getElementById('bgOverlay');

console.log(navBtn);

var navSpansAll = document.querySelectorAll('#navBtn > span');

if(typeof(navBtn) != 'undefined' && navBtn != null) {
    navBtn.addEventListener('click', function() {
        if(mobList.classList.contains('show_list')) {
            mobList.classList.remove('show_list');
            mobList.classList.add('hide_list');
            bgOverlay.classList.remove('dark');
            bgOverlay.classList.add('light');

            navBtn.style.height = "19px";
            navSpansAll.forEach(element => {

                // Admin menu start
                var adminSpansAll = document.querySelectorAll('.admin_menu_top #navBtn > span');
                adminSpansAll.forEach(element => {
                    console.log(element);
                });
                // Admin menu end

                if(element = navSpansAll[0]) {
                    navSpansAll[0].classList.remove('rotate-left');
                    navSpansAll[0].classList.add('rotate-left-rev');
                }
                if(element = navSpansAll[1]) {
                    navSpansAll[1].classList.remove('hide');
                    navSpansAll[1].classList.add('show');
                }
                if(element = navSpansAll[2]) {
                    navSpansAll[2].classList.remove('rotate-right');
                    navSpansAll[2].classList.add('rotate-right-rev');
                }
            });

            return;
        }
        if(!mobList.classList.contains('show_list')) {
            mobList.classList.remove('hide_list');
            mobList.classList.add('show_list');
            bgOverlay.classList.remove('light');
            bgOverlay.classList.add('dark');

            navBtn.style.height = "0px";
            navSpansAll.forEach(element => {
                if(element = navSpansAll[0]) {
                    navSpansAll[0].classList.remove('rotate-left-rev');
                    navSpansAll[0].classList.add('rotate-left');
                }
                if(element = navSpansAll[1]) {
                    navSpansAll[1].classList.remove('show');
                    navSpansAll[1].classList.add('hide');
                }
                if(element = navSpansAll[2]) {
                    navSpansAll[2].classList.remove('rotate-right-rev');
                    navSpansAll[2].classList.add('rotate-right');
                }
            });
            return;
        }
    });
}

if(typeof(bgOverlay) != 'undefined' && bgOverlay != null) {
    bgOverlay.addEventListener('click', function() {
        if(mobList.classList.contains('show_list')) {
            mobList.classList.remove('show_list');
            mobList.classList.add('hide_list');
            bgOverlay.classList.remove('dark');
            bgOverlay.classList.add('light');

            navBtn.style.height = "19px";
            navSpansAll.forEach(element => {

                // Admin menu start
                var adminSpansAll = document.querySelectorAll('.admin_menu_top #navBtn > span');
                adminSpansAll.forEach(element => {
                    console.log(element);
                });
                // Admin menu end

                if(element = navSpansAll[0]) {
                    navSpansAll[0].classList.remove('rotate-left');
                    navSpansAll[0].classList.add('rotate-left-rev');
                }
                if(element = navSpansAll[1]) {
                    navSpansAll[1].classList.remove('hide');
                    navSpansAll[1].classList.add('show');
                }
                if(element = navSpansAll[2]) {
                    navSpansAll[2].classList.remove('rotate-right');
                    navSpansAll[2].classList.add('rotate-right-rev');
                }
            });
            return;
        }
    });
}

function capitalize(str) {
    const lower = str.toLowerCase();
    return str.charAt(0).toUpperCase() + lower.slice(1);
}

// Show proposal details
function proposalDetails(id) {
    var detailsBtn = document.querySelector('.show-details-'+id);
    detailsBtn.style.display = 'none';
    var parentElement = detailsBtn.parentNode;
    parentElement.style.display = 'none';
    var infos = document.getElementById('col-2 proposal-info-'+id);
    infos.style.height = 'auto';
    var contact = document.getElementById('proposal-contact-'+id);
    contact.style.display = 'flex';
    contact.style.height = 'auto';
}


var profileDropdown = document.getElementById('profile-dropdown');
var profileAngle = document.getElementById('profile-angle');
// profileTrigger
function profileTrigger() {
    if (!profileDropdown.classList.contains('down')) {
        profileDropdown.classList.add('down');
        if (profileDropdown.classList.contains('up')) {
            profileDropdown.classList.remove('up');
        }
        $('#profile-trigger').find("i").removeClass("fa-angle-down").addClass("fa-angle-up");
        return;
    } else {
        profileDropdown.classList.remove('down');
        if (!profileDropdown.classList.contains('up')) {
            profileDropdown.classList.add('up');
        }
        $('#profile-trigger').find("i").removeClass("fa-angle-up").addClass("fa-angle-down");
        return;
    }
}


function load_start() {
    var loader = document.getElementById('loader');
    loader.classList.add('loader-animation');
    var popBg = document.getElementById('popBg');
    if(!popBg.classList.contains('dark')) {
        if(popBg.classList.contains('light')) {
            popBg.classList.remove('light');
        }
        popBg.classList.add('dark');
    }
}
function load_end() {
    var loader = document.getElementById('loader');
    loader.classList.remove('loader-animation');
    var popBg = document.getElementById('popBg');
    if(popBg.classList.contains('dark')) {
        popBg.classList.remove('dark');
    }
    popBg.classList.add('light');
}

function createSession(key, value) {
    // Set a cookie with the key-value pair
    document.cookie = `${key}=${value}; path=/`;
}
  
function getSession(key) {
    // Get all cookies and split them into individual key-value pairs
    const cookies = document.cookie.split(';');
  
    // Loop through the cookies to find the one with the specified key
    for (let i = 0; i < cookies.length; i++) {
        const cookie = cookies[i].trim();
    
        // Check if the cookie starts with the specified key
        if (cookie.startsWith(`${key}=`)) {
            // Return the value of the cookie
            return cookie.substring(key.length + 1);
        }
    }
  
    // If the key is not found, return null
    return null;
}