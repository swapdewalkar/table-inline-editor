/*
Athor: Swapnil Ashok Dewalkar
Email: swapdewalkar@gmail.com
*/
$(document).ready(function(){
	
	$(document)
	.on("focus", "td > input[class!='addRowInput']",function(){
		$(this)
		.css({
			"background":"yellow",
		});
	})
	.on("blur", "td > input[class!='addRowInput']",function(){
		var id=$(this);
		var name=$(this).attr("name");
		var oldValue=$(this).attr("value");
		var newValue=$(this).val();
		$(this)
		.css({
			"background":"white",
		});
		$.ajax({
			url:"ajax.php",
			type:"POST",
			data:(function () {
				var data={};
				data.host=host;
				data.database=database;
				data.user=user;
				data.password=password;
				data.table=table;
				data.operation="edit";
				data.inputId=id.attr("id");
				data.rowId=id.parent().parent().attr("value");
				data.name=name;
				data.oldValue=oldValue;
				data.newValue=newValue;
				return JSON.stringify(data);
			})(),
			success:function(data){
				var data=JSON.parse(data);
				$("#status").text(data.msg);
				$('#'+data.inputId).attr("value",data.newValue);
			}
		});
	})
	.keypress(function(e){
		//alert(e.which);
	})
	.on("click", "#addNewButton",function(){
		function getData(){
			return $('#add-id-'+field).val();
		}
		$.ajax({
			url:"ajax.php",
			type:"POST",
			data:(function () {
				var data={};
				data.host=host;
				data.database=database;
				data.user=user;
				data.password=password;
				data.table=table;
				data.operation="add";
				var returnData={};
				for(field in fields){
					returnData[fields[field]]=($('#add-id-'+fields[field]).val());
				}
				//data.fields=fields;
				data.values=returnData;
				return JSON.stringify(data);	
			})(),
			success:function(data){
				var data=JSON.parse(data);
				var values=data.values;
				$("#status").text(data.msg);
				var rowToAdd=[];
				rowToAdd.push("<span class='fa fa-trash deleteButton' name='"+primary+"' id='del-"+data.rowIndex+"'></span>");
				for(value in values)
					rowToAdd.push("<input type='text' value='"+values[value]+"' name="+value+" id='"+data.rowIndex+"' >");
			
				var rowAddedRef=$('#dt').dataTable().fnAddData(rowToAdd);
				 var row = $('#dt').dataTable().fnSettings().aoData[ rowAddedRef[0] ].nTr;
				 $(row).attr("id","row-"+data.rowIndex);
				 $(row).attr("value",data.rowIndex);
			}
		});
	})
	.on("click", "span.deleteButton",function(){
		var nameId=$(this).attr("name");
		var deleteId=$(this).parent().parent().attr("value");
		$.ajax({
			url:"ajax.php",
			type:"POST",
			data:(function () {
				var data={};
				data.host=host;
				data.database=database;
				data.user=user;
				data.password=password;
				data.table=table;
				data.operation="delete";
				data.value=deleteId;
				data.name=nameId;
				return JSON.stringify(data);	
			})()	,
			success:function(data){
				//alert(data);
				var data=JSON.parse(data);
				$("#status").text(data.msg);
				$("#row-"+data.value).css({
						"background":"red"
					});
				$("#row-"+data.value).fadeOut(500);
			}
		});
	});
});	