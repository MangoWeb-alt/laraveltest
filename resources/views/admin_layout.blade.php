<?php use Illuminate\Support\Facades\Session; ?>
<!DOCTYPE html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
    <!-- bootstrap-css -->
    <link rel="stylesheet" href="{{asset('style/backend/css/bootstrap.min.css')}}" >
    <!-- //bootstrap-css -->
    <!-- Custom CSS -->
    <link href="{{asset('style/backend/css/style.css')}}" rel='stylesheet' type='text/css' />
    <link href="{{asset('style/backend/css/style-responsive.css')}}" rel="stylesheet"/>
    <!-- font CSS -->
    <link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
    <!-- font-awesome icons -->
    <link rel="stylesheet" href="{{asset('style/backend/css/font.css')}}" type="text/css"/>
    <link href="{{asset('style/backend/css/font-awesome.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('style/backend/css/morris.css')}}" type="text/css"/>
    <!-- calendar -->
    <link rel="stylesheet" href="{{asset('style/backend/css/monthly.css')}}">
    <!-- //calendar -->
    <!-- //font-awesome icons -->
    <script src="{{asset('style/backend/js/jquery2.0.3.min.js')}}"></script>
    <script src="{{asset('style/backend/js/raphael-min.js')}}"></script>
    <script src="{{asset('style/backend/js/morris.js')}}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>
<body>
<section id="container">
    <!--header start-->
    <header class="header fixed-top clearfix">
        <!--logo start-->
        <!--logo end-->
        <div class="nav notify-row" id="top_menu">
            <!--  notification start -->
            <ul class="nav top-menu">
                <!-- settings start -->
                <li class="dropdown">
                    <ul class="dropdown-menu extended tasks-bar">
                    </ul>
                </li>
                <!-- settings end -->
                <!-- inbox dropdown start-->
                <!-- inbox dropdown end -->
                <!-- notification dropdown start-->
                <!-- notification dropdown end -->
            </ul>
            <!--  notification end -->
        </div>
        <div class="top-nav clearfix">
            <!--search & user info start-->
            <ul class="nav pull-right top-menu">
                <li>
                    <input type="text" class="form-control search" placeholder=" Search">
                </li>
                <!-- user login dropdown start-->
                <li class="dropdown">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <img alt="" src="{{URL::to('style/backend/images/2.png')}}">
                        <span class="username"><?php echo Session::get('admin_name'); ?></span>
                        <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu extended logout">
                        <li><a href="#"><i class=" fa fa-suitcase"></i>Profile</a></li>
                        <li><a href="#"><i class="fa fa-cog"></i> Settings</a></li>
                        <li><a href="{{URL::to('/logout')}}"><i class="fa fa-key"></i> Log Out</a></li>
                    </ul>
                </li>
                <!-- user login dropdown end -->

            </ul>
            <!--search & user info end-->
        </div>
    </header>
    <!--header end-->
    <!--sidebar start-->
    <aside>
        <div id="sidebar" class="nav-collapse">
            <!-- sidebar menu start-->
            <div class="leftside-navigation">
                <ul class="sidebar-menu" id="nav-accordion">
                    <li>
                        <a class="active" href="{{URL::to('/dashboard')}}">
                            <i class="fa fa-dashboard"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="sub-menu">
                        <a href="javascript:">
                            <i class="fa fa-tasks"></i>
                            <span>Slider</span>
                        </a>
                        <ul class="sub">
                            <li><a href="{{URL::to('/add-slider')}}">Add Slider</a></li>
                            <li><a href="{{URL::to('/manage-slider')}}">Slider List</a></li>

                        </ul>
                    </li>
                    <li class="sub-menu">
                        <a href="javascript:">
                            <i class="fa fa-tasks"></i>
                            <span>Category</span>
                        </a>
                        <ul class="sub">
                            <li><a href="{{URL::to('/add-category')}}">Add Category</a></li>
                            <li><a href="{{URL::to('category-list')}}">Category List</a></li>
                        </ul>
                    </li>
                    <li class="sub-menu">
                        <a href="javascript:;">
                            <i class="fa fa-tasks"></i>
                            <span>Brand</span>
                        </a>
                        <ul class="sub">
                            <li><a href="{{URL::to('/add-brand')}}">Add Brand</a></li>
                            <li><a href="{{URL::to('/brand-list')}}">Brand List</a></li>
                        </ul>
                    </li>
                    <li class="sub-menu">
                        <a href="javascript:">
                            <i class="fa fa-tasks"></i>
                            <span>Product</span>
                        </a>
                        <ul class="sub">
                            <li><a href="{{URL::to('/add-product')}}">Add Product</a></li>
                            <li><a href="{{URL::to('/product-list')}}">Product List</a></li>
                        </ul>
                    </li>
                    <li class="sub-menu">
                        <a href="javascript:">
                            <i class="fa fa-tasks"></i>
                            <span>Discount Code</span>
                        </a>
                        <ul class="sub">
                            <li><a href="{{URL::to('/insert-coupon')}}">Add Code</a></li>
                            <li><a href="{{URL::to('coupon-list')}}">Code List</a></li>
                        </ul>
                    </li>
                    <li class="sub-menu">
                        <a href="javascript:">
                            <i class="fa fa-tasks"></i>
                            <span>Delivery</span>
                        </a>
                        <ul class="sub">
                            <li><a href="{{URL::to('/add-delivery')}}">Add Delivery</a></li>
                        </ul>
                    </li>
                    <li class="sub-menu">
                        <a href="javascript:;">
                            <i class="fa fa-book"></i>
                            <span>Order</span>
                        </a>
                        <ul class="sub">
                            <li><a href="{{URL::to('/manage-order')}}">Order List</a></li>


                        </ul>
                    </li>
                </ul>            </div>
            <!-- sidebar menu end-->
        </div>
    </aside>
    <!--sidebar end-->
    <!--main content start-->
    <section id="main-content">
        <section class="wrapper">
            <!-- //market-->
            <div class="market-updates">
                @yield('content')
            </div>
            <!-- //market-->
        </section>
        <!-- footer -->
        <div class="footer">
            <div class="wthree-copyright">
                <p>© 2017 Visitors. All rights reserved | Design by <a href="http://w3layouts.com">W3layouts</a></p>
            </div>
        </div>
        <!-- / footer -->
    </section>
    <!--main content end-->
