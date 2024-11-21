$(document).ready(function (){
    console.log("jquery running...")

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    //SUBMIT FORM
    $("#submit_btn").on("click", function () {
        let url = $(this).data("create-url");

        const formData = {
            name: $("#productName").val(),
            quantity_in_stock: $("#quantityInStock").val(),
            price_per_item: $("#pricePerItem").val(),
        };

        $.ajax({
            url: url,
            method: "POST",
            dataType: "json",
            data: formData,
            success: function (response) {
                console.log(response);
               
                swal({
                    title: `${response.message}`,
                    icon: "success",
                });
                $('#productForm')[0].reset();

                window.location.reload();
            },
            error: function (xhr, status, error) {
              console.error(xhr.responseJSON.errors);

                if (xhr.responseJSON.errors) {
                    if (xhr.responseJSON.errors.name) {
                        $("#product_name_error").text(
                            xhr.responseJSON.errors.name
                        );
                        clearErrorDisplay("#product_name_error");
                    }

                    if (xhr.responseJSON.errors.quantity_in_stock) {
                        $("#quantity_error").text(
                            xhr.responseJSON.errors.quantity_in_stock
                        );
                        clearErrorDisplay("#quantity_error");
                    }

                    if (xhr.responseJSON.errors.price_per_item) {
                        $("#price_error").text(
                            xhr.responseJSON.errors.price_per_item
                        );
                        clearErrorDisplay("#price_error");
                    }
                }
            },
        });
    });


    //TIMEOUT FUNCTION TO CLEAR ERRORS DISPLAY
    function clearErrorDisplay(param) {
        setTimeout(function () {
            $(`${param}`).text("");
        }, 3000);
    }
})