<?php include './partials/header.php'; ?>
<?php include './partials/navigation.php'; ?>

<link rel="stylesheet" href="./css/register.css?v=50">

<div id="popBg" onclick='hidePopupBg()'></div>
<div id="loader"></div>


<style>
    #confirmation-success {
        padding: 50px;
        width: 400px;
        position: fixed;
        top: 300px;
        left: 50%; 
        z-index: 100;
        margin-left: -200px; 
        border-radius: 21px;
        background: #FFFFFF;
        box-shadow: 0px 2px 10px 0px #00000026;
        text-align: center;
        font-family: sans-serif;
    }
    .popup-subtitle p {
        font-family: 'Roboto', sans-serif;
        font-size: 18px;
        font-weight: 600;
        line-height: 26px;
        letter-spacing: 0em;
        text-align: center;
        color: #7E7E7E;
    }
    #confirmation-success .popup-title {  
        font-family: 'Roboto', sans-serif;
        font-size: 20px;
        font-weight: 600;
        line-height: 26px;
        letter-spacing: 0em;
        text-align: center;
        color: #000;
    }
    #confirmation-success .popup-subtitle {
        margin: 10px 0;
    }
    #confirmation-success form.verify-code input {
        color: #ADADAD;
        border: 2px solid #ADADAD;
        padding: 10px 20px;
        radius: 7px;
    }
    #confirmation-success input::-webkit-outer-spin-button,
    #confirmation-success input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
    #confirmation-success input[type=number] {
        -moz-appearance: textfield;
    }
    #confirmation-success form.verify-code .form-group {
        display: flex;
    }
    #confirmation-success form.verify-code div.submit {
        padding: 10px 20px;
        border-radius: 7px;
        background: #FFB600;
        color: #0E0E0E;
        width: 100%;
        cursor: pointer;
        transition: .4s;
    }
    #confirmation-success form.verify-code div.submit:hover {
        background: #ffc73c;
    }
    #reset-success .icon {
        width: 65px;
        height: 65px;
        margin: 0 auto 10px auto;
    }
    #reset-success .icon img {
        width: 100%;
        height: 100%;
    }
    /* Define the CSS class for the rotation animation */
    .rotate {
        animation: rotateAnimation .8s linear infinite;
    }
    /* Define the CSS animation keyframes for the rotation */
    @keyframes rotateAnimation {
        from {
            transform: rotate(0deg);
        }
        to {
            transform: rotate(360deg);
        }
    }
    textarea {
        font-family: 'Roboto', sans-serif;
    }
    @media screen and (max-width: 576px) {
        #confirmation-success {
            width: 85%;
            margin-left: -42.5%;
        }
    }
    @media screen and (max-width: 424px) {
        #confirmation-success {
            width: 95%;
            margin-left: -47.5%;
            padding: 30px;       
        }
    }
</style>



<!-- Waiting popup -->
<div class='popup hide_popup' id='confirmation-success'>
    <div class='popup-inner-div'>
        <div class='icon'>
            <!-- <i class="fa fa-check"></i> -->
            <img id='loading-svg' src="assets/svg/loading-icon.svg" alt="Loading..">
        </div>
        <div class='popup-subtitle'>
            <p>Please wait..</p>
        </div>
        <div class='popup-title'>We are Creating your Profile</div>
    </div>
</div>
    


<style>
    .profile-placeholder {
        display: flex;
        align-items: center;
        justify-content: center;
    }
    #err {
        display: none;
        padding: 8px 30px;
        border-radius: 30px;
        background: #D70000;
        margin: 0 auto;
        font-size: 16px;
        position: absolute;
        color: #fff;
    }
    #err.s {
        display: block;
    }
    .selected-option {
        font-weight: 500;
    }
    textarea#description {
        font-weight: 500;
    }
</style>

