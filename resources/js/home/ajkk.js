$(document).ready(function() {

	$('.loader').hide();
	var load = 1;
	var num_post = 5;
	var nbr = $('#count_post').val();
	console.log(nbr+'-'+num_post);
	$('#btn').click( function() {
		$('.loader').show();
		if (num_post > nbr) {
			console.log(nbr+'-'+num_post);
			$('.showmore').hide();
		} else {
			console.log(nbr+'-'+num_post+'-'+load);
			$.post(base_url + 'ajkk/getFreelancePosts',{load:load}, function(data) {
				$('.position').append(data);
				$('.loader').hide();
				if (num_post > nbr) {
					$('.showmore').hide();
				}
			});
		} 
		load++;
		num_post = num_post + 5;
	});

	$('.jobsloader').hide();
	var load = 1;
	var num_post = 5;
	var nbr = $('#count_post').val();
	console.log(nbr+'-'+num_post);
	$('#fulltimejobbtn').click( function() {
		$('.jobsloader').show();
		if (num_post > nbr) {
			console.log(nbr+'-'+num_post);
			$('.showmore').hide();
		} else {
			console.log(nbr+'-'+num_post+'-'+load);
			$.post(base_url + 'ajkk/getJobPosts',{load:load}, function(data) {
				$('.position').append(data);
				$('.loader').hide();
				if (num_post > nbr) {
					$('.showmore').hide();
				}
			});
		} 
		load++;
		num_post = num_post + 5;
	});

	$('.parttimejobsloader').hide();
	var load = 1;
	var num_post = 5;
	var nbr = $('#count_post').val();
	console.log(nbr+'-'+num_post);
	$('#parttimejobbtn').click( function() {
		$('.parttimejobsloader').show();
		if (num_post > nbr) {
			console.log(nbr+'-'+num_post);
			$('.showmore').hide();
		} else {
			console.log(nbr+'-'+num_post+'-'+load);
			$.post(base_url + 'ajkk/getParttimeJobPosts',{load:load}, function(data) {
				$('.position').append(data);
				$('.parttimejobsloader').hide();
				if (num_post > nbr) {
					$('.showmore').hide();
				}
			});
		} 
		load++;
		num_post = num_post + 5;
	});


	$('.agencyjobsloader').hide();
	var load = 1;
	var num_post = 5;
	var nbr = $('#count_post').val();
	console.log(nbr+'-'+num_post);
	$('#agencyjobbtn').click( function() {
		$('.agencyjobsloader').show();
		if (num_post > nbr) {
			console.log(nbr+'-'+num_post);
			$('.showmore').hide();
		} else {
			console.log(nbr+'-'+num_post+'-'+load);
			$.post(base_url + 'ajkk/getAgencyJobPosts',{load:load}, function(data) {
				$('.position').append(data);
				$('.agencyjobsloader').hide();
				if (num_post > nbr) {
					$('.showmore').hide();
				}
			});
		} 
		load++;
		num_post = num_post + 5;
	});

	//tooltip
	$('body').tooltip({
	    selector: '[data-toggle="tooltip"]'
	});
});

