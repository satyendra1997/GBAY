$(document).ready(function(){
	
		$("#psearch").click(function(){
		var rn=$("#plot_id").val();
		rn=$.trim(rn);
		if(rn==""){
			alert("pls Search for valid plot id");
		}
		else{
			var datastring="plotid="+ rn;
			
			$.ajax({
				url: 'ajaxprocess.php',
				type: 'post',
				data: datastring,
				beforeSend: function(){
					//alert("request is ready to go");
				},
				success: function(res){
					$("#output").html(res);
					//alert(res);
				},
				error: function(){
					alert( "error occured" );
				},
				complete: function(){
					//
				}
			});
		}
	});

	$("#bsearch").click(function(){
		var rn=$("#broker_id").val();
		rn=$.trim(rn);
		if(rn==""){
			alert("pls Search for valid broker id");
		}
		else{
			var datastring="broker_id="+ rn;
			
			$.ajax({
				url: 'ajaxprocess.php',
				type: 'post',
				data: datastring,
				beforeSend: function(){
					//alert("request is ready to go");
				},
				success: function(res){
					$("#output").html(res);
					//alert(res);
				},
				error: function(){
					alert( "error occured" );
				},
				complete: function(){
					//
				}
			});
		}
	});
	
	//payment
	$("#paysearch").click(function(){
		var rn=$("#payment_id").val();
	
		rn=$.trim(rn);
		if(rn==""){
			alert("pls Search for valid payment id");
		}
		else{
			var datastring="payment_id="+ rn;
			
			$.ajax({
				url: 'ajaxprocess.php',
				type: 'post',
				data: datastring,
				beforeSend: function(){
					//alert("request is ready to go");
				},
				success: function(res){
					$("#output").html(res);
					//alert(res);
				},
				error: function(){
					alert( "error occured" );
				},
				complete: function(){
					//
				}
			});
		}
	});

		
	
});