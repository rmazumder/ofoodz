$(function(){ $('a[title]').tooltip(); $('.btn-submit').on('click', function(e) { var formname = $(this).attr('name'); var tabname = $(this).attr('href'); if ($('#' + formname)[0].checkValidity()) { /* Only works in Firefox/Chrome need polyfill for IE9, Safari. http://afarkas.github.io/webshim/demos/ */ e.preventDefault(); $('ul.nav li a[href="' + tabname + '"]').parent().removeClass('disabled'); $('ul.nav li a[href="' + tabname + '"]').trigger('click'); } });  $('ul.nav li').on('click', function(e) { if ($(this).hasClass('disabled')) { e.preventDefault(); return false; } });

$('#test12').datepicker({
    weekStart: 1,
	orientation: "bottom auto",
    startDate: moment().format('MM/DD/YYYY'),
    multidate: 5,
    keyboardNavigation: false,
    daysOfWeekDisabled: "0"
});

$('#test12').datepicker()
    .on("changeDate", function(e) {
       var str = "";
        $( "#schemeselect option:selected" ).each(function() {
          str += $( this ).text() + " ";
        });
		if(str.trim() !=''){
			var count = angular.element(document.body).scope().getSchemeData(str)['mealcount'];
			if(count == e.dates.length){
				$("#orderbtn").prop("disabled",false);
				$("#ordererror").empty();
				angular.element(document.body).scope().selecteddate = e.dates;
				console.log(e.dates);
				angular.element($('#datetextbox')).triggerHandler('input');
			} else {
				$("#orderbtn").prop("disabled",true);
				$("#ordererror").empty();
				$("#ordererror").append("<span class=\"help-block alert alert-danger\"   role=\"alert\">Please select "+count+" days. You have selected "+ e.dates.length+" days</span>");
			}
		}
        if(str.trim() == "Daily") {
		 // var price = angular.element(document.body).scope().setPrice(str, e.date);  
		  //$("#price").val(price);// = price;
          angular.element(document.body).scope().setSelectedDay(moment(e.date).format('dddd')) ;
        }
    });

 });

 
function addWeekdays(date, days) {
    date.setDate(date.getDate());
    var counter = 0;
        if(days > 0 ){
            while (counter < days) {
                date.setDate(date.getDate() + 1 ); // Add a day to get the date tomorrow
                var check = date.getDay(); // turns the date into a number (0 to 6)
                    if (check == 0 /*|| check == 6*/) {
                        // Do nothing it's the weekend (0=Sun & 6=Sat)
                    }
                    else{
                        counter++;  // It's a weekday so increase the counter
                    }
            }
        }
    return date;
}

function getDaysArray(date, days) {
    date.setDate(date.getDate());
    var datearray = [];
    var hours = moment(date).format('HH');
    if(hours > 18){
      date = moment(date).add(1, 'days')._d;
    }
    var day = moment(date).format('dddd');
    if(day == "Sunday"){
       date = moment(date).add(1, 'days')._d;
    }

    datearray.push(moment(date).format('MM/DD/YYYY'));
    var counter = 1;
        if(days > 0 ){
            while (counter < days) {
                date.setDate(date.getDate() + 1 ); // Add a day to get the date tomorrow
                var check = date.getDay(); // turns the date into a number (0 to 6)
                    if (check == 0 /*|| check == 6*/) {
                        // Do nothing it's the weekend (0=Sun & 6=Sat)
                    }
                    else{
                        datearray.push(moment(date).format('MM/DD/YYYY'));
                        counter++;  // It's a weekday so increase the counter
                    }
            }
        }
    return datearray;
}

function populateDate(scheme, weekday){
	
    var count = angular.element(document.body).scope().getSchemeData(scheme)['mealcount'];
    var today = new Date();
    var days = getDaysArray(new Date(), count);
    $("#datetextbox").val(days);
    angular.element(document.body).scope().selecteddate = days;
    $('#test12').datepicker('remove');
    $('#test12').datepicker({
      weekStart: 1,
      orientation: "bottom auto",
      startDate: moment().format('MM/DD/YYYY'),
      multidate: count,
      keyboardNavigation: false,
      daysOfWeekDisabled: "0"
  });
  angular.element(document.body).scope().setPrice(scheme);  
}

function populateDate4Dialy(scheme, weekday){
	var weeksdays = ["0", "1", "2", "3","4", "5", "6", "7"];
	delete weeksdays[weekday]; 
	var disableddays = weeksdays.join();
	var now = moment();
    var day = now.day();
	var toadd  = (7 - day)+parseInt(weekday);
	if(toadd >=7){
		toadd = toadd -7;
	}
	var selecteddate  = moment().add(toadd,'day').format('MM/DD/YYYY');;
    $("#datetextbox").val(selecteddate);
    angular.element(document.body).scope().selecteddate = selecteddate;
    $('#test12').datepicker('remove');
    $('#test12').datepicker({
      weekStart: 1,
      orientation: "bottom auto",
      startDate: moment().format('MM/DD/YYYY'),
      multidate: 1,
      keyboardNavigation: false,
      daysOfWeekDisabled: disableddays
  });
  angular.element(document.body).scope().setPrice(scheme);  
}

$( "#schemeselect" ).change(function() {

    var str = "";
    $( "#schemeselect option:selected" ).each(function() {
      str += $( this ).text() + " ";
    });
   populateDate(str);

});