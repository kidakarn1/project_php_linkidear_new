<div class="modal fade" id="create-item" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">แก้ไขรหัสผ่าน</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!---->
            <!-- <form  data-toggle="validator"> -->
            <div class="modal-body">
                <div class="form-group">
                    <lable calss="control-label" for="title"><h3><font color="red"><center>รหัสผ่านเก่า</csnter></font></h3></lable>
                    <input type="password" id="pass_old" name="pass_old" class="form-control" data-error="Please ente title" required>
                    <div class="help-block with-errors">
                    </div>
                </div>
                <div class="form-group">
                    <lable calss="control-label" for="title"><h3><font color="blue"><center>รหัสผ่านใหม่</csnter></font></h3></lable>
                    <input type="password" id="pass_new"name="pass_new" class="form-control" data-error="Please ente title" required>
                    <div class="help-block with-errors">
                    </div>
                </div>
                <div class="form-group">
                    <lable calss="control-label" for="title"><h3><font color="green"><center>ยืนยันรหัสผ่าน</csnter></font></h3></lable>
                    <input type="password" id="con_pass" name="con_pass" class="form-control" data-error="Please ente title" required>
                    <div class="help-block with-errors">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button id="save" class="btn btn-success" onclick="check_pass()">บันทึก</button>
            </div>
            <!-- </form> -->
        </div>
    </div>
</div>
