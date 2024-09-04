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

if (page.startsWith('index')) {
    var uri = last.split('?');
    console.log(uri);
    if (uri[1].startsWith('occupation')) {
      var uriParams = new URLSearchParams(uri[1].replaceAll('%20', '+'));
      var fltrGender = document.getElementById('filterGender');
      var fltrMaritalStatus = document.getElementById('filterMaritalStatus');
      var fltrAge = document.getElementById('filterAge');
      var fltrEducation = document.getElementById('filterEducation');
      var fltrCity = document.getElementById('filterCity');
  
        if (uriParams.has('gender')) {
            var gender = uriParams.get('gender');
            if (gender !== 'Any') {
                document.getElementById('gender').value = gender;
                document.getElementById('selectedGender').textContent = gender;
                fltrGender.classList.add('selected-filter-parameter');
            }
        }
        if (uriParams.has('marital_status')) {
            var maritalStatus = uriParams.get('marital_status');
            if (maritalStatus !== 'Any') {
                document.getElementById('marital_status').value = maritalStatus;
                document.getElementById('selectedMaritalStatus').textContent = maritalStatus;
                fltrMaritalStatus.classList.add('selected-filter-parameter');
            }
        }
  
        if (uriParams.has('age')) {
            var age = uriParams.get('age');
            if (age !== 'Any') {
                if (age !== '40') {
                    document.getElementById('age').value = age;
                    document.getElementById('selectedAge').textContent = age;
                } else {
                    document.getElementById('age').value = age;
                    document.getElementById('selectedAge').textContent = '40+';
                }
                fltrAge.classList.add('selected-filter-parameter');
            }
        }
  
        if (uriParams.has('education')) {
            var education = uriParams.get('education');
            if (education !== 'Any') {
                document.getElementById('education').value = education;
                document.getElementById('selectedEducation').textContent = education;
                fltrEducation.classList.add('selected-filter-parameter');
            }
        }
  
        if (uriParams.has('city')) {
            var city = uriParams.get('city');
            if (city !== 'Any') {
                document.getElementById('city').value = city;
                document.getElementById('selectedCity').textContent = city;
                fltrCity.classList.add('selected-filter-parameter');
            }
        }
        page = '';
    }
}


function selectMaritalStatus(id) {
    document.getElementById("selectedMaritalStatus").textContent = id;
    document.getElementById("marital_status").value = id;
    selectDropdown('maritalStatusTrigger');
    document.getElementById("selectedMaritalStatus").classList.add('selected-option');

    var maritalStatusTrigger = document.getElementById('maritalStatusTrigger');
    maritalStatusTrigger.style.border = '2px solid #00863E';
    maritalStatusTrigger.style.backgroundColor = 'rgb(249,249,249)';
    maritalStatusTrigger.style.color = '#000';
}
function selectEducation(id) {
    document.getElementById("selectedEducation").textContent = id;
    document.getElementById("education").value = id;
    selectDropdown('educationTrigger');
    document.getElementById("selectedEducation").classList.add('selected-option');

    var educationTrigger = document.getElementById('educationTrigger');
    educationTrigger.style.border = '2px solid #00863E';
    educationTrigger.style.backgroundColor = 'rgb(249,249,249)';
    educationTrigger.style.color = '#000';
}
// function selectCity(id) {
//     document.getElementById("selectedCity").textContent = id;
//     document.getElementById("city").value = id;
//     selectDropdown('cityTrigger');
//     document.getElementById("selectedCity").classList.add('selected-option');

//     var cityTrigger = document.getElementById('cityTrigger');
//     cityTrigger.style.border = '2px solid #00863E';
//     cityTrigger.style.backgroundColor = 'rgb(249,249,249)';
//     cityTrigger.style.color = '#000';
// }
function selectRelationship(id) {
    document.getElementById("selectedRelationship").textContent = id;
    document.getElementById("relationship").value = id;
    selectDropdown('relationshipTrigger');
    document.getElementById("selectedRelationship").classList.add('selected-option');

    var relationshipTrigger = document.getElementById('relationshipTrigger');
    relationshipTrigger.style.border = '2px solid #00863E';
    relationshipTrigger.style.backgroundColor = 'rgb(249,249,249)';
    relationshipTrigger.style.color = '#000';
}
function selectGender(id) {
    document.getElementById("selectedGender").textContent = id;
    document.getElementById("gender").value = id;
    selectDropdown('genderTrigger');
    document.getElementById("selectedGender").classList.add('selected-option');

    var genderTrigger = document.getElementById('genderTrigger');
    genderTrigger.style.border = '2px solid #00863E';
    genderTrigger.style.backgroundColor = 'rgb(249,249,249)';
    genderTrigger.style.color = '#000';
}


