$(document).ready(function(){	
	$("#prForm").submit(function(event){
		submitForm();
		return false;
	});
});
function submitForm(){
    $.ajax({
       type: "POST",
       url: "prsave.php",
       cache:false,
       data: $('form#prForm').serialize(),
       success: function(response){
           $("#payroll").html(response)
           $("#payroll-modal").modal('hide');
       },
       error: function(){
           alert("Error");
       }
   });
}