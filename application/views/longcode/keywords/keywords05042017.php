<div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
		<div class="col-md-12 col-sm-12 col-xs-12 missedcall_allform padding_zero">
		<div class="col-md-8 col-sm-8 col-xs-12 col-sm-offset-4 col-md-offset-4 padding_zero">
		
		<div class="col-md-5 col-sm-5 col-xs-12 form-div padding_ltzero">
		
                      <select name="longcode_numbers" class="longcode_numbers" >
                       <option value="">Select Numbers</option>
                      <?php
                      foreach($longcode_numbers as $key=>$longcode_number)
                      {
                      ?>
                      <option value="<?php echo $longcode_number->longcode_number;?>">
                      <?php echo $longcode_number->longcode_number;?></option>
                      <?php
                      }
                      ?>
                      </select>
		
		<span class="getkeywordnomsg"></span>
		</div>
		
		<div class="col-md-5 col-sm-5 col-xs-12 form-div padding_ltzero">
		
		<input type="text" placeholder="Please enter atleast 5 characters" maxlength="15" class="getkeyword">
		
		<span class="getkeywordmsg"></span>
		</div>
		
		<div class="col-md-2 col-sm-2 col-xs-12 form-div padding_zero">
		
		<input type="button" name="createkeyword" class="submit_btn createkeyword" value="create">
		
		<input type="button" name="updatekeyword"  style="display:none" class="submit_btn updatekeyword" value="Update">
		
		<input type="hidden" name="updatekeywordid"  class="updatekeywordid">
		
		</div>
		</div>
		</div>
		<div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
		<p class="aval-num-title">Keywords</p>
		<span class="keywords_message"></span>
		</div>
		<div class="col-md-12 col-sm-12 col-xs-12 form-div avalble_numbers">
		<div class="col-md-12 col-sm-12 col-xs-12 padding_zero service_avb_div">
<div class="scroll_num scroll_numbar">
</table>
<div class="displaytable" >

<!--
	<table class="table_all">
	<thead>
	<tr>
	<th>S.No</th>
	<th>Keywords</th>
	<th colspan="2">Action</th>
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
		<span class="displayspan<?php echo $keyword->keyword_id;?>" >
		<?php echo $keyword->keyword_name;?>
		</span>
<input type="text" style="display:none" name="editkeywordtext<?php echo $keyword->keyword_id;?>"
 class="editkeywordtext<?php echo $keyword->keyword_id;?>" 
