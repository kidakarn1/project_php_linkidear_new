<style>
    .social:hover {
        -webkit-transform: scale(1.1);
        -moz-transform: scale(1.1);
        -o-transform: scale(1.1);
    }
    .social {
        -webkit-transform: scale(0.8);
        /* Browser Variations: */

        -moz-transform: scale(0.8);
        -o-transform: scale(0.8);
        -webkit-transition-duration: 0.5s;
        -moz-transition-duration: 0.5s;
        -o-transition-duration: 0.5s;
    }

    /*
        Multicoloured Hover Variations
    */

    #social-fb:hover {
        color: #3B5998;
    }
    #social-tw:hover {
        color: #4099FF;
    }
    #social-gp:hover {
        color: #d34836;
    }
    #social-em:hover {
        color: #f39c12;
    }

</style>

<!-- Social Footer, Colour Matching Icons -->
<!-- Include Font Awesome Stylesheet in Header -->

<!-- Social Footer, Single Coloured -->
<!-- Include Font Awesome Stylesheet in Header -->
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
<!-- // -->
<div class="container">
    <hr />
    <div class="text-center center-block">
        <p class="txt-railway" style="color:black">ติดต่อสอบถามรายละเอียด</p>

      
        <a href="" data-toggle="modal" data-target="#line"><img class="fa-3x social" style="margin-top:-27px" src="<?php echo $a;?>img/line.png" width="48px"></a>



        <a href="https://www.facebook.com/dbfkdki11" style="color:blue"><i class="fa fa-facebook-square fa-3x social"></i></a>
    </div>
    <hr />
    <!-- Modal -->
    <div class="modal fade" id="line" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">LINE</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        
                    </button>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                    <img src="<?php echo $a;?>img/line.jpg">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">EXIT</button>
                </div>
            </div>
        </div>
    </div>
</div>