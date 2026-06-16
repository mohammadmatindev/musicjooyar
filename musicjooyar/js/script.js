jQuery(document).ready(function ($) {

    // Variables

    let is_end_time = false


    // functions 


    function start_time(minutess, elemet, end = false) {

        if (end) { clearInterval(interval); } else {

            let timer = parseInt(minutess) * 60;
            let minutes, seconds;

            interval = setInterval(function () {
                minutes = parseInt(timer / 60, 10);
                seconds = parseInt(timer % 60, 10);

                minutes = minutes < 10 ? "0" + minutes : minutes;
                seconds = seconds < 10 ? "0" + seconds : seconds;


                document.getElementById(elemet).textContent = minutes + ":" + seconds;

                if (--timer < 0) {
                    clearInterval(interval);
                    $("#" + elemet).text("00:00");
                    $("#verify-form").addClass("otp-expired");
                    if ($("#verify-form").hasClass("otp-expired")) {

                        $("#btn").attr("disabled", true)

                    }

                    is_end_time = true

                    if (is_end_time) {
                        $("#resend").click(function (e) {
                            e.preventDefault();

                            $("#login-form").submit();
                            is_end_time = false;



                        })
                    }






                }
                stop();




            }, 1000);
        }
    }

    function check_mobile(number) {
        var regex = new RegExp('(0|98|0098|98)?([ ]|-|[()]){0,2}9[0-9]([ ]|-|[()]){0,2}(?:[0-9]([ ]|-|[()]){0,2}){8}');
        var result = regex.test(number);
        if (result === true) {
            return true
        } else {
            return false
        }
    }




    $('.close-croppie-modal').click(function () {
        $('#cropper-wrapper').removeClass('show');
    });


    // Login and verify for code

    $("#login-form").submit(function (e) {
        e.preventDefault();
        let _btn = $(this).find("button")
        $(".form-group").removeClass("error");
        $(".input-error").text("");
        if (check_mobile($("#phone").val(), "error_msg", "welcome", "کد اشتباه است")) {

            let phone = $("#phone").val()
            let data = $(this).serializeArray()
            data.push({ name: "btn", value: "tick" })
            $.ajax({
                type: "post",
                url: "../check.php",
                data: data,
                dataType: "json",

                beforeSend: function () {
                    $("#verify-form").addClass("otp-sending")


                },
                success: function (response) {

                    console.log(response)

                    if (response.message == "NEXT") {

                        start_time("3", 'timer');

                        $("#error_bax").removeClass("error");


                        $(".login-box").addClass("active-verify-form");
                        if ($(".login-box").hasClass("active-verify-form")) {
                            $("#in_code").focus();
                        }

                        $("#phone_show").text(phone)

                        $("#resend").click(function (e) {
                            e.preventDefault();


                            if ($("#verify-form").hasClass("otp-expired")) {

                                $("#btn").attr("disabled", true)
                                setTimeout(function () { $("#btn").attr("disabled", false) }, 1000)

                            }

                        });




                    }

                },
                complete: function () {
                    $("#verify-form").removeClass("otp-sending otp-expired")
                }
            });
            console.log(check_mobile($("#phone").val(), "error_msg", "welcome", "کد اشتباه است"))


        } else {

            $(".form-group").addClass("error");
            $(".input-error").text("شماره تلفنت درست نییییییییییییییی درستتتشششش کن دیگهههههههههههههههههههه ");
        }


    })



    $("#verify-form").submit(function (e) {
        e.preventDefault();
        let _btn = $(this).find("button")
        let code = $("#in_code").val()
        let data = $(this).serializeArray()
        data.push({ name: "btn", value: "check" })
        data.push({ name: "phone", value: $("#phone").val() })
        console.log(data)
        $.ajax({
            type: "post",
            url: "../check.php",
            data: data,
            dataType: "json",

            beforeSend: function () {
                $("#verify-form").addClass("otp-sending")


            },
            success: function (response) {

                if (response.message == "ENTER") {


                    $("#btn").text("در حال ورود")
                    $("#btn").attr("disabled", true)
                    $("#in_code").attr("disabled", true)




                } else {

                    $("#error_bax").addClass("error");
                    $("#error_msg").text("کد اشتباه است")

                    setTimeout(function () {
                        $("#error_bax").removeClass("error");
                        $("#error_msg").text("")
                    }, 3000)

                }



            },
            complete: function () {
                $("#verify-form").removeClass("otp-sending otp-expired")
            }
        });


    })



});

jQuery('.select2').select2();