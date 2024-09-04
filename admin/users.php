<?php include './header.php'; ?>
<link rel="stylesheet" href="../css/register.css?v=200">


<style>
    .selected-option {
        font-weight: 500;
    }
    .showDropdown {
        top: 38px !important;
    }
</style>

<style>
    .edit-popup {
        width: 370px;
        height: 650px;
        border-radius: 9px;
        overflow-y: scroll;

        position: fixed;
        top: 50%;
        left: 50%;
        background-color: #fff;
        margin-top: -275px;
        margin-left: -185px;
        z-index: 1000;
        padding: 0;
    }
    .edit-popup form {
        width: 100%;
        display: flex;
        flex-flow: column nowrap;
        row-gap: 0px;
    }
    .edit-form-title {
        margin-bottom: 30px;
        font-size: 18px;
        font-weight: 500;
        line-height: 26px;
        letter-spacing: 0em;
        text-align: center;
    }
    .edit-popup .form-inner-div {
        width: 100%;
        padding: 50px 50px 20px 50px;
    }
    .edit-popup .input-group {
        margin-bottom: 20px;
    }
    .edit-popup .input-col.input-col-1 {
        width: 100%;
        margin-bottom: 8px;
    }
    .edit-popup .input-col label {
        font-size: 15px;
    }
    .edit-popup .input-col input,
    .edit-popup .input-col textarea,
    .selection-trigger {
        border: 2px solid rgb(0, 134, 62);
        color: #000;
    }
    .showDropdown {
        top: 45px;
    }
    .edit-popup .submit-wrapper {
        padding: 30px 0;
        border-top: 1px solid #DEDEDE
    }
    .edit-popup div.update-user-btn {
        color: #0E0E0E !important;
        background-color: #FFB600 !important;
        width: 160px;
        font-size: 16px;
        padding: 12px 0;
        text-align: center;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        margin: 0 auto;
    }
</style>

<style>
    .tab { 
        padding: 50px 0 0 50px;
        width: 82vw;
    }
    .tab-inner-div { 
        margin: 0 auto;
        width: 1300px;
        border-bottom: 1px solid #DEDEDE;
        display: flex;
        flex-flow: row nowrap;
    }
    .tab-link {
        
        font-size: 18px;
        font-weight: 500;
        line-height: 26px;
        letter-spacing: 0em;
        text-align: left;
        cursor: pointer;
        color: #858585;
        padding: 10px 10px;
    }

    .tab-link.selected {
        color: #FFB600;
    }

    .admin-content {
        display: none;
    }
    @media screen and (max-width: 1560px) {
        .tab { 
            padding: 20px 0 0 50px;
            width: 82vw;
        }
        .tab-inner-div { 
            margin: 0 auto;
            width: 1100px;
            border-bottom: 1px solid #DEDEDE;
            display: flex;
            flex-flow: row nowrap;
        }
    }
    @media screen and (max-width: 1280px) {
        .tab {
            width: 90%;
            margin: 0 auto;
        }
        .tab-inner-div { 
            width: 100%;
        }
    }
</style>


<style>
    @media screen and (max-width: 768px){
        .tab {
            padding: 0;
            width: 350px;
            margin: 20px auto 0 auto;
        }
        .admin_page-wrapper > div {
            width: 350px;
            margin: 0 auto;
        }
        .admin-content {
            padding: 0;
            width: 350px;
            margin: 20px auto;
        }
        .profiles-body {
            padding: 0;
            width: 350px;
            overflow-x: scroll;
        }
        .profile {
            width: 1100px;
        }
        .pagination {
            width: 350px;
            margin: 0;
        }
    }
</style>

<div id="loader"></div>



<div class="admin_page-wrapper">
    <?php include './admin-sidebar.php'; ?>
    <div>
        <div class="tab">
            <div class="tab-inner-div">
                <?php
                    $selectedTab = isset($_GET['tab']) ? $_GET['tab'] : 'new';
                    if($selectedTab == 'new') {
                        $style3 = '';
                    } else {
                        $style3 = " style='display: none !important;'";
                    }
                    if($selectedTab == "approved") {
                        $style1 = " style='display: block;'";
                    } else {
                        $style1 = "";
                    }
                    if($selectedTab == "deleted") {
                        $style2 = " style='display: block;'";
                    } else {
                        $style2 = "";
                    }
                ?>

                <div class="tab-link <?php if ($selectedTab === 'new') echo 'selected'; ?>" data-tab="new" onclick="showTab('new')">New</div>
                <div class="tab-link <?php if ($selectedTab === 'approved') echo 'selected'; ?>" data-tab="approved" onclick="showTab('approved')">Approved</div>
                <div class="tab-link <?php if ($selectedTab === 'deleted') echo 'selected'; ?>" data-tab="deleted" onclick="showTab('deleted')">Deleted</div>

            </div>
        </div>

        <div class="admin-content" id="new-tab" <?= $style3; ?>>

            <?php
                $user = new User();
                echo $user->showUsers('new');
            ?>
        </div>

        <div class="admin-content" id="approved-tab" <?= $style1; ?>>

            <?php
                $user = new User();
                echo $user->showUsers('approved');
            ?>
        </div>

        <div class="admin-content" id="deleted-tab" <?= $style2; ?>>

            <?php
                $user = new User();
                echo $user->showUsers('deleted');
            ?>
        </div>
    </div>


