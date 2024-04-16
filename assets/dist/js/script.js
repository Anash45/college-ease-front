function addCourse() {
    // Create the table row
    var newRow = $('<tr></tr>');

    // Add the first cell with input
    var cell1 = $('<td></td>');
    var input1 = $('<input type="text" placeholder="eg: Course Name" class="form-control bg-peach">');
    cell1.append(input1);
    newRow.append(cell1);

    // Add the second cell with select
    var cell2 = $('<td></td>');
    var select = $('<select class="form-control bg-peach">' +
        '<option value="" selected disabled>Select Option</option>' +
        '<option value="A">A</option>' +
        '<option value="B">B</option>' +
        '<option value="C">C</option>' +
        '<option value="D">D</option>' +
        '<option value="C">C</option>' +
        '<option value="F">F</option>' +
        '</select>');
    cell2.append(select);
    newRow.append(cell2);

    // Add the third cell with input
    var cell3 = $('<td></td>');
    var input2 = $('<input type="text" placeholder="eg: Course Name" class="form-control bg-peach">');
    cell3.append(input2);
    newRow.append(cell3);

    // Add the fourth cell with remove button
    var cell4 = $('<td></td>');
    var removeButton = $('<button class="btn btn-dark bg-teapink border-0 rounded-5" onclick="removeRow(this)"> <i class="fa fa-trash"></i> </button>');
    cell4.append(removeButton);
    newRow.append(cell4);

    // Append the new row to the table
    $('#gpaTable tbody').append(newRow);
}

function removeRow(button) {
    // Get the reference to the button's parent row and remove it
    $(button).closest('tr').remove();
}