var order_type = "purchase";
	var inner_cart_quantity = "0";
	var cartoon_quantity = "0";
	var pallet_quantity = "0";
	var flagICEA = 0;
	var flagCREA = 0;
	var flagCRIC = 0;
	var flagPLCR = 0;
	var arrayUnits = [];
	var stringSerialNumber = "";
	var countqty = 0;
	var serialDiv = 0;
	var totalQuantityInEach = 0;
	var lot_flag = 0;
	var expiry_flag = 0;
	var purchase_detail_id = 0;
	var productNumber = 0;
//first tab click here

$("#sub").click(function () {


        $('#resMsg').html('');
        

        if ($('#numb').val() == '') {
            $("#numb").focus();
            $("#numb").css("border-color", "#f16d6d");
            return false;
        }
     

        var formData = {
            apikey: "KhOSpc4cf67AkbRpq1hkq5O3LPlwU9IAtILaL27EPMlYr27zipbNCsQaeXkSeK3R",
            data: {
                po: $('#numb').val()
            }
        }

        $('#ponumber').html($('#numb').val());
        $('#headerReceiving').html($('#numb').val());
		
        $("#sub").prop('disabled', true);
        $('#sub').html('Wait...');

        $.ajax({
            type: 'POST',
            data: JSON.stringify(formData),
            url: serverUrl+'getItemByPoRoId',
            success: function (data) {
            	console.log(data);
				return false;
                var result = JSON.parse(data);
                if (result.data.status == "false") {
                    $("#numb").css("border-color", "#f16d6d");
                    

					swal("", result.data.message, "warning");
					$("#sub").prop('disabled', false);
                    $('#sub').html('Search');
					
                }
                else {
                    //$('#resMsg').html(result.data.message);

                    $("#sub").prop('disabled', false);
                    $('#sub').html('Search');

                    $("#receiving1").css("display", "none");
                    $("#receiving2").css("display", "block");
                    var selectData = result.data.data;
                    order_type = result.data.order_type;
      
                    console.log(selectData);

                    var optionString = '';
                    if (selectData.length > 0) {

                        console.log(selectData);
                        for (var i = 0; i < selectData.length; i++){
                      
                            //alert(selectData[i].product_id);
                            optionString = optionString + '<option value="' + selectData[i].product_id +'#' + selectData[i].purchase_detail_id +'">'+selectData[i].product_name+'</option>';
                        }

                        $('#itemList').html(optionString);
                    }
                    
                    $("#numb").css("border-color", "#ccc");
                  

                }

                $("#sub").prop('disabled', false);
                $('#sub').html('Search');
            },
            error: function (xhr) {
                console.log(xhr);
            }
        });
    });
//first tab click end here	