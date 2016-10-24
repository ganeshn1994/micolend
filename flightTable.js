$( document ).ready(function(){
	function highlight_row() {
    var table = document.getElementById('flightTable');
    var cells = table.getElementsByTagName('td');

    for (var i = 0; i < cells.length; i++) {
        // Take each cell
        var cell = cells[i];
        // do something on onclick event for cell
        cell.onclick = function () {
            // Get the row id where the cell exists
            var rowId = this.parentNode.rowIndex;

            var rowsNotSelected = table.getElementsByTagName('tr');
            for (var row = 0; row < rowsNotSelected.length; row++) {
                rowsNotSelected[row].style.backgroundColor = "";
                rowsNotSelected[row].classList.remove('selected');
            }
            var rowSelected = table.getElementsByTagName('tr')[rowId];
            rowSelected.style.backgroundColor = "#3399ff";
            rowSelected.className += " selected";

      }
    }

}


highlight_row();

$('tr').click(function() {
var flightID = $(this).data('id');
console.log(flightID);
$('#guestForm input[name="bookingid"]').val(flightID);
$('#userForm input[name="bookingid"]').val(flightID);
}); 
});





