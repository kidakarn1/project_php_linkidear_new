<?php include("conn.php");
$sql_category="select CAT_ID,CAT_NAME,WIDTH,HEIGHT from category";
$sql_category_price="select DISTINCT PRICE from category";
$res_category=oci_parse($conn,$sql_category);
$res_category_price=oci_parse($conn,$sql_category_price);
oci_execute($res_category,OCI_DEFAULT);
oci_execute($res_category_price,OCI_DEFAULT);
?>
<div class="modal fade " id="lable" tabindex="-1" role="dialog" aria-labelledby="lable" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="lable">สั่งทำป้าย</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  <form method="post" action="insert_lable.php">
			<div class="form-group">
                 <label class="col-sm-2 control-label" for="firstname">ชื่อ</label>
			      <div class="col-sm-4">
					  <input type="text" class="form-control" id="firstname" name="firstname" placeholder="ชื่อ" required/>
                  </div>
				  <label class="col-sm-2 control-label" for="lastname" >นามสกุล</label>
                   <div class="col-sm-4">
					  <input type="text" class="form-control" id="lastname" name="lastname" placeholder="สกุล"/>
                   </div>
             </div>
			 <div class="hide_naja">
			 <br>
			 <br>
			 <div class="form-groupd">
                 <label class="col-sm-2 control-label" for="phone">เบอร์</label>
			      <div class="col-sm-4">
					  <input type="number" class="form-control" id="phone" name="phone" placeholder="เบอร์โทร" required/>
                  </div>
				  <label class="col-sm-2 control-label" for="email" >อีเมล์</label>
                   <div class="col-sm-4">
					  <input type="email" class="form-control" id="email_naja" name="email" placeholder="อีเมล์"/>
                   </div>
             </div>
			 <br>
			 <br>
			 <div class="form-groupd">
				<label class="col-sm-2 control-label" for="address">ที่อยู่</label>
				<div class="col-sm-10">
					<textarea class="form-control" id="address" name="address" required></textarea>
				</div>
          </div>
			 <br>
		  	 <br>
			 <br>
		 </div><!-- ปิดdivnaja -->
			 <div class="form-groupd">
				<label class="col-sm-2 control-label" for="descrption">รายละเอียด</label>
				<div class="col-sm-10">
					<textarea class="form-control" id="descrption" name="descrption" required></textarea>
				</div>
          </div>
		<div class="hide_naja">
		   <br>
		   <br>
		   <br>
		   </div><!-- ปิดdivnaja -->
			 <div class="form-group">
                 <label class="col-sm-2 control-label" for="width">กว้าง/เมตร</label>
			      <div class="col-sm-4">
					  <input type="number" class="form-control" id="width" name="width" placeholder="ความกว้าง" required/>
                  </div>
				  <label class="col-sm-2 control-label" for="height" >สูง/เมตร</label>
                   <div class="col-sm-4">
					  <input type="number" class="form-control" id="height" name="height" placeholder="ความสูง" required/>
                   </div>
             </div>
		   <br>
		   <br>
			 <div class="form-group">
                 <label class="col-sm-2 control-label" for="phone">ประเภท</label>
			      <div class="col-sm-4">
					  <div id="cat_name">
							<select id="cat_name" name="cat_id">
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
                   <div class="col-sm-4">
						<select id="price" name="price">
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
			      <div class="col-sm-4">
					  <input type="number" class="form-control" id="number" name="number" placeholder="จำวนวน"/>
                  </div>
				  <label class="col-sm-2 control-label" for="total" >ราคารวม</label>
                   <div class="col-sm-4">

					  <div id="total"></div>
                   </div>
             </div>
			 <br>
			 <br>
		<div class="modal-footer">
			<button type="button" class="btn btn-primary" id="cal">คำนวณราคา</button>
			<button type="button" class="btn btn-warning" id="print">ปริ้นใบเสร็จ</button>
			<button type="submit" class="btn btn-success" id="ok_naja">บันทึก</button>
			<button type="reset" class="btn btn-danger">ยกเลิก</button>
		</div>
	 </form>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function(){
    $("#cal").click(function(){
		var width = $("#width").val();
		var height = $("#height").val();
		var number = $("#number").val();
		var price = $("#price").val();
		var checkwidth = $("#checkwidth").val();
		var checkheight = $("#checkheight").val();
		if (number==null || number<=0)
		{
			number=1;
		}
		var total = (width*height)*price*number;
		//$("#username").val()
		$("#total").html(total+"บาท");
    });
	$("#print").click(function(){
		$(".show_hide").hide();
		$(".show_hide_index").hide();
		$(".footer_show_hide").hide();
		$(".hide_naja").hide();
		$(".modal-footer").hide();
		window.print();
		$(".show_hide").show();
		$(".show_hide_index").show();
		$(".footer_show_hide").show();
		$(".hide_naja").show();
		$(".modal-footer").show();
	});
});
</script>
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