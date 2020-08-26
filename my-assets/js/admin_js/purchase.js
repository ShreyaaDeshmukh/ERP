    // Add input field for new Invoice 
    var count = 2;
    var limits = 500;
    /* function addPurchaseInputField(divName){
        //var param = "$(this).attr(name)";
         if (count == limits)  {
              alert("You have reached the limit of adding " + count + " inputs");
         }
         else {
              var newdiv = document.createElement('tr');
              var tabin="product_name_"+count;
              newdiv.innerHTML ="<td><select name='product_id[]' onkeypress='purchase_productList(" + count + ");' required class='form-control product_id_" + count + "' placeholder='Type product name' id='product_name_" + count + "' ></select></td><td><textarea id='description_" + count + "' class='form-control text-right description" + count + "' placeholder='Derscription' value='' readonly/></textarea></td><td class='text-right'><input type='text' name='cartoon[]' onkeyup='quantity_calculate(" + count + ");' onchange='quantity_calculate(" + count + ");' required  id='qty_item_" + count + "' class='form-control text-right' placeholder='0.00' value='' min='0'/></td><td class='text-right'><input type='text' name='cartoon_item[]' value='' readonly='readonly' id='ctnqntt_" + count + "' class='form-control ctnqntt" + count + " text-right' required placeholder='Item/Cartoon'/></td><td class='text-right'><input type='text' name='product_quantity[]' readonly='readonly' id='total_qntt_" + count + "' class='form-control text-right' placeholder='0.00' required /></td><td><input type='text' name='product_rate[]' onkeyup='quantity_calculate(" + count + ");' onchange='quantity_calculate(" + count + ");' id='price_item_" + count + "' class='form-control price_item" + count + " text-right' placeholder='0.00' required value='' min='0'/></td><td class='text-right'><input class='form-control total_price text-right' type='text' name='total_price[]' id='total_price_" + count + "' value='0.00' tabindex='-1' readonly='readonly' /></td><td><button style='text-align: right;' class='btn btn-danger red' type='button' value='Delete' onclick='deleteRow(this)' >Delete</button></td>";
              document.getElementById(divName).appendChild(newdiv);
              document.getElementById(tabin).focus();
              count++;
         }
    } */
	
	var d = 0;
     function addPurchaseInputField(e) {
        var t = $("tbody#addPurchaseItem tr:first-child").html();
		console.log(t);
		console.log("count", count);
		count = $('#addPurchaseItem tr').length;
		console.log("t ko console karaya hai");
        count == limits ? alert("You have reached the limit of adding " + count + " inputs") : $("tbody#addPurchaseItem").append("<tr>" + t + "</tr>");
	
		if(d == 0){
			d = count;
		}else{
			d=d+1;
		}
		/* alert(d); */
		$('.qty_calculator').eq(d).val('');
		$('.productSelection').eq(d).val('');
		$('.description').eq(d).val('');
		$('.price_item1').eq(d).val('');
		$('.unitquantity').eq(d).val('');
		$('.total_price').eq(d).val('');
	}
	
	function addPurchaseInputField_TT(e) {
        var t = $("tbody#addPurchaseItem tr:first-child").html();
        count == limits ? alert("You have reached the limit of adding " + count + " inputs") : $("tbody#addPurchaseItem").html("<tr>" + t + "</tr>");

    }
	
	 function addTicketInputField(e) {
        var t = $("tbody#addPurchaseItem tr:first-child").html();
        count == limits ? alert("You have reached the limit of adding " + count + " inputs") : $("tbody#addPurchaseItem").append("<tr>" + t + "</tr>");
    }


    //Calcucate Invoice Add Items
    
    function quantity_calculate(item)
    {
        /*var qnty =$("#qty_item_"+item).val();
        //stockLimit(item,qnty);
        var cnt =$(".ctnqntt"+item).val();
        var rate =$("#price_item_"+item).val();
        

        var total_qnty  = qnty * cnt;
        
        console.log(qnty);
        console.log(cnt);
        console.log(rate);

        $("#total_qntt_"+item).val(total_qnty);
        var total_amnt = total_qnty * rate;
        $("#total_price_"+item).val(total_amnt);
        //alert(qnty);
        calculateSum();*/
        var cartoon = $(this).val();
        console.log(cartoon);
        var item = $(this).parent().next().children().val();
        console.log(item);
    }


    function calculateSum() {
        var e = 0;
        $(".total_price").each(function() {
            isNaN(this.value) || 0 == this.value.length || (e += parseFloat(this.value))
        }), 
        $("#grandTotal").val(e.toFixed(2))
    }

    function deleteRow(e) {
        var t = $("#purchaseTable > tbody > tr").length;
        if (1 == t) alert("There only one row you can't delete.");
        else {
            var a = e.parentNode.parentNode;
            a.parentNode.removeChild(a)
        }
        calculateSum()
    }
        
    $("body").on("keyup change", ".qty_calculator", function() {
		 console.log($(this).val());
        var quantity = $(this).parent().parent();
        var finalPrice = $(quantity).find('.price_item1').val();
        var finalQuantity = $(this).val();//$(quantity).find('.prdt_prcie').val();

        console.log(finalPrice);
        console.log(finalQuantity);
        if(finalQuantity!='' && finalPrice!='')
        $(quantity).find('.total_price').val((finalPrice * finalQuantity).toFixed(2));
        calculateSum();
		
       /* var cartoon = $(this).val();
        var item = $(this).parent().next().children().val();

        // set quantity
        $(this).parent().next().next().children().val(cartoon * item);

        var rate = $(this).parent().next().next().next().children().val();
        //set total
        $(this).parent().next().next().next().next().children().val(rate * cartoon * item);
        calculateSum();*/

         


         /*var cartoon = $(this).val();
         var item = $(this).parent().next().children().val();

        // set quantity
        $(this).parent().next().next().children().val(cartoon * item);

        var rate = $(this).parent().next().children().val();
        //set total
        
        $(this).parent().next().next().next().next().children().val(rate * cartoon * item);
        calculateSum();*/
    });

    $("body").on("keyup change", ".unitquantity ", function() {
       /* var cartoon = $(this).val();
        var item = $(this).parent().next().children().val();

        // set quantity
        $(this).parent().next().next().children().val(cartoon * item);

        var rate = $(this).parent().next().next().next().children().val();
        //set total
        $(this).parent().next().next().next().next().children().val(rate * cartoon * item);
        calculateSum();*/

        /* var unitquantity = $(this).val();
         console.log($(this).parent().parent().children().html());
         console.log($(this).parent().parent().children().next().next().val());
         var total = $(this).parent().next().next().children().val();
         var rate = $(this).parent().next().children().val();
         var quantity = $(this).parent().children().val();*/
        
    });
  
    $("body").on("keyup change blur", ".price_item1", function(){
        console.log($(this).val());
        var quantity = $(this).parent().parent();
        var finalQuantity = $(quantity).find('.qty_calculator').val();
        var finalPrice = $(this).val();//$(quantity).find('.prdt_prcie').val();

        console.log(finalPrice);
        console.log(finalQuantity);
        if(finalQuantity!='' && finalPrice!='')
        $(quantity).find('.total_price').val((finalPrice * finalQuantity).toFixed(2));
        calculateSum();
    })

    /*$("body").on("keyup change blur", ".qty_calculator", function(){
        console.log("you typ-->"+$(this).val());
        var quantity = $(this).parent().parent().children().next().next().next().next().next().next();
        var quantity1 = $(this).parent().next().next().next();
		console.log(quantity1.html());
		console.log(quantity1.val());
        var finalQuantity = $(quantity).find('.price_item_1').val();
        var finalPrice = $(this).val();//$(quantity).find('.prdt_prcie').val();

        console.log(finalPrice);
        console.log(finalQuantity);
        if(finalQuantity!='' && finalPrice!='')
        $(quantity).find('.total_price').val(finalPrice * finalQuantity);
        calculateSum();
    });*/

    /*$("body").on("keyup change blur", ".unitquantity", function(){
        console.log($(this).val());
        var quantity = $(this).parent().parent();
        var finalQuantity = $(quantity).find('.qty_calculator').val();
        var finalPrice = $(this).val();//$(quantity).find('.prdt_prcie').val();

        console.log(finalPrice);
        console.log(finalQuantity);
        if(finalQuantity!='' && finalPrice!='')
        $(quantity).find('.total_price').val(finalPrice * finalQuantity);
        calculateSum();
    });*/

    function getSupplierNameAddress(vendor_id){
        console.log("tayyab");
        console.log(vendor_id);
        console.log("tayyab");
       var o = $(".baseUrl").val();
        $.ajax({
          method: "POST",
          url: o + "Csupplier/supplier_details_by_id/"+vendor_id
        })
          .done(function( result ) {
            var vendorData = JSON.parse(result);
            console.log(vendorData);
            console.log(vendorData.data);
            console.log(vendorData.data.supplier_name);
            console.log(vendorData.data.address);
            $("#vendor_name").text(vendorData.data.supplier_name);
			addPurchaseInputField_TT('t');
            //$("#vendor_address").text(vendorData.data.address+" "+vendorData.data.zip+" "+vendorData.data.cityname+" "+vendorData.data.statename+" "+vendorData.data.countryname);
            $("#vendor_address").text(vendorData.data.address+", "+ vendorData.data.cityname+", "+vendorData.data.statename+" "+vendorData.data.zip);
          });
    }

    function getCustomerNameAddress(customer_id){
        // alert("rinky");
        // alert(customer_id);
       var o = $(".baseUrl").val();
        $.ajax({
          method: "POST",
          url: o + "Ccustomer/customer_details_by_id/"+customer_id,
        })
          .done(function( result ) {
			
            var vendorData = JSON.parse(result);
            $("#customer_name").text(vendorData.data.customer_name);
            //$("#customer_address").text(vendorData.data.zip+" "+vendorData.data.cityname+" "+vendorData.data.statename+" "+vendorData.data.countryname);
            $("#customer_address").text(vendorData.data.customer_address+", "+ vendorData.data.cityname+", "+vendorData.data.statename+" "+vendorData.data.zip);
			$("#ship_id").html(vendorData.data.customer_address+", "+ vendorData.data.cityname+", "+vendorData.data.statename+" "+vendorData.data.zip);
			
			var addresszero = vendorData.data.customer_address+", "+ vendorData.data.cityname+", "+vendorData.data.statename+" "+vendorData.data.zip;
			multipleAddress(customer_id,addresszero);
          });
    }
	
	
	
	