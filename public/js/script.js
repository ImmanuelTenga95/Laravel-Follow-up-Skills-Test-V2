$(document).ready(function () {
    console.log("jquery running...");

    $("#productForm")[0].reset();

  
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
                    $("#productForm")[0].reset();

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

    //EDIT

    $(".edit_btn").on("click", function () {

        $("#submit_btn").addClass('d-none')
        $("#editBtn").removeClass('d-none')

        let url = $(this).data("edit-url");
        //console.log(url)
        let update_url = $(this).data("update-url");

        $.ajax({
            url: url,
            method: "GET",
            dataType: "json",
            success: function (response) {
                $("#productName").val(response.name);
                $("#quantityInStock").val(response.quantity_in_stock);
                $("#pricePerItem").val(response.price_per_item);
            },
            error: function (xhr, status, error) {
                console.error(error);
                alert("Failed to retrieve project information");
            },
        });
        
            $("#editBtn").on("click", function () {
                const formData = {
                    name: $("#productName").val(),
                    quantity_in_stock: $("#quantityInStock").val(),
                    price_per_item: $("#pricePerItem").val(),
                };

                $.ajax({
                    url: update_url,
                    method: "PUT",
                    dataType: "json",
                    data: formData,
                    success: function (response) {
                        //console.log(response);
                        swal({
                            title: `${response.message}`,
                            icon: "success",
                        });
                       
                        $("#productForm")[0].reset();
                        window.location.reload();
                    },
                    error: function (xhr, status, error) {
                        //console.error(xhr.responseJSON.errors);

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
    });

    //TIMEOUT FUNCTION TO CLEAR ERRORS DISPLAY
    function clearErrorDisplay(param) {
        setTimeout(function () {
            $(`${param}`).text("");
        }, 3000);
    }
});
