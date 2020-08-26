    // Add input field for new Invoice 
    var count = 2;
    var limits = 500;
    // function addPurchaseInputField(divName){
    //     //var param = "$(this).attr(name)";
    //      if (count == limits)  {
    //           alert("You have reached the limit of adding " + count + " inputs");
    //      }
    //      else {
    //           var newdiv = document.createElement('tr');
    //           var tabin="product_name_"+count;
    //           newdiv.innerHTML ="<td><select name='product_id[]' onkeypress='purchase_productList(" + count + ");' required class='form-control product_id_" + count + "' placeholder='Type product name' id='product_name_" + count + "' ></select></td><td><input type='text' id='' class='form-control text-right stock_ctn_" + count + "' placeholder='Stock' readonly/></td><td class='text-right'><input type='text' name='cartoon[]' onkeyup='quantity_calculate(" + count + ");' onchange='quantity_calculate(" + count + ");' required  id='qty_item_" + count + "' class='form-control text-right' placeholder='0.00' value='' min='0'/></td><td class='text-right'><input type='text' name='cartoon_item[]' value='' readonly='readonly' id='ctnqntt_" + count + "' class='form-control ctnqntt" + count + " text-right' placeholder='Item/Cartoon'/></td><td class='text-right'><input type='text' name='product_quantity[]' readonly='readonly' id='total_qntt_" + count + "' class='form-control text-right' placeholder='0.00' /></td><td><input type='text' name='product_rate[]' onkeyup='quantity_calculate(" + count + ");' onchange='quantity_calculate(" + count + ");' id='price_item_" + count + "' class='form-control price_item" + count + " text-right' placeholder='0.00' value='' min='0'/></td><td class='text-right'><input class='form-control total_price text-right' type='text' name='total_price[]' id='total_price_" + count + "' value='0.00' tabindex='-1' readonly='readonly' /></td><td><button style='text-align: right;' class='btn btn-danger red' type='button' value='Delete' onclick='deleteRow(this)' >Delete</button></td>";
    //           document.getElementById(divName).appendChild(newdiv);
    //           document.getElementById(tabin).focus();
    //           count++;
    //      }
    // }
     function addPurchaseInputField(e) {
        var t = $("tbody#addPurchaseItem tr:first-child").html();
        count == limits ? alert("You have reached the limit of adding " + count + " inputs") : $("tbody#addPurchaseItem").append("<tr>" + t + "</tr>")
    }

    //Calcucate Invoice Add Items
    
    function quantity_calculate(item)
    {
        var qnty =$("#qty_item_"+item).val();
        //stockLimit(item,qnty);
        var cnt =$(".ctnqntt"+item).val();
        var rate =$("#price_item_"+item).val();
        
        var total_qnty  = qnty * cnt;
        $("#total_qntt_"+item).val(total_qnty);
        var total_amnt = total_qnty * rate;
        $("#total_price_"+item).val(total_amnt);
        //alert(qnty);
        calculateSum();
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
       /* var cartoon = $(this).val();
        var item = $(this).parent().next().children().val();

        // set quantity
        $(this).parent().next().next().children().val(cartoon * item);

        var rate = $(this).parent().next().next().next().children().val();
        //set total
        $(this).parent().next().next().next().next().children().val(rate * cartoon * item);
        calculateSum();*/

         var cartoon = $(this).val();
        var item = $(this).parent().next().next().children().val();

        // set quantity
        $(this).parent().next().next().next().children().val(cartoon * item);

        var rate = $(this).parent().next().next().next().next().children().val();
        //set total
        $(this).parent().next().next().next().next().next().children().val(rate * cartoon * item);
        calculateSum();
    });

    function getSupplierNameAddress(vendor_id){
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
            $("#vendor_address").text(vendorData.data.address);
          });
    }

    function getCustomerNameAddress(customer_id){
       var o = $(".baseUrl").val();
        $.ajax({
          method: "POST",
          url: o + "Ccustomer/customer_details_by_id/"+customer_id
        })
          .done(function( result ) {
            var vendorData = JSON.parse(result);
            $("#customer_name").text(vendorData.data.customer_name);
            $("#customer_address").text(vendorData.data.customer_address);
          });
    }