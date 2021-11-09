function editProfile() {
	var btn = document.getElementById('edit');
    var form = document.getElementById('edit_profile');
    var cancelbtn = document.getElementById('cancel');

   btn.onclick = function() {
	  form.style.display = "block";
	  btn.style.display = "none";
	  cancelbtn.style.display = "block";

	}

	cancelbtn.onclick = function() {
		form.style.display = "none";
		cancelbtn.style.display = "none"
		btn.style.display = "block";
	}
}