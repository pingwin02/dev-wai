$(document).ready(function() {
	$('#dialog_button').click(function() {
		$('#dialog').dialog({
			closeText: "",
			resizable: false,
			modal: true,
			buttons: {
				"Tak": function() {
					$('#przesylanie').trigger("reset");
					$(this).dialog("close");
				},
				Nie: function() {
					$(this).dialog("close");
				}
			}
		});
		return false;
	});
});
$(function() {
	$(document).tooltip();
});
$(function() {
	$("#datepicker").datepicker({
		minDate: new Date(2021, 1 - 1, 1),
		maxDate: 0
	});
});