</section>
<script src="{{asset('style/backend/js/bootstrap.js')}}"></script>
<script src="{{asset('style/backend/js/jquery.dcjqaccordion.2.7.js')}}"></script>
<script src="{{asset('style/backend/js/scripts.js')}}"></script>
<script src="{{asset('style/backend/js/jquery.slimscroll.js')}}"></script>
<script src="{{asset('style/backend/js/jquery.nicescroll.js')}}"></script>
{{--<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->--}}
<script src="{{asset('style/backend/js/jquery.scrollTo.js')}}"></script>
<script src="{{asset('style/backend/ckeditor/ckeditor.js')}}"></script>
<script src="{{asset('style/backend/js/jquery.form-validator.min.js')}}"></script>
<script src="{{asset('style/frontend/js/jquery.js')}}"></script>
<script src="{{asset('style/frontend/js/jquery.scrollUp.min.js')}}"></script>
<script src="{{asset('style/frontend/js/price-range.js')}}"></script>
<script src="{{asset('style/frontend/js/jquery.prettyPhoto.js')}}"></script>
<script src="{{asset('style/frontend/js/main.js')}}"></script>
<script src="{{asset('style/frontend/js/sweetalert.min.js')}}"></script>
<script>
    $.validate({

    });
</script>
<script>
    $(function () {
        $('.update_quantity_order').click(function () {
            var order_product_id = $(this).data('product_id');
            var order_quantity = $('.order_quantity_'+order_product_id).val();
            var order_code = $('.order_code').val();
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: '{{url("/update-quantity-order")}}',
                method: 'POST',
                data:{order_quantity:order_quantity,order_code:order_code,_token:_token,order_product_id:order_product_id},
                success(data){
                    alert('update quantity successfully');
                    window.setTimeout(function () {
                        location.reload();
                    },3000);
                }
            });
        });
    })
</script>
<script>
        $('.order_details_status').change(function () {
            var order_status = $(this).val();
            var order_id = $(this).children(":selected").data('id');
            var _token = $('input[name="_token"]').val();

            quantity = [];
            $("input[name='product_sales_quantity']").each(function () {
                quantity.push($(this).val());
            });
            order_product_id = [];
            $("input[name='order_product_id']").each(function () {
                order_product_id.push($(this).val());
            });
            j=0;
            for(i=0;i<order_product_id.length;i++){
                var order_quantity = $('.order_quantity_'+order_product_id[i]).val();
                var order_quantity_storage = $('.order_quantity_storage_'+order_product_id[i]).val();
              if(parseInt(order_quantity) > parseInt(order_quantity_storage)){
                 ++j;
                 if(j==1){
                     alert('Out of Stock');
                 }
                  $('.color_background_'+order_product_id[i]).css('background','lightblue');
              }
            }
            if(j==0){
                $.ajax({
                    url: '{{url("/update-order-quantity")}}',
                    method: 'POST',
                    data:{order_status:order_status,order_id:order_id,_token:_token,quantity:quantity,order_product_id:order_product_id},
                    success(data){
                        alert('Change method Successfully');
                        location.reload();
                    }
                });
            }
        });
