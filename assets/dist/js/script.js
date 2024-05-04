function removeRow(button) {
    // Get the reference to the button's parent row and remove it
    $(button).closest('tr').remove();
}
document.addEventListener("DOMContentLoaded", function () {
    var currentPath = window.location.pathname; // Get the current path
    var navLinks = document.querySelectorAll(".nav-link");
    $('.nav-link').removeClass('active');
    navLinks.forEach(function (navLink) {
        var linkPath = new URL(navLink.href).pathname; // Get the path from the href attribute
        if (currentPath === linkPath) {
            navLink.classList.add("active");
        }
    });
});

function addCourse() {
    // Create the table row
    var newRow = document.createElement('tr');

    // Add the first cell with input
    var cell1 = document.createElement('td');
    var input1 = document.createElement('input');
    input1.type = 'text';
    input1.placeholder = 'eg: Course Name';
    input1.className = 'form-control bg-peach course-name';
    cell1.appendChild(input1);
    newRow.appendChild(cell1);

    // Add the second cell with input
    var cell2 = document.createElement('td');
    var input2 = document.createElement('input');
    input2.type = 'text';
    input2.placeholder = 'eg: 3.2';
    input2.className = 'form-control bg-peach course-grade';
    input2.pattern = '[0-9.]{1,}';
    cell2.appendChild(input2);
    newRow.appendChild(cell2);

    // Add the third cell with select
    var cell3 = document.createElement('td');
    var select = document.createElement('select');
    select.className = 'form-control bg-peach course-credits';
    var credits = ['1', '2', '3', '4', '5', '6'];
    let i = 0;
    credits.forEach(function (credit) {
        if (i == 0) {
            var option1 = document.createElement('option');
            option1.value = '';
            option1.textContent = 'Select Credits';
            option1.selected = true;
            option1.disabled = true;
            select.appendChild(option1);
        }
        var option = document.createElement('option');
        option.value = credit;
        option.textContent = credit;
        select.appendChild(option);
        i++;
    });
    cell3.appendChild(select);
    newRow.appendChild(cell3);

    // Add the fourth cell with remove button
    var cell4 = document.createElement('td');
    var removeButton = document.createElement('button');
    removeButton.className = 'btn btn-dark bg-teapink border-0 rounded-5';
    removeButton.innerHTML = '<i class="fa fa-trash"></i>';
    removeButton.onclick = function () {
        removeRow(this);
    };
    cell4.appendChild(removeButton);
    newRow.appendChild(cell4);

    // Append the new row to the table
    document.getElementById('gpaTable').getElementsByTagName('tbody')[0].appendChild(newRow);
}

function calculateGPA() {
    // Get all course grades and credits
    var gradeInputs = document.querySelectorAll('.course-grade');
    var creditSelects = document.querySelectorAll('.course-credits');
    var gpaRow = document.getElementById('gpaRow');
    gpaRow.style.display = 'none';

    var totalCredits = 0;
    var totalGradePoints = 0;

    // Loop through each course
    for (var i = 0; i < gradeInputs.length; i++) {
        // Get the grade and credit for the current course
        var grade = parseFloat(gradeInputs[i].value);
        var credit = parseFloat(creditSelects[i].value);

        // Check if grade and credit are valid numbers
        if (!isNaN(grade) && !isNaN(credit)) {
            // Add the grade points to totalGradePoints
            totalGradePoints += grade * credit;
            // Add the credits to totalCredits
            totalCredits += credit;
        }
    }

    // Calculate GPA
    var gpa = totalGradePoints / totalCredits;

    document.getElementById('gpaValue').textContent = gpa.toFixed(2);

    gpaRow.style.display = 'table-row';
    // Log the GPA to the console
    console.log('GPA:', gpa.toFixed(2));
}

$(document).ready(function () {
    $('.program_check').change(function () {
        var checkedCount = $('.program_check:checked').length;

        // Disable other checkboxes if two are checked
        if (checkedCount >= 2) {
            $('.program_check:not(:checked)').prop('disabled', true);
            $('.compare_float').prop('disabled', false);
        } else {
            $('.program_check:not(:checked)').prop('disabled', false);
            $('.compare_float').prop('disabled', true);
        }
        handleProgramCheckboxes();
    });
});
function handleProgramCheckboxes() {
    $('.card').removeClass('card_checked');

    // Add card_checked class to parent card of checked checkboxes
    $('.program_check:checked').closest('.card').addClass('card_checked');
}

function programDetails(universityName, type, location, rank, scholarships, careerServices) {
    $('#universityName').text(universityName);
    $('#typeOfUniversity').text(type);
    $('#location').text(location);
    $('#rank').text(rank);
    $('#scholarships').text(scholarships);
    $('#careerServices').text(careerServices);
    $('#programDetailsModal').modal('show');
}