</div>


<div id='formContainer'>

</div>






<script defer>
    if(typeof(feetInput) != 'undefined' && feetInput != null) {
        feetInput.addEventListener('change', function() {
            if(feetInput.value) {
                feetInput.style.border = '2px solid #00863E';
                feetInput.style.backgroundColor = 'rgb(249,249,249)';
            } else {
                feetInput.style.border = '2px solid red';
                feetInput.style.backgroundColor = 'rgb(254,220,224)';
            }
        });
    }
    if(typeof(cityInput) != 'undefined' && cityInput != null) {
        cityInput.addEventListener('change', function() {
            document.getElementById('city_selected').value = '';
        });
    }
    if(typeof(inchInput) != 'undefined' && inchInput != null) {
        inchInput.addEventListener('change', function() {
            if(inchInput.value) {
                inchInput.style.border = '2px solid #00863E';
                inchInput.style.backgroundColor = 'rgb(249,249,249)';
            } else {
                inchInput.style.border = '2px solid red';
                inchInput.style.backgroundColor = 'rgb(254,220,224)';
            }
        });
    }
    if(typeof(emailInput) != 'undefined' && emailInput != null) {
        emailInput.addEventListener('change', function() {
            if(emailInput.value && emailInput.value.match(/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/)) {
                emailInput.style.border = '2px solid #00863E';
                emailInput.style.backgroundColor = 'rgb(249,249,249)';
            } else {
                emailInput.style.border = '2px solid red';
                emailInput.style.backgroundColor = 'rgb(254,220,224)';
            }
        });
    }
    if(typeof(whatsappInput) != 'undefined' && whatsappInput != null) {
        whatsappInput.addEventListener('change', function() {
            if(whatsappInput.value && whatsappInput.value.match(/^[0-9]*$/) && whatsappInput.value.length >= 10) {
                whatsappInput.style.backgroundColor = 'rgb(249,249,249)';
                whatsappInput.style.border = '2px solid #00863E';
            } else {
                whatsappInput.style.border = '2px solid red';
                whatsappInput.style.backgroundColor = 'rgb(254,220,224)';
            }
        });
    }
    if(typeof(ageInput) != 'undefined' && ageInput != null) {
        ageInput.addEventListener('change', function() {
            if(ageInput.value && (ageInput.value >= 18 && ageInput.value <= 80)) {
                ageInput.style.backgroundColor = 'rgb(249,249,249)';
                ageInput.style.border = '2px solid #00863E';
            } else {
                ageInput.style.border = '2px solid red';
                ageInput.style.backgroundColor = 'rgb(254,220,224)';
            }
        });
    }
    if(typeof(descriptionInput) != 'undefined' && descriptionInput != null) {
        descriptionInput.addEventListener('change', function() {
            if(descriptionInput.value && descriptionInput.value.length <= 500 && descriptionInput.value.length >= 50) {
                descriptionInput.style.backgroundColor = 'rgb(249,249,249)';
                descriptionInput.style.border = '2px solid #00863E';
                descriptionError.innerHTML = "";
            } else if(descriptionInput.value && descriptionInput.value.length <= 50) {
                descriptionInput.style.border = '2px solid red';
                descriptionInput.style.backgroundColor = 'rgb(254,220,224)';
                descriptionError.innerHTML = "<div>Description too short</div>";
            } else {
                descriptionInput.style.border = '2px solid red';
                descriptionInput.style.backgroundColor = 'rgb(254,220,224)';
                descriptionError.innerHTML = "<div>Description too long</div>";
            }
        });
    }
    if(typeof(casteInput) != 'undefined' && casteInput != null) {
        casteInput.addEventListener('change', function() {
            if(casteInput.value && casteInput.value.match(/^(?![\s.]+$)[a-zA-Z\s.]*$/)) {
                casteInput.style.border = '2px solid #00863E';
                casteInput.style.backgroundColor = 'rgb(249,249,249)';
            } else {
                casteInput.style.border = '2px solid red';
                casteInput.style.backgroundColor = 'rgb(254,220,224)';
            }
        });
    }
    if(typeof(occupationInput) != 'undefined' && occupationInput != null) {
        occupationInput.addEventListener('change', function() {
            if(occupationInput.value && occupationInput.value.match(/^(?![\s.]+$)[a-zA-Z\s.]*$/)) {
                occupationInput.style.border = '2px solid #00863E';
                occupationInput.style.backgroundColor = 'rgb(249,249,249)';
            } else {
                occupationInput.style.border = '2px solid red';
                occupationInput.style.backgroundColor = 'rgb(254,220,224)';
            }
        });
    }
    var adminContent1 = document.getElementsByClassName('admin-content')[0];

    // Check what the selected tab is when page is refreshed
    var selectedTab = '<?= $selectedTab; ?>';
    console.log('Selected tab: ', selectedTab);
    if(selectedTab == 'new') {
        adminContent1.style.display = 'block';
    }
    
    function showTab(tabName) {
        window.location.href = './users?tab='+tabName;
        // // Hide all admin content divs
        // var adminContent = document.getElementsByClassName('admin-content');
        // for (var i = 0; i < adminContent.length; i++) {
        //     adminContent[i].style.display = 'none';
        // }

        // // Remove the 'selected' class from all tab links
        // var tabLinks = document.getElementsByClassName('tab-link');
        // for (var i = 0; i < tabLinks.length; i++) {
        //     tabLinks[i].classList.remove('selected');
        // }

        // // Show the selected tab content and add the 'selected' class to the tab link
        // document.getElementById(tabName + '-tab').style.display = 'block';
        // document.querySelector('.tab-link[data-tab="' + tabName + '"]').classList.add('selected');
    }
    function get_edit_form(event, id, relationship, email, whatsapp, gender, age, user_description, marital_status, caste, education, occupation, city, feet, inch) {
        event.preventDefault();
        // Create a new FormData object
        var formData = new FormData();

        // Append the arguments to the FormData object
        formData.append('id', id);
        formData.append('relationship', relationship);
        formData.append('email', email);
        formData.append('whatsapp', whatsapp);
        formData.append('gender', gender);
        formData.append('age', age);
        formData.append('user_description', user_description);
        formData.append('marital_status', marital_status);
        formData.append('caste', caste);
        formData.append('education', education);
        formData.append('occupation', occupation);
        formData.append('city', city);
        formData.append('feet', feet);
        formData.append('inch', inch);

        // Send the AJAX request using fetch
        fetch('edit-user-form.php', {
            method: 'POST',
            body: formData
        })
        .then(function(response) {
            return response.text();
        })
        .then(function(data) {
            // Handle the response from the PHP script
            // Here, you can manipulate the returned data as needed
            console.log(data);
            // Example: Assuming the PHP script returns an HTML form
            // You can append the form to a container on your page
            document.getElementById('formContainer').innerHTML = data;
            popup('edit-popup');



            // Input group 1
            var relationshipInput = document.getElementById('relationship');
            var maritalStatusInput = document.getElementById('marital_status');
            var genderInput = document.getElementById('gender');
            var ageInput = document.getElementById('age');
            var feetInput = document.getElementById('feet');
            var inchInput = document.getElementById('inch');
            // Input group 2
            var educationInput = document.getElementById('education');
            var occupationInput = document.getElementById('occupation');
            var casteInput = document.getElementById('caste');
            var cityInput = document.getElementById('city');
            var descriptionInput = document.getElementById('description');
            // Input group 3
            var emailInput = document.getElementById('email');
            var whatsappInput = document.getElementById('whatsapp');





            if(typeof(feetInput) != 'undefined' && feetInput != null) {
                feetInput.addEventListener('change', function() {
                    if(feetInput.value) {
                        feetInput.style.border = '2px solid #00863E';
                        feetInput.style.backgroundColor = 'rgb(249,249,249)';
                    } else {
                        feetInput.style.border = '2px solid red';
                        feetInput.style.backgroundColor = 'rgb(254,220,224)';
                    }
                });
            }
            if(typeof(inchInput) != 'undefined' && inchInput != null) {
                inchInput.addEventListener('change', function() {
                    if(inchInput.value) {
                        inchInput.style.border = '2px solid #00863E';
                        inchInput.style.backgroundColor = 'rgb(249,249,249)';
                    } else {
                        inchInput.style.border = '2px solid red';
                        inchInput.style.backgroundColor = 'rgb(254,220,224)';
                    }
                });
            }
            if(typeof(emailInput) != 'undefined' && emailInput != null) {
                emailInput.addEventListener('change', function() {
                    if(emailInput.value && emailInput.value.match(/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/)) {
                        emailInput.style.border = '2px solid #00863E';
                        emailInput.style.backgroundColor = 'rgb(249,249,249)';
                    } else {
                        emailInput.style.border = '2px solid red';
                        emailInput.style.backgroundColor = 'rgb(254,220,224)';
                    }
                });
            }
            if(typeof(whatsappInput) != 'undefined' && whatsappInput != null) {
                whatsappInput.addEventListener('change', function() {
                    if(whatsappInput.value && whatsappInput.value.match(/^[0-9]*$/) && whatsappInput.value.length >= 10) {
                        whatsappInput.style.backgroundColor = 'rgb(249,249,249)';
                        whatsappInput.style.border = '2px solid #00863E';
                    } else {
                        whatsappInput.style.border = '2px solid red';
                        whatsappInput.style.backgroundColor = 'rgb(254,220,224)';
                    }
                });
            }
            if(typeof(ageInput) != 'undefined' && ageInput != null) {
                ageInput.addEventListener('change', function() {
                    if(ageInput.value && (ageInput.value >= 18 && ageInput.value <= 80)) {
                        ageInput.style.backgroundColor = 'rgb(249,249,249)';
                        ageInput.style.border = '2px solid #00863E';
                    } else {
                        ageInput.style.border = '2px solid red';
                        ageInput.style.backgroundColor = 'rgb(254,220,224)';
                    }
                });
            }
            if(typeof(descriptionInput) != 'undefined' && descriptionInput != null) {
                descriptionInput.addEventListener('change', function() {
                    // document.getElementById('descCount').innerHTML = descriptionInput.value.length + '/200';
                    if(descriptionInput.value && descriptionInput.value.length <= 500) {
                        descriptionInput.style.backgroundColor = 'rgb(249,249,249)';
                        descriptionInput.style.border = '2px solid #00863E';
                    } else {
                        descriptionInput.style.border = '2px solid red';
                        descriptionInput.style.backgroundColor = 'rgb(254,220,224)';
                    }
                });
            }
            if(typeof(casteInput) != 'undefined' && casteInput != null) {
                casteInput.addEventListener('change', function() {
                    if(casteInput.value && casteInput.value.match(/^(?![\s.]+$)[a-zA-Z\s.]*$/)) {
                        casteInput.style.border = '2px solid #00863E';
                        casteInput.style.backgroundColor = 'rgb(249,249,249)';
                    } else {
                        casteInput.style.border = '2px solid red';
                        casteInput.style.backgroundColor = 'rgb(254,220,224)';
                    }
                });
            }
            if(typeof(occupationInput) != 'undefined' && occupationInput != null) {
                occupationInput.addEventListener('change', function() {
                    if(occupationInput.value && occupationInput.value.match(/^(?![\s.]+$)[a-zA-Z\s.]*$/)) {
                        occupationInput.style.border = '2px solid #00863E';
                        occupationInput.style.backgroundColor = 'rgb(249,249,249)';
                    } else {
                        occupationInput.style.border = '2px solid red';
                        occupationInput.style.backgroundColor = 'rgb(254,220,224)';
                    }
                });
            }
        })
        .catch(function(error) {
            console.error('Error:', error);
        });
    }



    function update_user(event) {

        event.preventDefault();

        // Input group 1
        var relationshipInput = document.getElementById('relationship');
        var maritalStatusInput = document.getElementById('marital_status');
        var genderInput = document.getElementById('gender');
        var ageInput = document.getElementById('age');
        var feetInput = document.getElementById('feet');
        var inchInput = document.getElementById('inch');
        // Input group 2
        var educationInput = document.getElementById('education');
        var occupationInput = document.getElementById('occupation');
        var casteInput = document.getElementById('caste');
        var cityInput = document.getElementById('city');
        var descriptionInput = document.getElementById('description');
        // Input group 3
        var emailInput = document.getElementById('email');
        var whatsappInput = document.getElementById('whatsapp');
        var emailError = document.getElementById('email-error');
        
        // Get form values
        var user_id = document.getElementById('user_id').value;
        var relationship = document.getElementById('relationship').value;
        var email = document.getElementById('email').value;
        var whatsapp = document.getElementById('whatsapp').value;
        var gender = document.getElementById('gender').value;
        var age = document.getElementById('age').value;
        var userDescription = document.getElementById('description').value;
        var maritalStatus = document.getElementById('marital_status').value;
        var caste = document.getElementById('caste').value;
        var education = document.getElementById('education').value;
        var occupation = document.getElementById('occupation').value;
        var city = document.getElementById('city').value;
        var feet = document.getElementById('feet').value;
        var inch = document.getElementById('inch').value;


        var descriptionError = document.getElementById('descriptionError');
        var citySelectCheck = document.getElementById('city_selected');
        var citySelectCheckValue = document.getElementById('city_selected').value;

        var cityInArray = false;
        var cities = ["Karachi","Lahore","Faisalabad","Rawalpindi","Multan","Gujranwala","Hyderabad","Peshawar","Islamabad","Quetta","Sargodha","Sialkot","Bahawalpur","Sukkur","Jhang","Sheikhupura","Mardan","Gujrat","Larkana","Kasur","Rahim Yar Khan","Sahiwal","Okara","Wah","Dera Ghazi Khan","Mingora","Chiniot","Mirpur Khas","Nawabshah","Kamoke","Burewala","Jhelum","Sadiqabad","Khanewal","Hafizabad","Kohat","Jacobabad","Shikarpur","Muzaffargarh","Khanpur","Gojra","Bahawalnagar","Abbottabad","Muridke","Khuzdar","Pakpattan","Jaranwala","Chishtian","Daska","Mandi Bahauddin","Ahmadpur East","Kamalia","Tando Adam","Khairpur","Dera Ismail Khan","Vehari","Nowshera","Dadu, Pakistan","Wazirabad","Khushab","Charsadda","Swabi","Chakwal","Mianwali","Turbat","Tando Allahyar","Kot Adu","Chaman","Hub, Balochistan","Arifwala","Chichawatni","Kharian","Taxila","Layyah","Hasilpur","Attock","Jalalpur","Bhakkar","Lodhran","Mian Channu","Shorkot","Harunabad","Bhalwal","Kandhkot","Lalamusa","Kot Abdul Malik","Toba Tek Singh","Pattoki","Kahror Pacca","Chuhar Kana","Gujar Khan","Narowal","Tando Muhammad Khan","Shujabad","Sibi","Badin","Kotri","Dipalpur","Pano Aqil","Shabqadar","Shahdadkot","Phool Nagar","Moro","Ferozwala","Sammundri","Mailsi","Shahdadpur","Mansehra","Qambar","Haveli Lakha","Zhob","Gwadar","Jampur","Takht-i-Bahi","Shakargarh","Sangla Hill","Nankana Sahib","Sambrial","Haripur, Pakistan","Bannu","Hujra Shah Muqeem","Ghotki","Kabirwala","Sanghar","Chunian","Gakhars","Timergara","Dera Murad Jamali","Pasrur","Dera Allah Yar","Usta Mohammad","Rajanpur","Rabwah","Dullewala","Qila Didar Singh","Rohri","Shahkot, Pakistan","Hadali","Jauharabad","Batkhela","Alipur Chatha","Kot Radha Kishan","Kahna Nau","Dina, Pakistan","Matli","Jatoi","Taunsa Sharif","Abdul Hakeem","Hasan Abdal","Mirpur Mathelo","Sarai Alamgir","Loralai","Kamra","Mustafabad, Punjab","Hala, Sindh","Talagang","Ratodero","Basirpur","Khalabat Township","Tank, Pakistan","Fort Abbas","Kot Moman","Nowshera Virkan","Tandlianwala","Thatta","Ludhewala Waraich","Dinga","Kundian","Pasni (city)","Chowk Azam","Havelian","Risalpur","Umerkot","Sahiwal","Pabbi","Jalalpur Pirwala","Chak Jhumra","Liaqauatpur","Renala Khurd","Sehwan Sharif","Jehangira","Bhera","Lakki Marwat","Topi, Khyber Pakhtunkhwa","Malakwal","Hangu, Pakistan","Chitral","Daharki","Kharan, Pakistan","Pir Mahal","Khurrianwala","Pindigheb","Pindi Bhattian","Badah","Narang, Gujrat","Zāhir Pīr","Dunyapur","Mastung, Pakistan","Alipur Chatha","Lalian"];

        if (cities.includes(cityInput.value)) {
            cityInArray = true;
        }

        var isValidDescription = !userDescription || (userDescription.length >= 50 && userDescription.length <= 500);


        console.log(citySelectCheckValue);
        // console.log(relationship, email, whatsapp, gender, age, userDescription, maritalStatus, caste, education, occupation, city, feet, inch);

        // Validate form values
        if (
            !user_id ||
            !relationship ||
            !email ||
            !whatsapp ||
            !gender ||
            !age ||
            !isValidDescription ||
            !maritalStatus ||
            !caste ||
            !education ||
            !occupation ||
            !city || !citySelectCheckValue || !cityInArray ||
            !feet ||
            !inch
        ) {
            console.log('Please fill in all the fields.');
            // Email
            if(emailInput.value && emailInput.value.match(/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/)) {
                emailInput.style.border = '2px solid #00863E';
                emailInput.style.backgroundColor = 'rgb(249,249,249)';
            } else {
                emailInput.style.border = '2px solid red';
                emailInput.style.backgroundColor = 'rgb(254,220,224)';
            }
            // Whatsapp
            if(whatsappInput.value && whatsappInput.value.match(/^[0-9]*$/) && whatsappInput.value.length >= 10) {
                whatsappInput.style.border = '2px solid #00863E';
                whatsappInput.style.backgroundColor = 'rgb(249,249,249)';
            } else {
                whatsappInput.style.border = '2px solid red';
                whatsappInput.style.backgroundColor = 'rgb(254,220,224)';
            }
            // Occupation
            if(occupationInput.value && occupationInput.value.match(/^(?![\s.]+$)[a-zA-Z\s.]*$/)) {
                occupationInput.style.border = '2px solid #00863E';
                occupationInput.style.backgroundColor = 'rgb(255,255,255)';
            } else {
                occupationInput.style.border = '2px solid red';
                occupationInput.style.backgroundColor = 'rgb(254,220,224)';
            }
            // Caste
            if(casteInput.value && casteInput.value.match(/^(?![\s.]+$)[a-zA-Z\s.]*$/)) {
                casteInput.style.border = '2px solid #00863E';
                casteInput.style.backgroundColor = 'rgb(249,249,249)';
            } else {
                casteInput.style.border = '2px solid red';
                casteInput.style.backgroundColor = 'rgb(254,220,224)';
            }
            // Description
            if(descriptionInput.value && descriptionInput.value.length <= 500 && descriptionInput.value.length >= 50) {
                descriptionInput.style.backgroundColor = 'rgb(249,249,249)';
                descriptionInput.style.border = '2px solid #00863E'; 
                descriptionError.innerHTML = "";
            } else if(descriptionInput.value && descriptionInput.value.length <= 50) {
                descriptionInput.style.border = '2px solid red';
                descriptionInput.style.backgroundColor = 'rgb(254,220,224)';
                descriptionError.innerHTML = "<div>Description too short</div>";
            } else {
                descriptionInput.style.border = '2px solid red';
                descriptionInput.style.backgroundColor = 'rgb(254,220,224)';
                descriptionError.innerHTML = "<div>Description too long</div>";
            }
            // Age
            if(ageInput.value && (ageInput.value >= 18 && ageInput.value <= 80)) {
                ageInput.style.border = '2px solid #00863E';
                ageInput.style.backgroundColor = 'rgb(249,249,249)';
            } else {
                ageInput.style.border = '2px solid red';
                ageInput.style.backgroundColor = 'rgb(254,220,224)';
            }
            // Height
            if(feetInput.value) {
                feetInput.style.border = '2px solid #00863E';
                feetInput.style.backgroundColor = 'rgb(249,249,249)';
            } else {
                feetInput.style.border = '2px solid red';
                feetInput.style.backgroundColor = 'rgb(254,220,224)';
            }
            if(inchInput.value) {
                inchInput.style.border = '2px solid #00863E';
                inchInput.style.backgroundColor = 'rgb(249,249,249)';
            } else {
                inchInput.style.border = '2px solid red';
                inchInput.style.backgroundColor = 'rgb(254,220,224)';
            }
            
            
            // Relationship
            if(relationshipInput.value) {
                document.getElementById('relationshipTrigger').style.border = '2px solid #00863E';
                document.getElementById('relationshipTrigger').style.backgroundColor = 'rgb(249,249,249)';
            } else {
                document.getElementById('relationshipTrigger').style.border = '2px solid red';
                document.getElementById('relationshipTrigger').style.backgroundColor = 'rgb(254,220,224)';
            }
            // Marital Status
            if(maritalStatusInput.value) {
                document.getElementById('maritalStatusTrigger').style.border = '2px solid #00863E';
                document.getElementById('maritalStatusTrigger').style.backgroundColor = 'rgb(249,249,249)';
            } else {
                document.getElementById('maritalStatusTrigger').style.border = '2px solid red';
                document.getElementById('maritalStatusTrigger').style.backgroundColor = 'rgb(254,220,224)';
            }
            // Gender
            if(genderInput.value) {
                document.getElementById('genderTrigger').style.border = '2px solid #00863E';
                document.getElementById('genderTrigger').style.backgroundColor = 'rgb(249,249,249)';
            } else {
                document.getElementById('genderTrigger').style.border = '2px solid red';
                document.getElementById('genderTrigger').style.backgroundColor = 'rgb(254,220,224)';
            }
            // Education
            if(educationInput.value) {
                document.getElementById('educationTrigger').style.border = '2px solid #00863E';
                document.getElementById('educationTrigger').style.backgroundColor = 'rgb(249,249,249)';
            } else {
                document.getElementById('educationTrigger').style.border = '2px solid red';
                document.getElementById('educationTrigger').style.backgroundColor = 'rgb(254,220,224)';
            }
            // City
            if(citySelectCheck.value && cityInArray) {
                if(cityInput.value) {
                    cityInput.style.border = '2px solid #00863E';
                    cityInput.style.backgroundColor = 'rgb(249,249,249)';
                } else {
                    cityInput.style.border = '2px solid red';
                    cityInput.style.backgroundColor = 'rgb(254,220,224)';
                }
            } else {
                if (cities.includes(cityInput.value)) {
                    cityInArray = false;
                } else {
                    cityInArray = true;
                }
                consol.log(citySelectCheck.value, cityInArray);
                cityInput.style.border = '2px solid red';
                cityInput.style.backgroundColor = 'rgb(254,220,224)';
            }
            return;
        } else {
            // Create FormData object
            var formData = new FormData();
            formData.append('update_user', 'true');
            formData.append('user_id', user_id);
            formData.append('relationship', relationship);
            formData.append('email', email);
            formData.append('whatsapp0', whatsapp);
            formData.append('gender', gender);
            formData.append('age', age);
            formData.append('description', userDescription);
            formData.append('marital_status', maritalStatus);
            formData.append('caste', caste);
            formData.append('education', education);
            formData.append('occupation', occupation);
            formData.append('city', city);
            formData.append('feet', feet);
            formData.append('inch', inch);
    
            // Send AJAX request
            fetch('../controllers/user-handler.php', {
                method: 'POST',
                body: formData
            })
            .then(function(response) {
                return response.text();
            })
            .then(function(data) {
                console.log(data);
                // Handle response
                if (data === '1') {
                    window.location.href = './users';
                    // Update successful
                } else {
                    // Update failed
                }
            })
            .catch(function(error) {
                console.error(error);
                // Handle error
            });
        }
    }

    function update_status(pagename, status, id) {

        // Create FormData object
        var formData = new FormData();

        formData.append('update_user_status', 'true');
        formData.append('id', id);
        formData.append('status', status);

        // Send AJAX request
        fetch('./controllers/user-handler.php', {
            method: 'POST',
            body: formData
        })
        .then(function(response) {
            return response.text();
        })
        .then(function(data) {
            // Handle response
            if (data === '1') {
                window.location.href = './' + pagename + '?tab=approved';
            }
        })
        .catch(function(error) {
            console.error(error);
            // Handle error
        });
    }


    function delete_user_img(event, photo, id, gender) {
        event.preventDefault();

        // Create FormData object
        var formData = new FormData();
        formData.append('delete_user_img', 'true');
        formData.append('photo', photo);
        formData.append('user_id', id);

        // Send AJAX request
        fetch('./controllers/user-handler.php', {
            method: 'POST',
            body: formData
        })
        .then(function(response) {
            return response.text();
        })
        .then(function(data) {
            console.log(data);
            // Handle response
            if (data === '1') {
                $('#user-uploaded-img').css('display', 'none');
                $('#default-'+gender).css('display', 'block');
                console.log('Image deleted');
            } else {
                console.log('There was an error');
            }
        })
        .catch(function(error) {
            console.error(error);
            // Handle error
        });
    }
