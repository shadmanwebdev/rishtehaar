

<?php
    if(isset($_SESSION['user'])) {
        $propTitle = 'Proposals';
    } else {
        $propTitle = 'Rishta Profiles';
    }  
?>

<div id='proposals'>
    <div id='proposals-head'>
        <div class='proposals-head-row1'>
            <div class='proposals-title'>
                <div class='proposals-label'>New</div>
                <div class='proposals-title-main'>
                    <?= $propTitle; ?>
                </div>
            </div>
            <div class='filter-trigger-mobile' onclick='dropFilter();'>
                <span class='dsk'>Filter Search</span>
                <span class='mb'>Filter</span>
            </div>
        </div>
        <div class='proposals-head-row2'>
            <?php include './template-parts/filters.php'; ?>
        </div>
    </div>
    <div id='proposals-body'>
        <div class='proposals-content'>
            <?php
                // var_dump($_GET);
                if(isset($_GET['filter'])) {
                    echo $user->showFilteredProposals($_GET['gender'], $_GET['marital_status'], $_GET['age'], $_GET['education'],  $_GET['city'],  $_GET['occupation']);
                }  else {
                    echo $user->showProposals();
                }
            ?>
        </div>
    </div>
</div>


<script defer>
    function capitalizeFirstLetter(str) {
        return str.charAt(0).toUpperCase() + str.slice(1).toLowerCase();
    }
    function capitalizeEachWord(str) {
        return str.split(' ').map(word => {
            return word.charAt(0).toUpperCase() + word.slice(1).toLowerCase();
        }).join(' ');
    }
    function filter(event, page) {
        /*
            =========================================
                Filter function
            =========================================
            1. Gets form values
            2. Adds classes for selected filter options
            3. Validates
            4. Sends ajax requests
            5. Inserts data
        */
        event.preventDefault();

        // 1. Get form values
        var formData = new FormData();
        // const page = $('#page').val();
        const gender = $('#gender').val();
        const maritalStatus = $('#marital_status').val();
        const age = $('#age').val();
        const education = $('#education').val();
        const city = $('#city').val();
        const occupation = $('#occupation').val();

        console.log(gender, maritalStatus, age, education, city);

        formData.append('page', page);
        formData.append('gender', gender);
        formData.append('marital_status', maritalStatus);
        formData.append('age', age);
        formData.append('education', education);
        formData.append('city', city);
        formData.append('occupation', occupation);
        formData.append('filter', 'true');

        // 2. Add classes for selected filter options
        function addSelectedClass(id, value) {
            if (value !== 'Any') {
                $('#' + id).addClass('selected-filter-parameter');
            } else {
                $('#' + id).removeClass('selected-filter-parameter');
            }
        }

        addSelectedClass('filterGender', gender);
        addSelectedClass('filterMaritalStatus', maritalStatus);
        addSelectedClass('filterAge', age);
        addSelectedClass('filterEducation', education);
        addSelectedClass('filterCity', city);


        // 3. Validate
        var filter = false;
        if(gender || maritalStatus || age || education || city) {
            filter = true;
        } else {
            console.log('Select one of the filter options to continue');
        }


        // 4. Send AJAX request
        if(filter) {
            fetch('./filtered-results.php', {
                method: 'POST',
                body: formData
            })
            .then(response => {
                return response.text()      
            })
            .then(response => {
                
                console.log(response);
                $('#proposals-body').html(response);

                $('#page').html(page);

                document.getElementById("proposals").scrollIntoView({ behavior: "smooth" });
                
            });
        }

    }
    
    function filter_by_city(event, page, city) {
        /*
            =========================================
                Filter function
            =========================================
            2. Adds classes for selected filter options
            3. Validates
            4. Sends ajax requests
            5. Inserts data
        */
        event.preventDefault();

        // 1. Get form values
        var formData = new FormData();

        console.log(city);

        formData.append('page', page);
        formData.append('gender', 'Any');
        formData.append('marital_status', 'Any');
        formData.append('age', 'Any');
        formData.append('education', 'Any');
        formData.append('city', city);
        formData.append('occupation', 'Any');
        formData.append('filter', 'true');

        // 2. Add classes for selected filter options
        function addSelectedClass(id, value) {
            if (value !== 'Any') {
                $('#' + id).addClass('selected-filter-parameter');
            } else {
                $('#' + id).removeClass('selected-filter-parameter');
            }
        }

        
        addSelectedClass('filterGender', 'Any');
        addSelectedClass('filterMaritalStatus', 'Any');
        addSelectedClass('filterAge', 'Any');
        addSelectedClass('filterEducation', 'Any');
        addSelectedClass('filterCity', city);


        // 3. Validate
        var filter = true;

        // 4. Send AJAX request
        if(filter) {
            fetch('./filtered-results.php', {
                method: 'POST',
                body: formData
            })
            .then(response => {
                return response.text()      
            })
            .then(response => {
                
                console.log(response);
                $('#proposals-body').html(response);

                $('#page').html(page);

                var fltrGender = document.getElementById('filterGender');
                var fltrMaritalStatus = document.getElementById('filterMaritalStatus');
                var fltrAge = document.getElementById('filterAge');
                var fltrEducation = document.getElementById('filterEducation');
                var fltrCity = document.getElementById('filterCity');

                if (city !== 'Any') {
                    document.getElementById('city').value = city;
                    document.getElementById('selectedCity').textContent = city;
                    fltrCity.classList.add('selected-filter-parameter');
                } else {
                    document.getElementById('city').value = city;
                    document.getElementById('selectedCity').textContent = city;
                    fltrCity.classList.remove('selected-filter-parameter');
                }
                
                // Gender
                document.getElementById('gender').value = 'Any';
                document.getElementById('selectedGender').textContent = 'Any';
                fltrGender.classList.remove('selected-filter-parameter');

                // Marital Status
                document.getElementById('marital_status').value = 'Any';
                document.getElementById('selectedMaritalStatus').textContent = 'Any';
                fltrMaritalStatus.classList.remove('selected-filter-parameter');
            
                // Age
                document.getElementById('age').value = 'Any';
                document.getElementById('selectedAge').textContent = 'Any';
                fltrAge.classList.remove('selected-filter-parameter');

                // Education
                document.getElementById('education').value = 'Any';
                document.getElementById('selectedEducation').textContent = 'Any';
                fltrEducation.classList.remove('selected-filter-parameter');
                
                // Occupation
                document.getElementById('occupation').value = 'Any';

                document.getElementById("proposals").scrollIntoView({ behavior: "smooth" });
                
            });
        }

    }
    function filter_by_marital_status_gender_occupation(event, page, marital_status, gender, occupation) {
        /*
            =========================================
                Filter function
            =========================================
            2. Adds classes for selected filter options
            3. Validates
            4. Sends ajax requests
            5. Inserts data
        */
        event.preventDefault();

        // 1. Get form values
        var formData = new FormData();

        console.log(city);

        formData.append('page', page);
        formData.append('gender', gender);
        formData.append('marital_status', marital_status);
        formData.append('age', 'Any');
        formData.append('education', 'Any');
        formData.append('city', 'Any');
        formData.append('occupation', occupation);
        formData.append('filter', 'true');

        // 2. Add classes for selected filter options
        function addSelectedClass(id, value) {
            if (value !== 'Any') {
                $('#' + id).addClass('selected-filter-parameter');
            } else {
                $('#' + id).removeClass('selected-filter-parameter');
            }
        }

        addSelectedClass('filterGender', gender);
        addSelectedClass('filterMaritalStatus', marital_status);
        addSelectedClass('filterAge', 'Any');
        addSelectedClass('filterEducation', 'Any');
        addSelectedClass('filterCity', 'Any');

        // 3. Validate
        var filter = true;

        // 4. Send AJAX request
        if(filter) {
            fetch('./filtered-results.php', {
                method: 'POST',
                body: formData
            })
            .then(response => {
                return response.text()      
            })
            .then(response => {
                
                console.log(response);
                $('#proposals-body').html(response);

                $('#page').html(page);

                var fltrGender = document.getElementById('filterGender');
                var fltrMaritalStatus = document.getElementById('filterMaritalStatus');
                var fltrAge = document.getElementById('filterAge');
                var fltrEducation = document.getElementById('filterEducation');
                var fltrCity = document.getElementById('filterCity');



                // Marital Status
                if (marital_status == 'Any') {
                    document.getElementById('marital_status').value = 'Any';
                    document.getElementById('selectedMaritalStatus').textContent = 'Any';
                    fltrMaritalStatus.classList.remove('selected-filter-parameter');
                } else {
                    document.getElementById('marital_status').value = marital_status;
                    document.getElementById('selectedMaritalStatus').textContent = capitalizeEachWord(marital_status);
                    fltrMaritalStatus.classList.add('selected-filter-parameter');
                }
                
                // Gender
                if (gender == 'Any') {
                    document.getElementById('gender').value = 'Any';
                    document.getElementById('selectedGender').textContent = 'Any';
                    fltrGender.classList.remove('selected-filter-parameter');
                } else {
                    document.getElementById('gender').value = gender;
                    document.getElementById('selectedGender').textContent = capitalizeEachWord(gender);
                    fltrGender.classList.add('selected-filter-parameter');
                }

                // City
                document.getElementById('city').value = 'Any';
                document.getElementById('selectedCity').textContent = 'Any';
                fltrCity.classList.remove('selected-filter-parameter');
                
                // Age
                document.getElementById('age').value = 'Any';
                document.getElementById('selectedAge').textContent = 'Any';
                fltrAge.classList.remove('selected-filter-parameter');
            
                // Education
                document.getElementById('education').value = 'Any';
                document.getElementById('selectedEducation').textContent = 'Any';
                fltrEducation.classList.remove('selected-filter-parameter');
            
                // Occupation
                if (occupation !== 'Any') {
                    document.getElementById('occupation').value = capitalizeEachWord(occupation);
                } else {
                    document.getElementById('occupation').value = 'Any';
                }

                document.getElementById("proposals").scrollIntoView({ behavior: "smooth" });
                
            });
        }

    }
</script>