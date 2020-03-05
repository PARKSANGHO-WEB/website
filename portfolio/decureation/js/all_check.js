
$(document).ready(function () {
    $('#myList li:lt(6)').show();
    $('#loadMore').click(function () {
        $('#myList li:lt(10)').show();
    });

    $('#mrList li:lt(3)').show();
    
    $('#mr_more').click(function () {
        $('#mrList li:lt(10)').show();
    });
    

});