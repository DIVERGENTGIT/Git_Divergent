
	<table class="table_all">
	<thead>
	<tr>
	<th>S.No</th>
	<th>Keyword</th>
	<th>Number</th>
	<th colspan="1">Action</th>
	</tr>
	</thead>
	<tbody>
	<?php
	//print_r($getkeywords);
	$sno=1;
	foreach($getkeywords as $key=>$keyword)
	{
	?>
		<tr class="displayrow<?php echo $keyword->keyword_id;?>" >
		<td><?php echo $sno;?></td>
		<td>
		<?php echo $keyword->keyword_name;?>
		</td>
		<td>
		<?php echo $keyword->longcode_number;?>
		</td>
		<!--
		<td>
		<span class="btn btn-sm btn-default editsharedkeywordspan<?php echo $keyword->keyword_id;?>">Edit</span>
		</td>
		-->
		<td><span class="btn btn-sm btn-default deletekeywordbtn<?php echo $keyword->keyword_id;?>">Delete</span></td>
			
		<script>
$(document).ready(function() {

// edit keywords
		$(".editsharedkeywordspan<?php echo $keyword->keyword_id;?>").on("click",function() {
		
		var longcode_number="<?php echo $keyword->longcode_number;?>";
		var getkeyword="<?php echo $keyword->keyword_name;?>";
		
		$(".updatekeywordid").val("<?php echo $keyword->keyword_id;?>");
		
		$(".createkeyword").hide();
		
			$.ajax({
			method:"GET",
			data : {getkeyword:getkeyword,longcode_number:longcode_number,service_type:"shared"},
			url:"<?php echo base_url()?>longcode_shared/geteditnumbers",
			success:function(data){
		
			console.log(data);
		
			$(".longcode_numbers").html(data);
		
			$(".getkeyword").val(getkeyword);
		
			//$(".createkeyword").val("Save");
			
			$(".updatekeyword").show();

			}
			});
		});
// delete keyword

 // delete keyword
		 

		 $(".deletekeywordbtn<?php echo $keyword->keyword_id;?>").on("click",function() {
		 var keyword_id="<?php echo $keyword->keyword_id;?>";
		 var longcode_number="<?php echo $keyword->longcode_number;?>";
		 var getkeyword="<?php echo $keyword->keyword_name;?>";
		 if(keyword_id!='')
		 {


			var longcode_number="<?php echo $keyword->longcode_number;?>";
			var getkeyword="<?php echo $keyword->keyword_name;?>";
		 	// get silver numbers
		 	        $.ajax({
		 	                method:"GET",
		 	                data : {keyword_id:keyword_id,longcode_number:longcode_number,getkeyword:getkeyword},

		 	                url:"<?php echo base_url()?>longcode_shared/deletekeyword",
		 	                dataType:"json",
		 	                success:function(data){
		 	                console.log(data);

						console.log(data.status);
							if(data.status=='success')
							{
								$(".displayrow<?php echo $keyword->keyword_id;?>").css('display','none');
								
								 $(".keywords_message").html("Keyword deleted successfully!..");
								  $(".keywords_message").css('color','green');

								
							}
		 	                    
		 	                    },

		 	       });
		 }
		 else
		 {
			 //$(".editkeywordtextmsg<?php echo $keyword->keyword_id;?>").html("Please enter keyword");

			 //$(".editkeywordtextmsg<?php echo $keyword->keyword_id;?>").css("color","red");
		 }

		 });
		 
		});
	</script>	
		
	
		</tr>
	<?php
	$sno++;
	}
	?>
	</tbody>
	</table>


	

