<style>
    .selected-filter-parameter {
        border: 2px solid rgb(0, 134, 62);
        background-color: rgb(255, 255, 255);
        color: #00863E;
    }
    .selected-filter-parameter > div {
        color: rgb(0, 134, 62);
    }
    .filter-group .dropdown .option {
        font-size: 15px;
    }
    @media screen and (max-width: 1280px) {
        .filter-group .dropdown .option {
            font-size: 15px;
        }
    }
</style>


<form id='filter'>
    <div class='filter-head'>
        Filter Search
    </div>
    <div class='filter-body'>
        <div class='filter-content'>
            <!-- Page -->
            <input type='hidden' id='page' name='page' value='1'>
            <!-- Occupation -->
            <input type='hidden' id='occupation' name='occupation' value='Any'>
            <!-- Gender -->
            <div class='filter-group'>
                <div>Gender</div>
                <div class='selection'>
                    <div id='filterGender' class='dropdown-trigger' onclick='filterDropdown(this.id);'>
                        <div id='selectedGender'>Any</div>
                        <i style='color: gray;margin-top:3px;' class="ion-chevron-down" aria-hidden="true"></i>
                    </div>
                    <div class='dropdown hideDropdown' id='filterGenderDropdown'>
                        <input type='hidden' id='gender' name='gender' value='Any'>
                        <span class='option' id='Male' onclick='filterGender(this.id);'>Male</span>
                        <span class='option' id='Female' onclick='filterGender(this.id);'>Female</span>
                        <span class='option' id='Other' onclick='filterGender(this.id);'>Other</span>
                        <span class='option' id='Any' onclick='filterGender(this.id);'>Any</span>
                    </div>
                </div>
            </div>
            <!-- Marital Status -->
            <div class='filter-group'>
                <div>Marital Status</div>
                <div class='selection'>
                    <div id='filterMaritalStatus' class='dropdown-trigger' onclick='filterDropdown(this.id);'>
                        <div id='selectedMaritalStatus'>Any</div> 
                        <i style='color: gray;margin-top:3px;' class="ion-chevron-down" aria-hidden="true"></i>
                    </div>
                    <div class='dropdown hideDropdown' id='filterMaritalStatusDropdown'>
                        <input type='hidden' id='marital_status' name='marital_status' value='Any'>
                        <span class='option' id='Never Married' onclick='filterMaritalStatus(this.id);'>Never Married</span>
                        <span class='option' id='Married' onclick='filterMaritalStatus(this.id);'>Married</span>
                        <span class='option' id='Divorced' onclick='filterMaritalStatus(this.id);'>Divorced</span>
                        <span class='option' id='Widowed' onclick='filterMaritalStatus(this.id);'>Widowed</span>
                        <span class='option' id='Separated' onclick='filterMaritalStatus(this.id);'>Separated</span>
                        <span class='option' id='Any' onclick='filterMaritalStatus(this.id);'>Any</span>
                    </div>
                </div>
            </div>
            <!-- Age -->
            <div class='filter-group'>
                <div>Age</div>
                <div class='selection'>
                    <div id='filterAge' class='dropdown-trigger' onclick='filterDropdown(this.id);'>
                        <div id='selectedAge'>Any</div>
                        <i style='color: gray;margin-top:3px;' class="ion-chevron-down" aria-hidden="true"></i>
                    </div>
                    <div class='dropdown hideDropdown' id='filterAgeDropdown'>
                        <input type='hidden' id='age' name='age' value='Any'>
                        <span class='option' id='18-25' onclick='filterAge(this.id);'>18-25</span>
                        <span class='option' id='26-30' onclick='filterAge(this.id);'>26-30</span>
                        <span class='option' id='31-35' onclick='filterAge(this.id);'>31-35</span>
                        <span class='option' id='36-40' onclick='filterAge(this.id);'>36-40</span>
                        <span class='option' id='40+' onclick='filterAge(this.id);'>40+</span>
                        <span class='option' id='Any' onclick='filterAge(this.id);'>Any</span>
                    </div>
                </div>
            </div> 
            <!-- Education -->
            <div class='filter-group'>
                <div>Education</div>
                <div class='selection'>
                    <div id='filterEducation' class='dropdown-trigger' onclick='filterDropdown(this.id);'>
                        <div id='selectedEducation'>Any</div>
                        <i style='color: gray;margin-top:3px;' class="ion-chevron-down" aria-hidden="true"></i>
                    </div>
                    <div class='dropdown hideDropdown' id='filterEducationDropdown'>
                        <input type='hidden' id='education' name='education' value='Any'>
                        <span class='option' id='Under matric' onclick='filterEducation(this.id);'>Under matric</span>
                        <span class='option' id='Matric' onclick='filterEducation(this.id);'>Matric</span>
                        <span class='option' id='Intermediate' onclick='filterEducation(this.id);'>Intermediate</span>
                        <span class='option' id="Bachelors" onclick='filterEducation(this.id);'>Bachelors</span>
                        <span class='option' id="Masters" onclick='filterEducation(this.id);'>Master</span>
                        <span class='option' id='PhD' onclick='filterEducation(this.id);'>PhD</span>
                        <span class='option' id='Any' onclick='filterEducation(this.id);'>Any</span>
                    </div>
                </div>
            </div>
            <!-- City -->
            <div class='filter-group'>
                <div>City</div>
                <div class='selection'>
                    <div id='filterCity' class='dropdown-trigger' onclick='filterDropdown(this.id);'>
                        <div id='selectedCity'>Any</div>
                        <i style='color:gray; margin-top:3px;' class="ion-chevron-down" aria-hidden="true"></i>
                    </div>
                    <div style='height: 280px; overflow-Y: scroll;' class='dropdown hideDropdown' id='filterCityDropdown'>
                        <input type='hidden' id='city' name='city' value='Any'>
                        <?php
                            // Get cities
                            $cities = getCities();

                            // Generate the HTML string
                            $htmlString = createHTMLStringFromArray($cities);

                            // Echo the result
                            echo $htmlString;
                        ?>
                        <span class='option' id='Any' onclick='filterCity(this.id);'>Any</span>
                    </div>
                </div>
            </div>
        </div>
        <input type='hidden' id='filter' name='filter' value='true'>
        <!-- Filter Footer -->
        <div class='filter-footer'>
            <div class='filter-footer-content'>
                <div id='filterBtn' onclick="filter(event, '1')">
                    Apply
                </div>
                <!-- <a class='clear-filter'href='./'>
                    Clear
                </a> -->
            </div>
        </div>
    </div>


</form>




