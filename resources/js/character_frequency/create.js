$(function($) {
    charCheck = JSON.parse(charCheck);
    console.log(charCheck);

    $('#char_id').on('change', function() {
        let thisVal = parseInt($(this).val()); // Convert value to a number

        let filteredCharCheck = charCheck.filter(char => char.id === thisVal);
        let getData = filteredCharCheck[0]

        $('#input1').val(getData['input_one'])
        $('#input2').val(getData['input_two'])
    })
})