value="<?php echo $keyword->keyword_name;?>" >
		<span class="editkeywordtextmsg<?php echo $keyword->keyword_id;?>" ></span>
		</td>
		
		<td>
		<span class="create-btn editkeywordspan<?php echo $keyword->keyword_id;?>">Edit</span>
		<span style="display:none" class="create-btn savekeywordbtn<?php echo $keyword->keyword_id;?>">Save</span>
		</td>
		<td><span class="create-btn deletekeywordbtn<?php echo $keyword->keyword_id;?>">Delete</span></td>
		</tr>
	
		<script>
		$(document).ready(function() {
		
		$(".editkeywordspan<?php echo $keyword->keyword_id;?>").on("click",function() {
		
		$(".editkeywordspan<?php echo $keyword->keyword_id;?>").css('display','none');
		$(".displayspan<?php echo $keyword->keyword_id;?>").css('display','none');
		$(".editkeywordtext<?php echo $keyword->keyword_id;?>").css('display','block');
		$(".savekeywordbtn<?php echo $keyword->keyword_id;?>").css('display','block');
		
		$(".editkeywordtext<?php echo $keyword->keyword_id;?>").val("<?php echo $keyword->keyword_name;?>");
		
		});


		// Update KEYWORD
		
		$(".savekeywordbtn<?php echo $keyword->keyword_id;?>").on("click",function() {

		 var getkeyword=$(".editkeywordtext<?php echo $keyword->keyword_id;?>").val();
		 var keyword_id="<?php echo $keyword->keyword_id;?>";
		 
		 $(".editkeywordtext<?php echo $keyword->keyword_id;?>").val( $(".editkeywordtext<?php echo $keyword->keyword_id;?>").val());
		
		 if(getkeyword!='')
		 {
		 
		 $(".editkeywordtextmsg<?php echo $keyword->keyword_id;?>").html('');
		 	// get silver numbers
		 	        $.ajax({
		 	                method:"GET",
		 	                data : {getkeyword:getkeyword,keyword_id:keyword_id},
		 	                url:"<?php echo base_url()?>longcode/updatekeyword",
		 	                dataType:"json",
		 	                success:function(data){
		 	                
		 	                console.log(data);
		 	                    //$(".displaysilvertab").html(data);
		 	                    
						//$(".editkeywordbtn<?php echo $keyword->keyword_id;?>").show();
						//$(".display<?php echo $keyword->keyword_id;?>").show();
						
						console.log(data.status);
							if(data.status=='success')
							{
							
							
								$(".editkeywordspan<?php echo $keyword->keyword_id;?>").css('display','block');
								$(".displayspan<?php echo $keyword->keyword_id;?>").css('display','block');
								
		$(".displayspan<?php echo $keyword->keyword_id;?>").html($(".editkeywordtext<?php echo $keyword->keyword_id;?>").val());


            $(".editkeywordtext<?php echo $keyword->keyword_id;?>").val($(".editkeywordtext<?php echo $keyword->keyword_id;?>").val());
								$(".editkeywordtext<?php echo $keyword->keyword_id;?>").css('display','none');
								$(".savekeywordbtn<?php echo $keyword->keyword_id;?>").css('display','none');
								
									$.ajax({
									method:"GET",
									data : {getkeyword:getkeyword},
									url:"<?php echo base_url()?>longcode/displaykewords",
									success:function(data){

									$(".displaytable").html(data);

									},
									});
								
								
							}
		 	                    
		 	                    },
		 	       });
		 }
		 else
		 {
			 $(".editkeywordtextmsg<?php echo $keyword->keyword_id;?>").html("Please enter keyword");
			 $(".editkeywordtextmsg<?php echo $keyword->keyword_id;?>").css("color","red");
		 }

		 });
		 
		 // delete keyword
		 
		 $(".deletekeywordbtn<?php echo $keyword->keyword_id;?>").on("click",function() {
		 var keyword_id="<?php echo $keyword->keyword_id;?>";
		 if(keyword_id!='')
		 {
		 	// get silver numbers
		 	        $.ajax({
		 	                method:"GET",
		 	                data : {keyword_id:keyword_id},
		 	                url:"<?php echo base_url()?>longcode/deletekeyword",
		 	                dataType:"json",
		 	                success:function(data){
		 	                console.log(data);
						console.log(data.status);
							if(data.status=='success')
							{
								$(".displayrow<?php echo $keyword->keyword_id;?>").css('display','none');
								
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
		
		
		
		
	<?php
	$sno++;
	}
	?>
	</tbody>
	</table>
--->
<table class="table_all">
	<thead>
	<tr>
	<th>S.No</th>
	<th>Keyword</th>
	<th>Number</th>
	<th colspan="2">Action</th>
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
		<td>
		<span class="btn btn-sm btn-default editkeywordspan<?php echo $keyword->keyword_id;?>">Edit</span>
		</td>
		<td><span class="btn btn-sm btn-default deletekeywordbtn<?php echo $keyword->keyword_id;?>">Delete</span></td>
		</tr>
		
		<script>
$(document).ready(function() {

// edit keywords
		$(".editkeywordspan<?php echo $keyword->keyword_id;?>").on("click",function() {
		
		var longcode_number="<?php echo $keyword->longcode_number;?>";
		var getkeyword="<?php echo $keyword->keyword_name;?>";
		
		$(".updatekeywordid").val("<?php echo $keyword->keyword_id;?>");
		
		$(".createkeyword").hide();
		
			$.ajax({
			method:"GET",
			data : {getkeyword:getkeyword,longcode_number:longcode_number,service_type:"dedicated"},
			url:"<?php echo base_url()?>longcode/geteditnumbers",
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
		 if(keyword_id!='')
		 {

		 	// get silver numbers
		 	        $.ajax({
		 	                method:"GET",
		 	                data : {keyword_id:keyword_id},

		 	                url:"<?php echo base_url()?>longcode/deletekeyword",
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
		
		
		
	<?php
	$sno++;
	}
	?>
	</tbody>
	</table>
	
	</div>	

</div>
</div>
</div>

<!--
<div class="col-md-12 col-sm-12 col-xs-12 text-right padding_zero">
<span><a href="" class="create-btn">Edit</a></span>
<span><a href="" class="create-btn">Delete</a></span>
</div>
-->
</div>

<script>
$(document).ready(function() {

	// get keywords for displaytable
	$.ajax({
	method:"GET",
	url:"<?php echo base_url()?>longcode/displaykewords",
	success:function(data){
	$(".displaytable").html(data);
	},
	});
					
// CREATE KEYWORD
 $(".createkeyword").on("click",function() {
 
	// get keywords for displaytable
	$.ajax({
	method:"GET",
	url:"<?php echo base_url()?>longcode/displaykewords",
	success:function(data){
	$(".displaytable").html(data);
	},
	});
					
		 //alert("dsghsdj");
		 var getkeyword=$(".getkeyword").val();
		 var longcode_numbers=$(".longcode_numbers").val();
		// console.log(getkeyword);
	 if(longcode_numbers!='')
	 {
		 $(".getkeywordnomsg").html('');
		 if(getkeyword!='')
		 {
				$(".getkeywordmsg").html('');
				// get silver numbers
				$.ajax({
				method:"GET",
				dataType:"json",
				data : {getkeyword:getkeyword,longcode_numbers:longcode_numbers,service_type:"dedicated"},
				url:"<?php echo base_url()?>longcode/createkeyword",
				success:function(data){

					console.log(data);
				//$(".displaytable").html(data);
               if(data.color=='green')
               {
				      // get keywords for displaytable
					$.ajax({
					method:"GET",
					url:"<?php echo base_url()?>longcode/displaykewords",
					success:function(data){
					$(".displaytable").html(data);
					},
					});
					
					// get keywords for drop down
	
					$.ajax({
					method:"GET",
					url:"<?php echo base_url()?>longcode/getkewords",
					success:function(data){
					$(".getkeywords").html(data);
					},
					});

					 $(".keywords_message").html(data.message);
	                 $(".keywords_message").css("color",data.color);    
               }
               else
               {
	                 $(".keywords_message").html(data.message);
	                 $(".keywords_message").css("color",data.color);    
               }
				

				},
				});
		 }
		 else
		 {
		$(".keywords_message").html('');
		 $(".getkeywordmsg").html("Please enter keyword");
		 $(".getkeywordmsg").css("color","red");

		 }

	 }
	 else
	 {
	 $(".keywords_message").html('');	 
	 $(".getkeywordnomsg").html("Select loncode number");
	 $(".getkeywordnomsg").css("color","red");

	 }

		 });
		 

// CREATE KEYWORD
 $(".updatekeyword").on("click",function() {
		 //alert("dsghsdj");
		 var getkeyword=$(".getkeyword").val();
		 var longcode_numbers=$(".longcode_numbers").val();
		 
		 var updatekeywordid = $(".updatekeywordid").val();
		 
		// console.log(getkeyword);
	 if(longcode_numbers!='')
	 {
		 $(".getkeywordnomsg").html('');
		 if(getkeyword!='')
		 {
				$(".getkeywordmsg").html('');
				// get silver numbers
				$.ajax({
				method:"GET",
				dataType:"json",
				data : {getkeyword:getkeyword,longcode_numbers:longcode_numbers,service_type:"dedicated",
				updatekeywordid:updatekeywordid},
				url:"<?php echo base_url()?>longcode/keywordupdate",
				success:function(data){

					console.log(data);
				//$(".displaytable").html(data);
               if(data.color=='green')
               {
				// get keywords for displaytable

	
					$.ajax({
					method:"GET",
					url:"<?php echo base_url()?>longcode/displaykewords",
					success:function(data){
					$(".displaytable").html(data);
					},
					});
					
					// get keywords for drop down
	
					$.ajax({
					method:"GET",
					url:"<?php echo base_url()?>longcode/getkewords",
					success:function(data){
					$(".getkeywords").html(data);
					},
					});

					 $(".keywords_message").html("Keyword update successfully");
	                         $(".keywords_message").css("color",data.color);
	                 
	                  $(".updatekeyword").hide();
	                  $(".createkeyword").show();      
               }
               else
               {
	                 $(".keywords_message").html(data.message);
	                 $(".keywords_message").css("color",data.color);    
               }
				

				},
				});
		 }
		 else
		 {
		$(".keywords_message").html('');
		 $(".getkeywordmsg").html("Please enter keyword");
		 $(".getkeywordmsg").css("color","red");

		 }

	 }
	 else
	 {
	 $(".keywords_message").html('');	 
	 $(".getkeywordnomsg").html("Select loncode number");
	 $(".getkeywordnomsg").css("color","red");

	 }

		 });

});
</script>

