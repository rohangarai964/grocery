<script>

jQuery(document).ready(function($){

	$(".datepkrAll").datepicker({
		dateFormat: "<?=DATE_INPUT_FORMAT;?>",
    	changeMonth: true,
		changeYear: true,
		yearRange: "-100:+100",
		showButtonPanel: true,
		closeText: 'Clear',
		onClose: function(dateText, inst) {
			var event = arguments.callee.caller.caller.arguments[0];
			if ($(event.delegateTarget).hasClass('ui-datepicker-close')) {
                $(this).val('');
            }
		}
	});	

	$(".datepkrPast").datepicker({
		dateFormat: "<?=DATE_INPUT_FORMAT;?>",
    	changeMonth: true,
		changeYear: true,
		maxDate:0,
		yearRange: "-80:+0",
		showButtonPanel: true,
		closeText: 'Clear',
		onClose: function(event) {
			var event = arguments.callee.caller.caller.arguments[0];
			if ($(event.delegateTarget).hasClass('ui-datepicker-close')) {
                $(this).val('');
            }
		}
	});	

	$(".dateFrom").datepicker({
		dateFormat: "<?=DATE_INPUT_FORMAT;?>",
		numberOfMonths: 2,
        onSelect: function (selected) {
        	var parts = selected.match(/(\d+)/g);
            var dt = new Date(parts[1]+'/'+parts[0]+'/'+parts[2]);
            dt.setDate(dt.getDate());
            $(".dateTo").datepicker("option", "minDate", dt);
        }
    });

    $(".dateTo").datepicker({
    	dateFormat: "<?=DATE_INPUT_FORMAT;?>",
    	numberOfMonths: 2,
        onSelect: function (selected) {
        	var parts = selected.match(/(\d+)/g);
            var dt = new Date(parts[1]+'/'+parts[0]+'/'+parts[2]);
            dt.setDate(dt.getDate());
            $(".dateFrom").datepicker("option", "maxDate", dt);
        }
    });		
})


	
/*    $(window).on('load', function() {  
    $(".lds-roller").fadeOut("slow");
})*/
</script>
  </body>
</html>