$(document).ready(function() {


	$('.carousel').carousel({
	  interval: 3000
	});


	
	$('.imageUpload').change(function(event){

	    let input = event.target.files[0];
	    const inputName = $(this).data('id');

	    if (input) {
	        var reader = new FileReader();            
	        reader.onload = function (e) {
	          $('#'+ inputName).attr('src', e.target.result);
	        }
	        reader.readAsDataURL(input);
	    }

	})

});