<form autocomplete="off" id="create-profile" class='form' autocomplete='off' runat="server"  method='post' content-type='application/x-www-form-urlencoded' action='https://ipguat.apps.net.pk/Ecommerce/api/Transaction/PostTransaction'>
    <div class='register'>
        <div class='form-cards'>

            <!-- Card 1 -->
            <div class='form-card' id='form-card-1'>

                <div class='form-card-header'>
                    <div class='form-heading'>
                        <h3>Create Profile</h3>
                    </div>
                    <div class='form-subheading'>
                        <p>It takes 2 minutes only!</p>
                    </div>
                </div>

                <!-- STEPS -->
                <div class='registration-progress'>
                    <div class='progress-bar'>
                        <div class='circle-wrapper'>
                            <div class='circle'></div>
                            <div>Step 1</div>
                        </div>
                        <div class='bottom-div'>
                            <div></div>
                        </div>
                    </div>
                    <div>
                        <div class='circle-wrapper'>
                            <div class='circle'></div>
                            <div>Step 2</div>
                        </div>
                        <div class='bottom-div'>
                            <div></div>
                        </div>
                    </div>
                    <div>
                        <div class='circle-wrapper'>
                            <div class='circle'></div>
                            <div>Finish</div>
                        </div>
                        <div class='bottom-div'>
                            <div></div>
                        </div>
                    </div>
                </div>

                <div class='form-card-body'>
                    <div class='input-group'>
                        <div class='input-row'>
                            <div class='input-col input-col-1'>
                                <label for="relationship">Profile for</label>
                            </div>
                            <div class='input-col input-col-2'>                            
                                <div class='selection'>
                                    <div id='relationshipTrigger' class='selection-trigger' onclick='selectDropdown(this.id);'>
                                        <div id='selectedRelationship'>Select</div> 
                                        <i style='color: gray;margin-top:3px;' class="ion-chevron-down" aria-hidden="true"></i>
                                    </div>
                                    <div class='dropdown hideDropdown' id='relationshipDropdown'>
                                        <input type='hidden' id='relationship' name='relationship' value=''>
                                        <span class='option select-option' id='Myself' onclick='selectRelationship(this.id);profileForDropdown(this.id)'>Myself</span>
                                        <span class='option select-option' id='Daughter' onclick='selectRelationship(this.id);profileForDropdown(this.id)'>Daughter</span>
                                        <span class='option select-option' id='Son' onclick='selectRelationship(this.id);profileForDropdown(this.id)'>Son</span>
                                        <span class='option select-option' id='Brother' onclick='selectRelationship(this.id);profileForDropdown(this.id)'>Brother</span>
                                        <span class='option select-option' id='Sister' onclick='selectRelationship(this.id);profileForDropdown(this.id)'>Sister</span>
                                    </div>
                                </div>
                                <div class='error' id='fullnameError'></div>
                            </div>
                        </div>           
                    </div>
                    <div class='input-group'>
                        <div class='input-row'>
                            <div class='input-col input-col-1'>
                                <label for="relationship">Marital Status</label>
                            </div>
                            <div class='input-col input-col-2'>                            
                                <div class='selection'>
                                    <div id='maritalStatusTrigger' class='selection-trigger' onclick='selectDropdown(this.id);'>
                                        <div id='selectedMaritalStatus'>Select</div> 
                                        <i style='color: gray;margin-top:3px;' class="ion-chevron-down" aria-hidden="true"></i>
                                    </div>
                                    <div class='dropdown hideDropdown' id='maritalStatusDropdown'>
                                        <input type='hidden' id='marital_status' name='marital_status' value=''>
                                        <span class='option select-option' id='Never Married' onclick='selectMaritalStatus(this.id);'>Never Married</span>
                                        <span class='option select-option' id='Married' onclick='selectMaritalStatus(this.id);'>Married</span>
                                        <span class='option select-option' id='Divorced' onclick='selectMaritalStatus(this.id);'>Divorced</span>
                                        <span class='option select-option' id='Widowed' onclick='selectMaritalStatus(this.id);'>Widowed</span>
                                        <span class='option select-option' id='Separated' onclick='selectMaritalStatus(this.id);'>Separated</span>
                                    </div>
                                </div>
                                <div class='error' id='fullnameError'></div>
                            </div>
                        </div>           
                    </div>
                    <div class='input-group'>
                        <div class='input-row'>
                            <div class='input-col input-col-1'>
                                <label for="gender">Gender</label>
                            </div>
                            <div class='input-col input-col-2'>                            
                                <div class='selection'>
                                    <div style='text-transform: capitalize;' id='genderTrigger' class='selection-trigger' onclick='selectDropdown(this.id);'>
                                        <div id='selectedGender'>Select</div> 
                                        <i style='color: gray;margin-top:3px;' class="ion-chevron-down" aria-hidden="true"></i>
                                    </div>
                                    <div class='dropdown hideDropdown' id='genderDropdown'>
                                        <input type='hidden' id='gender' name='gender' value=''>
                                        <span class='option select-option' id='male' onclick='selectGender(this.id);'>Male</span>
                                        <span class='option select-option' id='female' onclick='selectGender(this.id);'>Female</span>
                                    </div>
                                </div>
                                <div class='error' id='genderError'></div>
                            </div>
                        </div>           
                    </div>
                    <div class='input-group'>
                        <div class='input-row'>
                            <div class='input-col input-col-1'>
                                <label for="age">Age</label>
                            </div>
                            <div class='input-col input-col-2'>
                                <input type='number' step='1' min="18" max='80' class='age' name='age' id='age' placeholder='18-70'>
                                <div class='error' id='ageError'></div>
                            </div>
                        </div>           
                    </div>
                    <div class='input-group'>
                        <div class='input-row'>
                            <div class='input-col input-col-1'>
                                <label for="height">Height</label>
                            </div>
                            <style>
                                .input-row-group {
                                    width: 100%;
                                    display: grid;
                                    grid-template-columns: 1fr 1fr;
                                    column-gap: 20px;
                                }
                            </style>
                            <div class='input-row-group'>
                                <div class='input-col'>
                                    <input type='number' step='1' min="1" max='8' class='feet' name='feet' id='feet' placeholder='Feet'>
                                    <div class='error' id='feetError'></div>
                                </div>
                                <div class='input-col'>
                                    <input type='number' step='1' min="0" max='11' class='inch' name='inch' id='inch' placeholder='Inch'>
                                    <div class='error' id='inchError'></div>
                                </div>
                            </div>
                        </div>           
                    </div>

                </div>


                <div class='form-card-footer'>
                    <div id='card-1-next' class='formSubmit packageSubmit' onclick='toggleCards(this.id);'>
                        Next
                    </div>
                </div>
            </div>
            <!-- Card 2 -->
            <div class='form-card' id='form-card-2'>
            <!-- <div class='form-card' id='form-card-2' style='display: flex; position: static; opacity: 1;'> -->
                <div class='form-card-header'>
                    <div class='form-heading'>
                        <h3>Proposal Details</h3>
                    </div>
                    <div class='form-subheading'>
                        <p>Write a Clear Description</p>
                    </div>
                </div>
                <!-- STEPS -->
                <div class='registration-progress'>
                    <div class='progress-bar'>
                        <div class='circle-wrapper'>
                            <div class='check'>
                                <i class='ion-checkmark'></i>
                            </div>
                            <div>Step 1</div>
                        </div>
                        <div class='bottom-div'>
                            <div></div>
                        </div>
                    </div>
                    <div class='progress-bar'>
                        <div class='circle-wrapper'>
                            <div class='circle'></div>
                            <div>Step 2</div>
                        </div>
                        <div class='bottom-div'>
                            <div></div>
                        </div>
                    </div>
                    <div>
                        <div class='circle-wrapper'>
                            <div class='circle'></div>
                            <div>Finish</div>
                        </div>
                        <div class='bottom-div'>
                            <div></div>
                        </div>
                    </div>
                </div>
                <div class='form-card-body'>
                    <div class='input-group'>
                        <div class='input-row'>
                            <div class='input-col input-col-1'>
                                <label for="education">Education</label>
                            </div>
                            <div class='input-col input-col-2'>                            
                                <div class='selection'>
                                    <div id='educationTrigger' class='selection-trigger' onclick='selectDropdown(this.id);'>
                                        <div id='selectedEducation'>Select</div> 
                                        <i style='color: gray;margin-top:3px;' class="ion-chevron-down" aria-hidden="true"></i>
                                    </div>
                                    <div class='dropdown hideDropdown' id='educationDropdown'>
                                        <input type='hidden' id='education' name='education' value=''>
                                        <span class='option select-option' id='Under matric' onclick='selectEducation(this.id);'>Under matric</span>
                                        <span class='option select-option' id='Matric' onclick='selectEducation(this.id);'>Matric</span>
                                        <span class='option select-option' id='Intermediate' onclick='selectEducation(this.id);'>Intermediate</span>
                                        <span class='option select-option' id='Bachelors' onclick='selectEducation(this.id);'>Bachelors</span>
                                        <span class='option select-option' id='Masters' onclick='selectEducation(this.id);'>Masters</span>
                                        <span class='option select-option' id='PhD' onclick='selectEducation(this.id);'>PhD</span>
                                    </div>
                                </div>
                                <div class='error' id='fullnameError'></div>
                            </div>
                        </div>           
                    </div>
                    <div class='input-group'>
                        <div class='input-row'>
                            <div class='input-col input-col-1'>
                                <label for="occupation">Occupation/Profession</label>
                            </div>
                            <div class='input-col input-col-2'>
                                <input type='text' class='occupation' name='occupation' id='occupation' placeholder='Business, Job, Doctor etc'>
                                <div class='error' id='occupationError'></div>
                            </div>
                        </div>           
                    </div>
                    <div class='input-group'>
                        <div class='input-row'>
                            <div class='input-col input-col-1'>
                                <label for="caste">Caste</label>
                            </div>
                            <div class='input-col input-col-2'>
                                <input type='text' class='caste' name='caste' id='caste' placeholder='Hashmi, Rajpoot, Arain etc'>
                                <div class='error' id='casteError'></div>
                            </div>
                        </div>           
                    </div>
                    <div class='input-group'>
                        <div class='input-row'>
                            <div class='input-col input-col-1'>
                                <label for="city">City</label>
                            </div>
                            <div class='input-col input-col-2'>                            
                                <div class='selection'>
                                    <input type="hidden" id="city_selected" name="city_selected" value="" />
                                    <input type="text" id="city" name="city" oninput="searchCity()" />
                                    <div style='max-height: 280px; overflow-Y: scroll;' class='dropdown hideDropdown' id='cityDropdown'>
                                        <!-- <span class='option select-option' id='Lahore' onclick='selectCity(this.id);'>Lahore</span> -->
                                        <?php
                                            // // Get cities
                                            // $cities = getCities();

                                            // // Generate the HTML string
                                            // $htmlString = createHTMLStringFromArrayRegister($cities);

                                            // // Echo the result
                                            // echo $htmlString;
                                        ?>
                                    </div>
                                </div>
                                <div class='error' id='fullnameError'></div>
                            </div>
                        </div>           
                    </div>
                    <div class='input-group'>
                        <div class='input-row'>
                            <div class='input-col input-col-3 desc-input'>
                                <label for="description">Description (Rishta Statement)</label>
                                <textarea name="description" id="description" class="description" cols="30" rows="5" placeholder='Example: Our daughter/son is educated, have govt job. We are looking for a respectful and educated family.'></textarea>
                                <div class='count' id='descCount'></div>
                                <div class='error' id='descriptionError' style='margin-top: -10px;'></div>
                            </div>
                        </div>           
                    </div>
                </div>
                <div class='form-card-footer'>
                    <div class='form-card-btns'>
                        <div id='card-2-back' class='formSubmit formBack' onclick='toggleCards(this.id);'>
                            Back
                        </div>
                        <div id='card-2-next' class='formSubmit packageSubmit' onclick='toggleCards(this.id);'>
                            Next
                        </div>
                    </div>

                </div>
            </div>
            <!-- Card 3 -->
            <div class='form-card' id='form-card-3'>
                <div class='form-card-header'>
                    <div class='form-heading'>
                        <h3>Account Details</h3>
                    </div>
                    <div class='form-subheading'>
                        <p>Check Before Submitting</p>
                    </div>
                </div>
                <!-- STEPS -->
                <div class='registration-progress'>
                    <div class='progress-bar'>
                        <div class='circle-wrapper'>
                            <div class='check'>
                                <i class='ion-checkmark'></i>
                            </div>
                            <div>Step 1</div>
                        </div>
                        <div class='bottom-div'>
                            <div></div>
                        </div>
                    </div>
                    <div class='progress-bar'>
                        <div class='circle-wrapper'>
                            <div class='check'>
                                <i class='ion-checkmark'></i>
                            </div>
                            <div>Step 2</div>
                        </div>
                        <div class='bottom-div'>
                            <div></div>
                        </div>
                    </div>
                    <div>
                        <div class='circle-wrapper'>
                            <div class='circle'></div>
                            <div>Finish</div>
                        </div>
                        <div class='bottom-div'>
                            <div></div>
                        </div>
                    </div>
                </div>
                <div class='form-card-body'>
                    <div class='input-group'>
                        <div class='input-row'>
                            <div class='input-col input-col-1'>
                                <label for="email">Email</label>
                            </div>
                            <div class='input-col email-col input-col-2'>
                                <input onchange="checkDuplicateEmail(event);" type='text' class='email' name='email' id='email' placeholder='suleyman1@gmail.com'>
                                <div class='error' id='email-error'></div>
                            </div>
                        </div>           
                    </div>
                    <div class='input-group'>
                        <div class='input-row'>
                            <div class='input-col input-col-1'>
                                <label for="whatsapp">WhatsApp #</label>
                            </div>
                            <div class='input-col input-col-2'>
                                <input type='number' class='whatsapp' name='whatsapp' id='whatsapp' placeholder='03335528850'>
                                <div class='error' id='whatsappError'></div>
                            </div>
                        </div>           
                    </div>
                    <div class='input-group'>
                        <div class='input-row'>
                            <div class='input-col input-col-1'>
                                <label for="password">Set a Password</label>
                            </div>
                            <div class='input-col input-col-2'>
                                <input type='password' class='password' name='password' id='password' placeholder='******'>
                                <div class='error' id='pwdError'></div>
                            </div>
                        </div>           
                    </div>
                    <div class='input-group'>
                        <div class='input-row'>
                            <div class='input-col input-col-1'>
                                <label for="confirm_password">Confirm Password</label>
                            </div>
                            <div class='input-col input-col-2'>
                                <input type='password' class='confirm_password' name='confirm_password' id='confirm_password' placeholder='******'>
                                <div class='error' id='confirmPwdError'></div>
                            </div>
                        </div>           
                    </div>
                    <!-- TOS Agreement -->
                    <div id="agreement-check-wrapper">
                        <p>
                            <input class="input" id="tos_agreement" type="checkbox" name="tos_agreement">
                            I agree to the
                            <a class="tac" href="./terms-of-service" target="_blank">Terms &amp; Conditions</a>
                            and
                            <a class="tac" href="./privacy-policy" target="_blank">Privacy Policy</a>
                        </p>
                        <div class="error" id="agreementError"></div>
                    </div>
                </div>
                <div class='form-card-footer'>
                    <div class='form-card-btns'>
                        <div id='card-3-back' class='formSubmit formBack' onclick='toggleCards(this.id);'>
                            Back
                        </div>
                        <div id='card-3-next' class='formSubmit packageSubmit' onclick='toggleCards(this.id);'>
                            Next
                        </div>
                    </div>
                </div>
            </div>
            <!-- Card 4 -->
            <div class='form-card' id='form-card-4'>
                <div class='form-card-header'>
                    <div class='form-heading'>
                        <h3>Upload Photo</h3>
                    </div>
                    <div class='form-subheading'>
                        <p>(OPTIONAL, NOT REQUIRED)</p>
                    </div>
                </div>
                <!-- STEPS -->
                <div class='registration-progress'>
                    <div class='progress-bar'>
                        <div class='circle-wrapper'>
                            <div class='check'>
                                <i class='ion-checkmark'></i>
                            </div>
                            <div>Step 1</div>
                        </div>
                        <div class='bottom-div'>
                            <div></div>
                        </div>
                    </div>
                    <div class='progress-bar'>
                        <div class='circle-wrapper'>
                            <div class='check'>
                                <i class='ion-checkmark'></i>
                            </div>
                            <div>Step 2</div>
                        </div>
                        <div class='bottom-div'>
                            <div></div>
                        </div>
                    </div>
                    <div class='progress-bar'>
                        <div class='circle-wrapper'>
                            <div class='check'>
                                <i class='ion-checkmark'></i>
                            </div>
                            <div>Finish</div>
                        </div>
                        <div class='bottom-div'>
                            <div></div>
                        </div>
                    </div>
                </div>

                <div class='form-card-body'>
                    <div class='choose-photo'>
                        <div class='profile-placeholder'>
                            <div id='err'>Error</div>
                            <img src="./assets/svg/female.svg" alt="Female">
                        </div>          
                    </div>
                    <div id='selected-img'>
                        <img class='img-success' src="./assets/svg/check-bordered.svg" alt="Success">
                        <img id="img-preview" src="#" alt="your image" />
                    </div>
                    <div class='register-btn-wrapper'>
                        <button id='pfpBtn' onclick="return fireButton(event);">Choose File</button>      
                        <input class="input" id="image" type="file" name="image" style="display: none;">
                    </div>
                    <div id='img-error' style='text-align: center;'></div>
                </div>
                <div class='form-card-footer'>
                    <div class='form-card-btns'>
                        <div id='card-4-back' class='formSubmit formBack' onclick='toggleCards(this.id);'>
                            Back
                        </div>
                        <div id='card-4-next' class='formSubmit packageSubmit' onclick='toggleCards(this.id);'>
                            Finish
                        </div>
                    </div>
                </div>
            </div>
            <!-- Card 5 -->
            <!-- <div class='form-card' id='form-card-5'>
                <div class='form-card-header'>
                    <div class='form-heading'>
                        <h3>Become a Member</h3>
                    </div>
                    <div class='form-subheading'>
                        <p>Complete the payment to enjoy paid features of our site</p>
                    </div>
                </div>

                <div class='form-card-footer'>
                    <div class='form-card-btns'>
                        <a href='./payment' style='
                        text-decoration: none;
                        text-transform: none;
                        width: 100%; 
                        color: #0E0E0E !important;
                        height: 45px;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        font-size: 15px;
                        padding: 10px 0;
                        border-radius: 4px;
                        font-weight: 600;
                        background-color: #FFB600 !important;' id='card-5-next' class='formSubmit packageSubmit'>Become a Member for 1,290 PKR / Year</a>
                    </div>
                </div>

                <?php
                    // payment_form();
                ?>
            </div> -->
        </div>
    </div>

