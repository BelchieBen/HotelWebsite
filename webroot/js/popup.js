function showPopup() {
	// Getting DOM elements
	var modal = document.getElementById("roomsPopup");
	var btn = document.getElementById("viewRooms");
	var span = document.getElementsByClassName("close")[0];

	// Adding the styles to show/ hide elements based off events
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
	// Getting the startdate value
	var startDate = document.getElementById("startDate").value;
	if (startDate != "")
	{
		// Shwoing the end date element if the startdate has a value
		var endDate = document.getElementById("endDate");
		endDate.style.display = "block";
	}
	else
	{
		// Hiding the enddate input if there is no start date
		var endDate = document.getElementById("endDate");
		endDate.style.display = "none";
	}
}


function getDates() {
	// Getting DOM elements
	var startDateInput = document.getElementById("startDate").value;
	var endDateInput = document.getElementById("endDate").value;

	// Getting the dates between the 2 dates user selected
	var enumerateDaysBetweenDates = getIntermediateDates(startDateInput, endDateInput);
	var json = JSON.stringify(enumerateDaysBetweenDates); 

	var roomsBtn = document.getElementById("viewRooms");
	if (enumerateDaysBetweenDates.length>0)
	{
		// If the user chose a date range, show the view all rooms button & send those dates to controller
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

    // I used Moment.JS libary to get all the dates between the dates user selceted (https://momentjs.com/)
    var currDate = moment(startDate).startOf('day');
    var lastDate = moment(endDate).startOf('day');
    lastDate.add(1,'days');

    // Loop to get each day in the range and add it to the dates array
    while(currDate.isBefore(lastDate)){
    	dates.push(currDate.clone().toDate().toLocaleDateString());
    	currDate.add(1, 'days');
    }

    console.log(dates);

    return dates;
};

// Showing the popup on the admin page for updating users
function showUsersPopup() {
	// Getting DOM elements
	var modal = document.getElementById("usersPopup");
	var btn = document.getElementById("openTable");
	var span = document.getElementsByClassName("closeUp")[0];

	// Applying styles to elements on events
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

// Showing the popup on the admin page for deleting users
function showUsersPopupDel() {
	// Getting DOM elements
	var modal = document.getElementById("usersPopupDel");
	var btn = document.getElementById("openTableDel");
	var span = document.getElementsByClassName("closeDel")[0];

	// Applying styles to elements on events
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