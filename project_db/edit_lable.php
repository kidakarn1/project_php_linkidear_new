<?php include("conn.php");
include("menu.php");
$id=$_GET['id'];
$sql="select * from CUSTOMER,LABLE,CATEGORY where LABLE.CUS_PHONE=CUSTOMER.CUS_PHONE and LABLE.CAT_ID = CATEGORY.CAT_ID and LABLE.LABLE_ID='$id'";
$res=oci_parse($conn,$sql);
oci_execute($res,OCI_DEFAULT);
$row=oci_fetch_array($res,OCI_BOTH);
$sql_category="select CAT_ID,CAT_NAME,WIDTH,HEIGHT from category";
$sql_category_price="select DISTINCT PRICE from category";
$res_category=oci_parse($conn,$sql_category);
$res_category_price=oci_parse($conn,$sql_category_price);
oci_execute($res_category,OCI_DEFAULT);
oci_execute($res_category_price,OCI_DEFAULT);
?>
<center>
	  <form method="post" action="update_lable.php">
	  <input type="hidden" name="lable_id" value="<?php echo $id;?>">
			<div class="form-group">
                 <label class="col-sm-2 control-label" for="firstname1">ชื่อ</label>
			      <div class="col-sm-2">
					  <input type="text" class="form-control" id="firstname1" name="firstname"  value="<?php echo $row['CUS_FNAME'];?>"placeholder="ชื่อ" required/>
                  </div>
				  <label class="col-sm-2 control-label" for="lastname1" >นามสกุล</label>
                   <div class="col-sm-2">
					  <input type="text" class="form-control" id="lastname1" value="<?php echo $row['CUS_LNAME'];?>" name="lastname" placeholder="สกุล"/>
                   </div>
             </div>
			 <div class="hide_naja">
			 <br>
			 <br>
			 <div class="form-groupd">
                 <label class="col-sm-2 control-label" for="phone">เบอร์</label>
			      <div class="col-sm-2">
					  <input type="number" class="form-control" id="phone1" name="phone" value="<?php echo $row['CUS_PHONE'];?>" placeholder="เบอร์โทร" required/>
                  </div>
				  <label class="col-sm-2 control-label" for="email"  >อีเมล์</label>
                   <div class="col-sm-2">
					  <input type="email" class="form-control" id="email1" name="email" value="<?php echo $row['CUS_EMAIL'];?>"  placeholder="อีเมล์"/>
                   </div>
             </div>
			 <br>
			 <br>
			 <div class="form-groupd">
				<label class="col-sm-2 control-label" for="address">ที่อยู่</label>
				<div class="col-sm-6">
					<textarea class="form-control" id="address1" name="address"  required><?php echo $row['CUS_ADDRESS'];?></textarea>
				</div>
          </div>
			 <br>
		  	 <br>
			 <br>
			 </div><!-- ปิดdivnaja -->
				 <div class="form-groupd">
					<label class="col-sm-2 control-label" for="descrption">รายละเอียด</label>
					<div class="col-sm-6">
						<textarea class="form-control" id="descrption1" name="descrption" required><?php echo $row['DESCRIPTION'];?></textarea>
					</div>
			  </div>
			<div class="hide_naja">
			   <br>
			   <br>
			   <br>
			   </div><!-- ปิดdivnaja -->
				 <div class="form-group">
					 <label class="col-sm-2 control-label" for="width">กว้าง/เมตร</label>
					  <div class="col-sm-2">
						  <input type="number" class="form-control" id="width1" name="width" value="<?php echo $row['LABLE_WIDTH']/$row['LABLE_NUMBER'];?>" placeholder="ความกว้าง" required/>
					  </div>
					  <label class="col-sm-2 control-label" for="height" >สูง/เมตร</label>
					   <div class="col-sm-2">
						  <input type="number" class="form-control" id="height1" name="height" value="<?php echo $row['LABLE_HEIGHT']/$row['LABLE_NUMBER'];?>"placeholder="ความสูง" required/>
					   </div>
				 </div>
			   <br>
			   <br>
				 <div class="form-group">
					 <label class="col-sm-2 control-label" for="phone">ประเภท</label>
					  <div class="col-sm-2">
						  <div id="cat_name">
								<select id="cat_name1" name="cat_id">
								<?php
									while($row_category=oci_fetch_array($res_category,OCI_BOTH)){
								?>
									<option value="<?php echo  $row_category['CAT_ID'];?>"><?php echo  $row_category['CAT_NAME'];?></option>
								<?php }
								?>
								</select>
						  </div>
					  </div>
					  <label class="col-sm-2 control-label" for="email" >ราคา</label>
					   <div class="col-sm-2">
							<select id="price1" name="price">
								<?php
									while($row_category_price=oci_fetch_array($res_category_price,OCI_BOTH)){
								?>
									<option value="<?php echo  $row_category_price['PRICE'];?>"><?php echo  $row_category_price['PRICE'];?></option>
								<?php }
								?>
								</select>
					   </div>
				 </div>
				 <br>
				<div class="form-group">
					 <label class="col-sm-2 control-label" for="phone">จำนวน</label>
					  <div class="col-sm-2">
						  <input type="number" class="form-control" id="number1" name="number"  value="<?php echo $row['LABLE_NUMBER'];?>"placeholder="จำวนวน"/>
					  </div>
				 </div>
				 <br>
				 <br>
			<div class="modal-footer">
				<button type="submit" class="btn btn-success">บันทึก</button>
				<button type="reset" class="btn btn-danger">ยกเลิก</button>
			</div>
		 </form>
	 </center>
<script>
/*$( "select" )
  .change(function () {
    var str = "";
    $( "select option:selected" ).each(function() {
      str += $( this ).text() + " ";
    });
  })
  .change();*/
</script>