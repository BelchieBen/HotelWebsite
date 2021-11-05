function showPopup() {
	var modal = document.getElementById("roomsPopup");
	var btn = document.getElementById("viewRooms");
	var span = document.getElementsByClassName("close")[0];

	btn.onclick = function() {
	  modal.style.display = "block";
	}

	span.onclick = function() {
	  modal.style.display = "none";
	}

	window.onclick = function(event) {
	  if (event.target == modal) {
	    modal.style.display = "none";
  		}
	}
}


function showEndDate() {
	var startDate = document.getElementById("startDate").value;
	if (startDate != "")
	{
		var endDate = document.getElementById("endDate");
		endDate.style.display = "block";
	}
	else
	{
		var endDate = document.getElementById("endDate");
		endDate.style.display = "none";
	}
}


function getDates() {
	var startDateInput = document.getElementById("startDate").value;
	var endDateInput = document.getElementById("endDate").value;

	var enumerateDaysBetweenDates = getIntermediateDates(startDateInput, endDateInput);
	var json = JSON.stringify(enumerateDaysBetweenDates); 

	var roomsBtn = document.getElementById("viewRooms");
	if (enumerateDaysBetweenDates.length>0)
	{
		roomsBtn.style.display = "block";
		sendDatesToServer(json);
	}
	else
	{
		roomsBtn.style.display = "none";
	}
}


function getIntermediateDates(startDate, endDate)
{
    var dates = [];

    var currDate = moment(startDate).startOf('day');
    var lastDate = moment(endDate).startOf('day');

    while(currDate.add(1, 'days').diff(lastDate) < 0) {
        dates.push(currDate.clone().toDate().toLocaleDateString());
    }

    return dates;
};