</script>


<script defer>
    function filterCities() {
        const searchInput = document.getElementById('searchInput');
        const cityDropdown = document.getElementById('cityDropdown');
        const searchText = searchInput.value.trim().toLowerCase();
        cityDropdown.innerHTML = ''; // Clear previous options

        if (!searchText) {
            cityDropdown.style.display = 'none'; // Hide the dropdown if no search text
            return;
        }

        const matchedCities = cities.filter(city => city.toLowerCase().includes(searchText));

        if (matchedCities.length > 0) {
            cityDropdown.style.display = 'block'; // Show the dropdown if there are matches
            matchedCities.forEach(city => {
                const option = document.createElement('span');
                option.className = 'option select-option';
                option.id = 'listItem';
                option.innerHTML = city;
                option.onclick = function() {
                    filterCity(this.id);
                };
                cityDropdown.appendChild(option);
            });
        } else {
            cityDropdown.style.display = 'none'; // Hide the dropdown if no matches
        }
    }
    function filterCity(id) {
        const selectedCity = document.getElementById(id).innerText;
        document.getElementById('searchInput').value = selectedCity;
        document.getElementById('cityDropdown').style.display = 'none'; // Hide the dropdown after selection
    }
    function searchCity() {
        const cities = ["Karachi","Lahore","Faisalabad","Rawalpindi","Multan","Gujranwala","Hyderabad","Peshawar","Islamabad","Quetta","Sargodha","Sialkot","Bahawalpur","Sukkur","Jhang","Sheikhupura","Mardan","Gujrat","Larkana","Kasur","Rahim Yar Khan","Sahiwal","Okara","Wah","Dera Ghazi Khan","Mingora","Chiniot","Mirpur Khas","Nawabshah","Kamoke","Burewala","Jhelum","Sadiqabad","Khanewal","Hafizabad","Kohat","Jacobabad","Shikarpur","Muzaffargarh","Khanpur","Gojra","Bahawalnagar","Abbottabad","Muridke","Khuzdar","Pakpattan","Jaranwala","Chishtian","Daska","Mandi Bahauddin","Ahmadpur East","Kamalia","Tando Adam","Khairpur","Dera Ismail Khan","Vehari","Nowshera","Dadu, Pakistan","Wazirabad","Khushab","Charsadda","Swabi","Chakwal","Mianwali","Turbat","Tando Allahyar","Kot Adu","Chaman","Hub, Balochistan","Arifwala","Chichawatni","Kharian","Taxila","Layyah","Hasilpur","Attock","Jalalpur","Bhakkar","Lodhran","Mian Channu","Shorkot","Harunabad","Bhalwal","Kandhkot","Lalamusa","Kot Abdul Malik","Toba Tek Singh","Pattoki","Kahror Pacca","Chuhar Kana","Gujar Khan","Narowal","Tando Muhammad Khan","Shujabad","Sibi","Badin","Kotri","Dipalpur","Pano Aqil","Shabqadar","Shahdadkot","Phool Nagar","Moro","Ferozwala","Sammundri","Mailsi","Shahdadpur","Mansehra","Qambar","Haveli Lakha","Zhob","Gwadar","Jampur","Takht-i-Bahi","Shakargarh","Sangla Hill","Nankana Sahib","Sambrial","Haripur, Pakistan","Bannu","Hujra Shah Muqeem","Ghotki","Kabirwala","Sanghar","Chunian","Gakhars","Timergara","Dera Murad Jamali","Pasrur","Dera Allah Yar","Usta Mohammad","Rajanpur","Rabwah","Dullewala","Qila Didar Singh","Rohri","Shahkot, Pakistan","Hadali","Jauharabad","Batkhela","Alipur Chatha","Kot Radha Kishan","Kahna Nau","Dina, Pakistan","Matli","Jatoi","Taunsa Sharif","Abdul Hakeem","Hasan Abdal","Mirpur Mathelo","Sarai Alamgir","Loralai","Kamra","Mustafabad, Punjab","Hala, Sindh","Talagang","Ratodero","Basirpur","Khalabat Township","Tank, Pakistan","Fort Abbas","Kot Moman","Nowshera Virkan","Tandlianwala","Thatta","Ludhewala Waraich","Dinga","Kundian","Pasni (city)","Chowk Azam","Havelian","Risalpur","Umerkot","Sahiwal","Pabbi","Jalalpur Pirwala","Chak Jhumra","Liaqauatpur","Renala Khurd","Sehwan Sharif","Jehangira","Bhera","Lakki Marwat","Topi, Khyber Pakhtunkhwa","Malakwal","Hangu, Pakistan","Chitral","Daharki","Kharan, Pakistan","Pir Mahal","Khurrianwala","Pindigheb","Pindi Bhattian","Badah","Narang, Gujrat","Zāhir Pīr","Dunyapur","Mastung, Pakistan","Alipur Chatha","Lalian"];

        const inputText = document.getElementById("city").value.trim();
        const dropdown = document.getElementById("cityDropdown");
        dropdown.innerHTML = "";

        if (inputText.length > 0) {
            for (const city of cities) {
                if (city.toLowerCase().includes(inputText.toLowerCase())) {
                    const spanElement = document.createElement("span");
                    spanElement.classList.add("option");
                    spanElement.id = city;
                    spanElement.onclick = function () {
                        selectCity(this.id);
                    };
                    spanElement.textContent = city;
                    dropdown.appendChild(spanElement);
                }
            }
            dropdown.classList.remove("hideDropdown");
            dropdown.classList.add("showDropdown");
        } else {
            dropdown.classList.remove("showDropdown");
            dropdown.classList.add("hideDropdown");
        }
    }
    function selectCity(id) {
        //   document.getElementById("selectedCity").textContent = id;
        document.getElementById("city").value = id;
        document.getElementById('city_selected').value = '1';
        //   selectDropdown("cityTrigger");
        //   document.getElementById("selectedCity").classList.add("selected-option");

        //   var cityTrigger = document.getElementById("cityTrigger");
        document.getElementById("city").style.border = "2px solid #00863E";
        document.getElementById("city").style.backgroundColor = "rgb(249,249,249)";
        document.getElementById("city").style.color = "#000";

        const dropdown = document.getElementById("cityDropdown");
        dropdown.classList.remove("showDropdown");
        dropdown.classList.add("hideDropdown");
    }
    function checkDuplicateEmail(event) {
        var emailVal = document.getElementById('email').value;
        console.log(emailVal);
        if(emailVal) {
            $.ajax({
                url : "../controllers/user-handler", // Url of backend (can be python, php, etc..)
                type: "POST", // data type (can be get, post, put, delete)
                // headers: {  'Access-Control-Allow-Origin': 'http://localhost/samba_jiu_jitsu/' },
                data : "email="+emailVal+"&check_duplicate=true", // data in json format
                async : false, // enable or disable async (optional, but suggested as false if you need to populate data afterwards)
                success: function(response, textStatus, jqXHR) {
                    $('#email-error').html(response);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log(jqXHR);
                    console.log(textStatus);
                    console.log(errorThrown);
                }
            });
        }
    } 
</script>



<?php include './footer.php'; ?>