</script>
<script>
    $(function () {

        fetch_delivery();

        function fetch_delivery(){
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: '{{url("/load-delivery")}}',
                method: 'POST',
                data:{_token:_token},
                success:function (data) {
                    $('#load_delivery').html(data);
                }
            });
        }

        $(document).on('blur','.delivery_cost_edit',function () {
           var delivery_id = $(this) .data('delivery_id');
           var delivery_value = $(this).text();
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: '{{url("/update-delivery-ajax")}}',
                method: 'POST',
                data:{delivery_id:delivery_id,delivery_value:delivery_value,_token:_token},
                success:function (data) {
                    // alert('Edit Delivery Fee successfully!!!');
                    fetch_delivery();
                }
            });
        });
     $('.add_delivery_cost').click(function () {
        var city = $('.city').val();
        var province = $('.province').val();
        var wards = $('.wards').val();
        var delivery_cost = $('.delivery_cost').val();
         var _token = $('input[name="_token"]').val();
         $.ajax({
             url: '{{url("/insert-delivery")}}',
             method: 'POST',
             data:{city:city, province:province, wards:wards,delivery_cost:delivery_cost,_token:_token},
             success:function (data) {
                 // alert('Add Delivery Fee successfully!!!');
                 fetch_delivery();
             }
         });
     });
        $('.choose').change(function () {
             var action = $(this).attr('id');
             var ma_id = $(this).val();
             var _token = $('input[name="_token"]').val();
             var result = '';

             if(action == 'city') {
                 result = 'province';
             } else if(action == 'province') {
                 result = 'wards';
             }

            $.ajax({
                url: '{{url("/select-delivery")}}',
                method: 'POST',
                data:{action:action,ma_id:ma_id,_token:_token},
                success:function (data) {
                    $('#'+result).html(data);
                }
            });
        });
    });
</script>
<script>

</script>
<script>
    CKEDITOR.replace('ckEditor');
    CKEDITOR.replace('ckEditor1');
    CKEDITOR.replace('ckEditor2');
    CKEDITOR.replace('ckEditor3');
    CKEDITOR.replace('ckEditor4');
    CKEDITOR.replace('ckEditor5');
    CKEDITOR.replace('ckEditor6');
    CKEDITOR.replace('ckEditor7');
    CKEDITOR.replace('ckEditor8');
    CKEDITOR.replace('ckEditor9');
    CKEDITOR.replace('ckEditor11');
    CKEDITOR.replace('ckEditor12');
    CKEDITOR.replace('ckEditor13');
    CKEDITOR.replace('ckEditor14');
    CKEDITOR.replace('ckEditor15');
    CKEDITOR.replace('ckEditor16');
    CKEDITOR.replace('ckEditor17');
</script>
<!-- morris JavaScript -->
<script>
    $(document).ready(function() {
        //BOX BUTTON SHOW AND CLOSE
        jQuery('.small-graph-box').hover(function() {
            jQuery(this).find('.box-button').fadeIn('fast');
        }, function() {
            jQuery(this).find('.box-button').fadeOut('fast');
        });
        jQuery('.small-graph-box .box-close').click(function() {
            jQuery(this).closest('.small-graph-box').fadeOut(200);
            return false;
        });

        //CHARTS
        function gd(year, day, month) {
            return new Date(year, month - 1, day).getTime();
        }

        graphArea2 = Morris.Area({
            element: 'hero-area',
            padding: 10,
            behaveLikeLine: true,
            gridEnabled: false,
            gridLineColor: '#dddddd',
            axes: true,
            resize: true,
            smooth:true,
            pointSize: 0,
            lineWidth: 0,
            fillOpacity:0.85,
            data: [
                {period: '2015 Q1', iphone: 2668, ipad: null, itouch: 2649},
                {period: '2015 Q2', iphone: 15780, ipad: 13799, itouch: 12051},
                {period: '2015 Q3', iphone: 12920, ipad: 10975, itouch: 9910},
                {period: '2015 Q4', iphone: 8770, ipad: 6600, itouch: 6695},
                {period: '2016 Q1', iphone: 10820, ipad: 10924, itouch: 12300},
                {period: '2016 Q2', iphone: 9680, ipad: 9010, itouch: 7891},
                {period: '2016 Q3', iphone: 4830, ipad: 3805, itouch: 1598},
                {period: '2016 Q4', iphone: 15083, ipad: 8977, itouch: 5185},
                {period: '2017 Q1', iphone: 10697, ipad: 4470, itouch: 2038},

            ],
            lineColors:['#eb6f6f','#926383','#eb6f6f'],
            xkey: 'period',
            redraw: true,
            ykeys: ['iphone', 'ipad', 'itouch'],
            labels: ['All Visitors', 'Returning Visitors', 'Unique Visitors'],
            pointSize: 2,
            hideHover: 'auto',
            resize: true
        });


    });
</script>
<!-- calendar -->
<script type="text/javascript" src="js/monthly.js"></script>
<script type="text/javascript">
    $(window).load( function() {

        $('#mycalendar').monthly({
            mode: 'event',

        });

        $('#mycalendar2').monthly({
            mode: 'picker',
            target: '#mytarget',
            setWidth: '250px',
            startHidden: true,
            showTrigger: '#mytarget',
            stylePast: true,
            disablePast: true
        });

        switch(window.location.protocol) {
            case 'http:':
            case 'https:':
                // running on a server, should be good.
                break;
            case 'file:':
                alert('Just a heads-up, events will not work when run locally.');
        }

    });
</script>
<!-- //calendar -->
</body>
</html>
