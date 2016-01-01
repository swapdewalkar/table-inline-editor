$(document).ready(function(){
	
	$("td > input")
	.focus(function(){
		$(this)
		.css({
			"background":"yellow",
		});
	})
	.blur(function(){
		var id=$(this).attr("id");
		var name=$(this).attr("name");
		var oldValue=$(this).attr("value");
		var newValue=$(this).val();
		//$(this).attr("contenteditable","true");
		$(this)
		.css({
			"background":"white",
		});
		$.ajax({
			url:"ajax.php",
			type:"POST",
			data:(function () {
				var data={};
				data.table=table;
				data.operation="edit";
				data.id=id;
				data.name=name;
				data.oldValue=oldValue;
				data.newValue=newValue;
				return data;	
			})(),
			success:function(data){
				$("#status").text(data);
			}
		});
	})
	.keypress(function(e){
		//alert(e.which);
	});
});	