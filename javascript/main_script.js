document.querySelectorAll('.nav-link').forEach(link=>{
	if (link.href===window.location.href){
		link.setAttribute('aria-current','page');
	}
});

document.getElementById('go_back').addEventListener('click', function() {
	window.history.back();
});