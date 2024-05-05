// navigation bar
document.querySelectorAll('.nav-link').forEach(link=>{
	if (link.href===window.location.href){
		link.setAttribute('aria-current','page');
	}
});

// back button
document.getElementById('go_back').addEventListener('click', function() {
	window.history.back();
});

// sign up page
const checkbox = document.getElementById('checkbox_agree');
const signup = document.getElementById('signup_btn');

checkbox.addEventListener('change', function() {
	signup.disabled = !checkbox.checked;
});