</form>



<script defer>
    if(typeof(cityInput) != 'undefined' && cityInput != null) {
        cityInput.addEventListener('change', function() {
            document.getElementById('city_selected').value = '';
        });
    }
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
            option.className = 'option';
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
                url : "./controllers/user-handler", // Url of backend (can be python, php, etc..)
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

<script src="./js/registration.js?v=110" defer></script>


<script defer>

    function profileForDropdown(id) {
        var dropdownId = id + "Dropdown";
        var selectedOption = document.getElementById("relationship").value;
        var genderDropdown = document.getElementById("genderDropdown");
        var genderOptions = genderDropdown.getElementsByClassName("option");

        // Reset gender dropdown to "Select" on each selection trigger click
        document.getElementById("selectedGender").textContent = "Select";


        if (selectedOption === "Myself") {
            document.getElementById("genderTrigger").onclick = function() {
                selectDropdown('genderTrigger');
            };
            var genderOptions = genderDropdown.getElementsByClassName("option");
            for (var i = 0; i < genderOptions.length; i++) {
                genderOptions[i].classList.remove('selected-option');
            }
            genderInput.value = '';
            if(genderInput.value) {
                document.getElementById('genderTrigger').style.border = '2px solid #00863E';
                // createSession('gender', genderInput.value);

                // var gender = getSession('gender');
                console.log(genderInput.value, $('.profile-placeholder img'));
                if(genderInput.value == 'male' || genderInput.value == 'Male' ) {
                    $('.profile-placeholder img').attr('src', './assets/svg/male.svg');
                } else if(genderInput.value == 'female' || genderInput.value == 'Female') {
                    $('.profile-placeholder img').attr('src', './assets/svg/female.svg');
                }
            } else {
                document.getElementById('genderTrigger').style.border = '2px solid #ADADAD';
            }
        } else {
            // Auto-select gender based on the relationship selection
            var genderValue = (selectedOption === "Daughter" || selectedOption === "Sister") ? "Female" : "Male";
            document.getElementById("selectedGender").textContent = genderValue;
            document.getElementById(genderValue.toLowerCase()).classList.add("selected-option");
            document.getElementById("gender").value = genderValue;


            document.getElementById("genderTrigger").onclick = null;
        

            if(genderInput.value) {
                document.getElementById('genderTrigger').style.border = '2px solid #00863E';
                document.getElementById('genderTrigger').style.backgroundColor = 'rgb(249,249,249)';

                // createSession('gender', genderInput.value);

                // var gender = getSession('gender');
                // console.log(gender, $('.profile-placeholder img'));
                console.log(genderInput.value, $('.profile-placeholder img'));
                if(genderInput.value == 'male' || genderInput.value == 'Male' ) {
                    $('.profile-placeholder img').attr('src', './assets/svg/male.svg');
                } else if(genderInput.value == 'female' || genderInput.value == 'Female') {
                    $('.profile-placeholder img').attr('src', './assets/svg/female.svg');
                }
            } else {
                document.getElementById('genderTrigger').style.border = '2px solid red';
                document.getElementById('genderTrigger').style.backgroundColor = 'rgb(254,220,224)';
            }
        }
    }

</script>


<?php include './partials/footer.php'; ?>