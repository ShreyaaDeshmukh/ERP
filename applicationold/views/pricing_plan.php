<!DOCTYPE html>
<html >
    <head>
        <meta charset="UTF-8">
        <title>Css Style Pricing Table</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

        <!-- <link rel="stylesheet" href="./assets/css/pricinplan.css"> -->

        <style>
.demo{
background-image: url("http://img1.wsimg.com/isteam/stock/WkBaOy8/:/rs=w:1220,h:560,cg:true,m/cr=w:1220,h:560,a:cc");
        opacity: 1;
        background-size: cover;
padding: 100px 0;
}
.heading-title {margin-bottom: 100px; color: #000;}

.pricingTable{
    box-shadow: 0 0 1px 1px rgba(0, 0, 0, 0.1);
    padding: 50px 15px;
    text-align: center;
    margin-top: 30px;
    color: #292929;
	    background-color:#f1f8ff;

    perspective: 700px;
    z-index: 1;
    position: relative;
    transition: all 0.3s ease-in-out 0s;
}

button{
    
    border: none;
    border-color: transparent;
}

.pricingTable:hover{ color: #fff; }

.pricingTable:after{
    content: "";
    width: 100%;
    height: 100%;
    background: #3c8dbc;
    position: absolute;
    top: 0;
    left: 0;
    opacity: 0;
    z-index: -1;
    transform: rotateY(70deg);
    transition: all 0.3s ease-in-out 0s;
}

.pricingTable:hover:after{
    opacity: 1;
    transform: rotateY(0deg);
}

.pricingTable .icon{
    width: 69px;
    height: 69px;
    line-height: 69px;
    border-radius: 50%;
    background: #fff;
    box-shadow: 0 0 1px 1px rgba(0, 0, 0, 0.1);
    margin: 0 auto;
    font-size: 25px;
    color: #3c8dbc;
    position: absolute;
    top: -34px;
    left: 0;
    right: 0;
}

.pricingTable .pricingTable-header{
    margin-bottom: 30px;
}

.pricingTable .title{
    display: block;
    font-size: 18px;
    font-weight: 600;
    text-transform: uppercase;
    margin: 0 0 10px 0;
}

.pricingTable .price-value{
    display: inline-block;
    border-bottom: 5px solid #3c8dbc;
    font-size: 30px;
    font-weight: 700;
    transition: all 0.3s ease-in-out 0s;
}
.pricingTable:hover .price-value{
    border-bottom-color: #fff;
}

.pricingTable .pricing-content{
    list-style: none;
    padding: 0;
    margin: 0 0 20px 0;
}

.pricingTable .pricing-content li{
    font-size: 14px;
    line-height: 40px;
}

.pricingTable .pricingTable-signup{
    display: inline-block;
    padding: 9px 23px;
    background: #3c8dbc;
    font-size: 14px;
    font-weight: 600;
    color: #fff;
    text-transform: uppercase;
    position: relative;
    transition: all 0.25s ease-in-out 0s;
}

.pricingTable:hover .pricingTable-signup{
    background: #fff;
    color: #3c8dbc;
}

.pricingTable .pricingTable-signup:before,
.pricingTable .pricingTable-signup:after{
    content: "";
    height: 100%;
    position: absolute;
    top: 0;
    border-top: 18px solid transparent;
    border-bottom: 18px solid transparent;
    transition: all 0.25s ease-in-out 0s;
}

.pricingTable .pricingTable-signup:before{
    left: -12px;
    border-right: 12px solid #3c8dbc;
}

.pricingTable .pricingTable-signup:after{
    right: -12px;
    border-left: 12px solid #3c8dbc;
}

.pricingTable:hover .pricingTable-signup:before{
    border-right-color: #fff;
}

.pricingTable:hover .pricingTable-signup:after{
    border-left-color: #fff;
}

@media only screen and (max-width: 990px){
    .pricingTable{ margin-bottom: 30px; }
}

@media only screen and (max-width: 767px){
    .pricingTable{ margin-bottom: 50px; }
}

        </style>

    </head>

    <body>

     <form method="post" action="signup" role="form">
     
     <div class="demo">
        <div class="container">
            <div class="row text-center">
                <h1 class="heading-title"><strong>Pricing Plans</strong></h1>
            </div>

            <div class="row col-md-10" style="margin-left:10%; margin-right:10%;">

                <div class="col-md-6 col-sm-6">
                    <div class="pricingTable">
                        <span class="icon"><i class="fa fa-globe"></i></span>
                        <div class="pricingTable-header">
                            <h3 class="title">Standard</h3>
                            <span class="price-value">$40 </span>
                            <p>per user</p>
                        </div>
                        <ul class="pricing-content">
                        <li><h4><strong>1 Month</strong></h4></li>

                            <li>Get free trial for <strong>15 days.</strong></li>
                            
                        </ul>
                        <button type="submit" class="pricingTable-signup" name="plan_id" value="price_1H8L0WELvDFHHRjVEggH5L37*40">GET</button>

                        <!-- <a href="http://localhost/ciapp/SignUp/" class="pricingTable-signup">GET</a> -->
                    </div>
                </div>

        <div class="col-md-6 col-sm-6">
                    <div class="pricingTable">
                        <span class="icon"><i class="fa fa-diamond"></i></span>
                        <div class="pricingTable-header">
                            <h3 class="title">Premium</h3>
                            <span class="price-value">$450</span>
                            <p>per user</p>
                        </div>
                        <ul class="pricing-content">

                        <li><h4><strong>12 Months</strong></h4></li>

                            <li>Get free trial for <strong>15 days.</strong></li>
                            
                        </ul>
                        <!-- <button type="submit" name="plan_id" value="p2"></button>   -->
                        <button type="submit" class="pricingTable-signup" name="plan_id" value="price_1H8L0WELvDFHHRjVYOxy42ug*450">GET</button>

                        <!-- <a href="http://localhost/ciapp/SignUp/" class="pricingTable-signup">GET</a> -->
                    </div>
                </div>
            </div>
        </div>
    </div>

     </form>

   <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
        <script src='http://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js'></script>
        <script src='js/script.js'></script>

    </body>
</html>