function filterDropdown(id) {
    var dropdown;

    // Check if the clicked dropdown is already open
    if (id === 'filterMaritalStatus' && $('#filterMaritalStatusDropdown').hasClass('showDropdown')) {
        dropdown = $('#filterMaritalStatusDropdown');
    } else if (id === 'filterGender' && $('#filterGenderDropdown').hasClass('showDropdown')) {
        dropdown = $('#filterGenderDropdown');
    } else if (id === 'filterAge' && $('#filterAgeDropdown').hasClass('showDropdown')) {
        dropdown = $('#filterAgeDropdown');
    } else if (id === 'filterEducation' && $('#filterEducationDropdown').hasClass('showDropdown')) {
        dropdown = $('#filterEducationDropdown');
    } else if (id === 'filterCity' && $('#filterCityDropdown').hasClass('showDropdown')) {
        dropdown = $('#filterCityDropdown');
    }

    // Close all existing dropdowns
    $('.dropdown').removeClass('showDropdown').addClass('hideDropdown');

    // If the clicked dropdown was already open, we have already closed it
    if (dropdown) {
        return;
    }

    // Show the selected dropdown
    if (id === 'filterMaritalStatus') {
        dropdown = $('#filterMaritalStatusDropdown');
    } else if (id === 'filterGender') {
        dropdown = $('#filterGenderDropdown');
    } else if (id === 'filterAge') {
        dropdown = $('#filterAgeDropdown');
    } else if (id === 'filterEducation') {
        dropdown = $('#filterEducationDropdown');
    } else if (id === 'filterCity') {
        dropdown = $('#filterCityDropdown');
    }

    dropdown.removeClass('hideDropdown').addClass('showDropdown');
}


$(document).on('click', function(event) {
    if (!$(event.target).closest('.selection').length) {
        $('.dropdown').removeClass('showDropdown').addClass('hideDropdown');
        return;
    }
});


function selectDropdown(id) {
    var dropdown;

    // Show dropdown based on what filter div is clicked
    if (id === 'relationshipTrigger') {
        dropdown = document.getElementById("relationshipDropdown");
    } else if (id === 'maritalStatusTrigger') {
        dropdown = document.getElementById("maritalStatusDropdown");
    } else if (id === 'educationTrigger') {
        dropdown = document.getElementById("educationDropdown");
    } else if (id === 'cityTrigger') {
        dropdown = document.getElementById("cityDropdown");
    } else if (id === 'genderTrigger') {
        dropdown = document.getElementById("genderDropdown");
    }

    // Close all existing dropdowns except the one being opened
    var allDropdowns = document.getElementsByClassName('dropdown');
    for (var i = 0; i < allDropdowns.length; i++) {
        var currDropdown = allDropdowns[i];
        if (currDropdown === dropdown) {
            // Toggle the clicked dropdown
            if (currDropdown.classList.contains('showDropdown')) {
                currDropdown.classList.remove('showDropdown');
                currDropdown.classList.add('hideDropdown');
            } else if (currDropdown.classList.contains('hideDropdown')) {
                currDropdown.classList.remove('hideDropdown');
                currDropdown.classList.add('showDropdown');
            }
        } else {
            // Close other dropdowns
            if (currDropdown.classList.contains('showDropdown')) {
                currDropdown.classList.remove('showDropdown');
                currDropdown.classList.add('hideDropdown');
            }
        }
    }
}




function filterMaritalStatus(id) {
    document.getElementById("selectedMaritalStatus").textContent = id;
    document.getElementById("marital_status").value = id;
    filterDropdown('filterMaritalStatus');
    document.getElementById("filterMaritalStatus").classList.add('selected-filter-parameter');
}
function filterAge(id) {
    document.getElementById("selectedAge").textContent = id;
    if(id == '40+') {
        document.getElementById("age").value = '40';
    } else {
        document.getElementById("age").value = id;
    }
    
    filterDropdown('filterAge');
    document.getElementById("filterAge").classList.add('selected-filter-parameter');
}

function filterCity(id) {
    document.getElementById("selectedCity").textContent = id;
    document.getElementById("city").value = id;
    filterDropdown('filterCity');
    document.getElementById("filterCity").classList.add('selected-filter-parameter');
}
function filterGender(id) {
    document.getElementById("selectedGender").textContent = id;
    document.getElementById("gender").value = id;
    filterDropdown('filterGender');
    
    document.getElementById("filterGender").classList.add('selected-filter-parameter');
}
function filterEducation(id) {
    document.getElementById("selectedEducation").textContent = id;
    document.getElementById("education").value = id;
    filterDropdown('filterEducation');
    document.getElementById("filterEducation").classList.add('selected-filter-parameter');
}
