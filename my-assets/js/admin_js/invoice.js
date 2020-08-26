function addInputField(t) {
    if (count == limits) alert("You have reached the limit of adding " + count + " inputs");
    else {
          var a = "product_name" + count,
            tabindex = count * 5 ,
            e = document.createElement("tr");
            tab1 = tabindex + 1;
            tab2 = tabindex + 2;
            tab3 = tabindex + 3;
            tab4 = tabindex + 4;
            tab5 = tabindex + 5;
            tab6 = tabindex + 6;
            tab7 = tabindex + 7;
            tab8 = tabindex + 8;
            tab9 = tabindex + 9;

        e.innerHTML = "<td><input type='text' name='product_name' onkeypress='invoice_productList(" + count + ");' class='form-control productSelection' placeholder='Product Name' id='" + a + "' required tabindex='"+tab1+"'><input type='hidden' class='autocomplete_hidden_value product_id_" + count + "' name='product_id[]' id='SchoolHiddenId'/></td> <td><input type='text' name='available_quantity[]' id='' class='form-control text-right available_quantity_" + count + "' value='' readonly='readonly' /></td><td><input type='text'  placeholder='0.00' name='cartoon[]' onkeyup='quantity_calculate(" + count + ");' onchange='quantity_calculate(" + count + ");' class='quantity_" + count + " form-control text-right' value='' min='1' tabindex='"+tab2+"'/></td><td><input type='text' class='ctnqntt_" + count + " form-control text-right' readonly='readonly' /></td><td> <input type='text' placeholder='0.00' name='product_quantity[]' class='total_qntt_" + count + " form-control text-right' readonly='readonly' /></td><td><input type='text' name='product_rate[]' onkeyup='quantity_calculate(" + count + ");' onchange='quantity_calculate(" + count + ");' value='' id='price_item_" + count + "' class='price_item"+count+" form-control text-right' required tabindex='"+tab3+"'/></td><td><input type='text' placeholder='0.00' name='discount[]' onkeyup='quantity_calculate(" + count + ");' onchange='quantity_calculate(" + count + ");' id='discount_" + count + "' class='form-control text-right' placeholder='Discount' value='' min='0' tabindex='"+tab4+"'/></td><td class='text-right'><input class='total_price form-control text-right' type='text' name='total_price[]' id='total_price_" + count + "' value='' readonly='readonly'/></td><td><input type='hidden' id='total_tax_" + count + "' class='total_tax_" + count + "' /><input type='hidden' id='all_tax_" + count + "' class=' total_tax'/><input type='hidden' id='total_discount_" + count + "' class='total_tax_" + count + "' /><input type='hidden' id='all_discount_" + count + "' class='total_discount'/><button style='text-align: right;' class='btn btn-danger' type='button' tabindex='"+tab5+"' value='Delete' onclick='deleteRow(this)'>Delete</button></td>",

        document.getElementById(t).appendChild(e), 
        document.getElementById(a).focus(),
        document.getElementById("add-invoice-item").setAttribute("tabindex", tab6);
        document.getElementById("paidAmount").setAttribute("tabindex", tab7);
        document.getElementById("full_paid_tab").setAttribute("tabindex", tab8);
        document.getElementById("add-invoice").setAttribute("tabindex", tab9);
        count++

    }
}

function quantity_calculate(item) {

    var price_item = $("#price_item_" + item).val();
    var discount = $("#discount_" + item).val();
    var total_tax = $("#total_tax_" + item).val();
    var quantity = $(".quantity_" + item).val();
    var ctnqntt = $(".ctnqntt_" + item).val();
    var available_quantity = $(".available_quantity_" + item).val();
    var total_discount = $("#total_discount" + item).val();

    $(".total_qntt_" + item).val(quantity * ctnqntt);

    if (parseInt(quantity) > parseInt(available_quantity)) {
        var message ="You can purchase maximum "+ available_quantity + " Items";
            alert(message);
    }

    if (quantity > 0) {
        var total_price = (quantity * ctnqntt * price_item);
        $("#total_price_" + item).val(total_price);
        var all_tax = quantity * ctnqntt * total_tax;
        $("#all_tax_" + item).val(all_tax);
    } else {
        var total_price = quantity * ctnqntt * price_item;
        $("#total_price_" + item).val(total_price);
        $("#all_tax_" + item).val(total_tax);
    }

    if (discount > 0) {
        $("#total_tax_" + item).val(total_tax);
        var all_discount = discount * quantity * ctnqntt;
        $("#all_discount_" + item).val(all_discount);

    } else if (0 >= discount) {
        var total_price = quantity * ctnqntt * price_item;
        $("#total_price_" + item).val(total_price);
        $("#total_tax_" + item).val(total_tax);
        var all_discount = discount * quantity * ctnqntt;
        $("#all_discount_" + item).val(all_discount);
    }
    calculateSum();
    invoice_paidamount();
}

function calculateSum() {
    var t = 0,
        a = 0,
        e = 0,
        o = 0;
        p = 0;

    $(".total_tax").each(function() {
        isNaN(this.value) || 0 == this.value.length || (a += parseFloat(this.value))
    }), 

    $("#total_tax_ammount").val(a.toFixed(2)), 

    $(".total_discount").each(function() {
        isNaN(this.value) || 0 == this.value.length || (p += parseFloat(this.value))
    }), 
    
    $("#total_discount_ammount").val(p.toFixed(2)), 

    $(".total_price").each(function() {
        isNaN(this.value) || 0 == this.value.length || (t += parseFloat(this.value))
    }), 
    o = a.toFixed(2), 
    e = t.toFixed(2), 
    f = p.toFixed(2), 

    $("#grandTotal").val(+o + +e-f)
}

function invoice_paidamount() {
    var t = $("#grandTotal").val(),
        a = $("#paidAmount").val(),
        e = t - a;
    $("#dueAmmount").val(e)
}

function stockLimit(t) {
    var a = $("#total_qntt_" + t).val(),
        e = $(".product_id_" + t).val(),
        o = $(".baseUrl").val();
    $.ajax({
        type: "POST",
        url: o + "Cinvoice/product_stock_check",
        data: {
            product_id: e
        },
        cache: !1,
        success: function(e) {
            if (a > Number(e)) {
                var o = "You can purchase maximum " + e + " Items";
                alert(o), $("#qty_item_" + t).val("0"), $("#total_qntt_" + t).val("0"), $("#total_price_" + t).val("0")
            }
        }
    })
}

function stockLimitAjax(t) {
    var a = $("#total_qntt_" + t).val(),
        e = $(".product_id_" + t).val(),
        o = $(".baseUrl").val();
    $.ajax({
        type: "POST",
        url: o + "Cinvoice/product_stock_check",
        data: {
            product_id: e
        },
        cache: !1,
        success: function(e) {
            if (a > Number(e)) {
                var o = "You can purchase maximum " + e + " Items";
                alert(o), $("#qty_item_" + t).val("0"), $("#total_qntt_" + t).val("0"), $("#total_price_" + t).val("0.00"), calculateSum()
            }
        }
    })
}

//Invoice full paid
function full_paid() {
    var grandTotal = $("#grandTotal").val();
    $("#paidAmount").val(grandTotal);
    calculateSum();
    invoice_paidamount();
}

function deleteRow(t) {
    var a = $("#normalinvoice > tbody > tr").length;
    if (1 == a) alert("There only one row you can't delete.");
    else {
        var e = t.parentNode.parentNode;
        e.parentNode.removeChild(e), 
        calculateSum();
        invoice_paidamount();
    }
}
var count = 2,
    limits = 500;