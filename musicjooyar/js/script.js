jQuery(document).ready(function ($) {

    // Variables

    let is_end_time = false


    // functions 


    function start_time(second, elemet, end = false) {

        if (end) { clearInterval(interval); } else {

            let timer = parseFloat((second % 3600) / 60) * 60;
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

    function check_username() {


        let data = $("#form-edit-profile #username").serializeArray();
        let username = $("#form-edit-profile #username").val().trim();
        let check_field = $(".field-exists-check")
        let check_form_group = $(".field-duplicate-check")
        data.push({ name: "update", value: "true" })
        let btn = $(this).find("button")
        console.log(username);
        $.ajax({
            type: "post",
            url: "../ajax/ajax-check-username.php",
            data: data,
            dataType: "json",

            beforeSend: function () {

                check_field.removeClass("success error")
                check_field.addClass("checking")

            },
            success: function (response) {

                check_field.addClass("success")

                $(".field-free p ").text(response.username_message)

            },
            complete: function () {
                check_field.removeClass("checking")

            },
            error: function (response) {

                check_field.addClass("error")
                $(".field-exists p ").text(response.responseJSON.message)

            }
        });

    }

    // Source - https://stackoverflow.com/q/15900485
    // Posted by l2aelba, modified by community. See post 'Timeline' for change history
    // Retrieved 2026-06-29, License - CC BY-SA 4.0

    function formatSizeUnits(bytes) {
        if (bytes >= 1073741824) { bytes = (bytes / 1073741824).toFixed(2) + " GB"; }
        else if (bytes >= 1048576) { bytes = (bytes / 1048576).toFixed(2) + " MB"; }
        else if (bytes >= 1024) { bytes = (bytes / 1024).toFixed(2) + " KB"; }
        else if (bytes > 1) { bytes = bytes + " bytes"; }
        else if (bytes == 1) { bytes = bytes + " byte"; }
        else { bytes = "0 bytes"; }
        return bytes;
    }


    $('.close-croppie-modal').click(function () {
        $('#cropper-wrapper').removeClass('show');
        croppie.destroy();
    });

    // اینا برای کراپ عکس و ارسالش با AJAX
    var croppie;

    $("#avatar").change(function (e) {
        e.preventDefault()
        let file = e.target.files[0]
        $("#cropper-wrapper").addClass("show")

        // $(".croppie").croppie({
        //     url: URL.createObjectURL(file)
        // })

        let croppie_el = document.querySelector(".croppie");
        console.log(croppie_el)
        croppie = new Croppie(croppie_el, {
            viewport: { width: 200, height: 200, type: "circle" },
            url: URL.createObjectURL(file)
        })

    })
    // این برای  ارسال عکس کراپ شده اس  آپلود ام اینجاس 
    $(".crop-croppie").click(function (e) {
        e.preventDefault();

        croppie.result('blob').then(function (crop_image) {

            let form_data = new FormData;
            form_data.append("user_avatar", crop_image, "avatar.png")

            $.ajax({
                type: "POST",
                url: "../ajax/ajax-upload-avatar.php ",
                data: form_data,
                cache: false,
                contentType: false,
                processData: false,
                xhr: function () {
                    var xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener('progress', function (e) {
                        if (e.lengthComputable) {
                            let total = e.total;
                            let uploaded = e.loaded;
                            let percent = uploaded / total * 100;


                            $(".profile-upload-progress").css('height', `${Math.round(percent)}%`)
                        }

                    })
                    return xhr
                },
                beforeSend: function () {
                    $(".profile-image-actions").removeClass("no-avatar")
                },
                success: function (response) {
                    console.log(response.avatar);
                    Swal.fire({
                        title: "TICKED",
                        text: "عجیبه ولی رواله ! ",
                        icon: "success"
                    });
                    $(".sidebar-avatar").attr('src', response.avatar)

                    $('#cropper-wrapper').removeClass('show');
                    croppie.destroy();


                },
                error: function (response) {

                    Swal.fire({
                        title: "ERROR",
                        text: response.responseJSON.message,
                        icon: "error"
                    });


                },
                complete: function () {
                    $(".profile-upload-progress").css('height', `0%`)
                }

            });

        });
    })


    // برای حذف پروفایله

    $(".delete-profile").click(function (e) {

        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: "btn btn-success",
                cancelButton: "btn btn-danger"
            },
            buttonsStyling: false
        });
        swalWithBootstrapButtons.fire({
            title: "برا حذف تصویرت پروفت مطی  ؟",
            text: "",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "آره داداش حله ",
            cancelButtonText: "نه بیخیال",
            reverseButtons: true
        }).then((result) => {

            if (result.isConfirmed) {

                $.ajax({
                    type: "DELETE",
                    url: "../ajax/ajax-delete-avatar.php",
                    data: {
                        "deleted": true
                    },
                    success: function (response) {

                        $(".sidebar-avatar").attr('src', response.avatar)
                        $(".profile-image-actions").addClass("no-avatar")
                        Swal.fire({
                            title: "TICKED",
                            text: response.message,
                            icon: "success"
                        });




                    },
                    error: function (jqXHR) {
                        Swal.fire({
                            title: "NOT TICKED",
                            text: jqXHR.responseJSON.message,
                            icon: "error"
                        });

                    }
                });

            }
        });
    })

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
                url: "../ajax/ajax-login.php",
                data: data,
                dataType: "json",

                beforeSend: function () {
                    $("#verify-form").addClass("otp-sending")


                },
                success: function (response) {

                    console.log(response)

                    if (response.message == "NEXT") {

                        start_time(response.expire, 'timer');

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


                        $(".token-verify").val(response.token)

                    }

                },
                complete: function () {
                    $("#verify-form").removeClass("otp-sending otp-expired")
                }
            });
            console.log(check_mobile($("#phone").val(), "error_msg", "welcome", "کد اشتباه است"))


        } else {
            Swal.fire({
                title: "ERROR",
                text: "شماره تلفنت درست نییییییییییییییی درستتتشششش کن دیگهههههههههههههههههههه ",
                icon: "error"
            });
            $(".form-group").addClass("error");
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
            url: "../ajax/ajax-verify-login.php",
            data: data,
            dataType: "json",

            beforeSend: function () {
                $("#verify-form").addClass("otp-sending")


            },
            success: function (response) {

                if (response.message == "ENTER") {


                    $("#btn").text("در حال ورود")

                    Swal.fire({
                        title: "WELCOME",
                        text: "خوش اومدی !!!",
                        icon: "success"
                    });

                    window.location = response.redirect_path

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

    $(".menu-logout").click(function (e) {
        e.preventDefault();

        let href = $(this).attr("href");


        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: "btn btn-success",
                cancelButton: "btn btn-danger"
            },
            buttonsStyling: false
        });
        swalWithBootstrapButtons.fire({
            title: "برا خروج از حساب کاربری اصمینان دارید ؟",
            text: "",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "بله",
            cancelButtonText: "خیر",
            reverseButtons: true
        }).then((result) => {

            if (result.isConfirmed) {

                window.location.href = href

            }
        });



    })

    $("#form-edit-profile").submit(function (e) {
        e.preventDefault();
        let data = $(this).serializeArray();
        data.push({ name: "update", value: "true" })
        let btn = $(this).find("button")
        $.ajax({
            type: "post",
            url: "../check.php",
            data: data,
            dataType: "json",

            beforeSend: function () {

                btn.addClass("loading")

            },
            success: function (response) {
                Swal.fire({
                    title: "SUCCESS",
                    text: response.message,
                    icon: "success"
                });


            },
            complete: function () {
                btn.removeClass("loading")

            },
            error: function (response) {
                console.log(response)
                Swal.fire({
                    title: "ERROR",
                    text: response.responseJSON.message,
                    icon: "error"
                });
            }
        });
    })

    var check_username_timer;
    $("#form-edit-profile #username").keyup(function () {
        if (check_username_timer) {
            clearInterval(check_username_timer)
        }
        check_username_timer = setTimeout(check_username, 500);

    });


    $("#category-form").submit(function (e) {
        e.preventDefault();

        let data = $(this).serializeArray();
        data.push({ name: "setcategory", value: "accept" })
        let btn = $(this).find("button")
        $.ajax({
            type: "post",
            url: "../ajax/category/save.php",
            data: data,
            dataType: "json",

            beforeSend: function () {

                btn.addClass("loading")

            },
            success: function (response) {
                Swal.fire({
                    title: "SUCCESS",
                    text: response.message,
                    icon: "success"
                });



                $(response.item).appendTo("#category_parent")

            },
            complete: function () {
                btn.removeClass("loading")

            },
            error: function (response) {
                console.log(response)
                Swal.fire({
                    title: "ERROR",
                    text: response.responseJSON.message,
                    icon: "error"
                });
            }
        });


    })

    $("#artist-form").submit(function (e) {
        e.preventDefault();

        let data = $(this).serializeArray();
        data.push({ name: "add_artisit", value: "ticked" })

        let btn = $(this).find("button")
        $.ajax({
            type: "post",
            url: "../ajax/artist/save.php",
            data: data,
            dataType: "json",



            beforeSend: function () {

                btn.addClass("loading")

            },
            success: function (response) {
                Swal.fire({
                    title: "SUCCESS",
                    text: response.message,
                    icon: "success",
                    timer: 2500

                });

                if (response.redirect_path) {
                    setTimeout(function () { window.location.href = response.redirect_path }, 2500)
                }



                $(response.item).appendTo("#category_parent")

            },
            complete: function () {
                btn.removeClass("loading")

            },
            error: function (response) {
                console.log(response)
                Swal.fire({
                    title: "ERROR",
                    text: response.responseJSON.message,
                    icon: "error"
                });
            }
        });



    })

    $("#birthdate").pDatepicker({
        format: 'YYYY/MM/DD',
        viewMode: 'year',
        autoClose: true,
        altField: '#birthdate_real',
        altFieldFormatter: function (timestamp) {
            let date = new Date(timestamp);
            let year = date.getFullYear();
            let month = date.getMonth();
            let day = date.getDate();

            if (month < 10) {

                month = '0' + month

            }
            if (day < 10) {

                day = '0' + day

            }


            return `${year}-${month}-${day}`
        }
    });


    // اینا برای کراپ عکس و ارسالش با AJAX
    var croppie;

    $("#artist_avatar").change(function (e) {
        e.preventDefault()
        let file = e.target.files[0]
        $("#cropper-wrapper").addClass("show")


        // $(".croppie").croppie({
        //     url: URL.createObjectURL(file)
        // })

        let croppie_el = document.querySelector(".croppie");
        console.log(croppie_el)
        croppie = new Croppie(croppie_el, {
            viewport: { width: 200, height: 200 },
            url: URL.createObjectURL(file)
        })

    })
    // این برای  ارسال عکس کراپ شده اس  آپلود ام اینجاس 
    $(".crop-croppie-artist").click(function (e) {
        e.preventDefault();


        croppie.result('blob').then(function (crop_image) {

            let form_data = new FormData;
            form_data.append("artist_avatar", crop_image, "artist_avatar.png")

            $.ajax({
                type: "POST",
                url: "../ajax/artist/ajax-upload-avatar-artist.php",
                data: form_data,
                cache: false,
                contentType: false,
                processData: false,
                xhr: function () {
                    var xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener('progress', function (e) {
                        if (e.lengthComputable) {
                            let total = e.total;
                            let uploaded = e.loaded;
                            let percent = uploaded / total * 100;


                            $(".uploading-percent").text(`${Math.round(percent)}%`)
                        }

                    })
                    return xhr
                },
                beforeSend: function () {

                    $(".artist-col-avatar").removeClass("uploaded")
                    $(".artist-col-avatar").removeClass("error")
                    $(".artist-col-avatar").addClass("uploading")


                },
                success: function (response) {



                    $("#artist-avatar-url").val(response.avatar)

                    $("#avatar-artist").attr('src', response.avatar)


                    $(".artist-col-avatar").addClass("uploaded")
                    $('#cropper-wrapper').removeClass('show');

                    croppie.destroy();


                },
                error: function (response) {

                    Swal.fire({
                        title: "ERROR",
                        text: response.responseJSON.message,
                        icon: "error"
                    });


                },
                complete: function () {
                    $(".artist-col-avatar").addClass("uploaded")
                    $(".artist-col-avatar").removeClass("error")
                    $(".artist-col-avatar").removeClass("uploading")
                    $(".uploading-percent").text(`0%`)
                }

            });

        });
    })

    $(".remove-artist-avatar").click(function (e) {
        e.preventDefault();

        $(".artist-col-avatar").removeClass("uploaded")


    })

    $("#form-save-music").submit(function (e) {
        e.preventDefault();

        let data = $(this).serializeArray();
        data.push({ name: "save_music", value: "reved" })

        let btn = $(this).find("button")
        $.ajax({
            type: "post",
            url: "../ajax/music/save.php",
            data: data,
            dataType: "json",



            beforeSend: function () {

                btn.addClass("loading")

            },
            success: function (response) {
                console.log(response);

                Swal.fire({
                    title: "SUCCESS",
                    text: response.message,
                    icon: "success",
                    timer: 2500

                });



                if (response.redirect_path) {
                    setTimeout(function () { window.location.href = response.redirect_path }, 2500)
                }


            },
            complete: function () {
                btn.removeClass("loading")

            },
            error: function (response) {
                console.log(response)
                // Swal.fire({
                //     title: "ERROR",
                //     text: response.responseJSON.message,
                //     icon: "error"
                // });
            }
        });



    })

    $("#artist_avatar").change(function (e) {
        e.preventDefault()
        let file = e.target.files[0]
        $("#cropper-wrapper").addClass("show")


        // $(".croppie").croppie({
        //     url: URL.createObjectURL(file)
        // })

        let croppie_el = document.querySelector(".croppie");
        console.log(croppie_el)
        croppie = new Croppie(croppie_el, {
            viewport: { width: 200, height: 200 },
            url: URL.createObjectURL(file)
        })

    })

    $("#cover").change(function (e) {
        e.preventDefault();


        let file = e.target.files[0]

        let form_data = new FormData;
        form_data.append("music_cover", file)

        $.ajax({
            type: "POST",
            url: "../ajax/music/ajax-upload-cover.php",
            data: form_data,
            cache: false,
            contentType: false,
            processData: false,
            xhr: function () {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener('progress', function (e) {
                    if (e.lengthComputable) {
                        let total = e.total;
                        let uploaded = e.loaded;
                        let percent = uploaded / total * 100;


                        $(".uploading-percent").text(`${Math.round(percent)}%`)
                    }

                })
                return xhr
            },
            beforeSend: function () {

                let preview_url = URL.createObjectURL(file);
                $(".uploading-status").css("background-image", `url('${preview_url}')`);

                $(".cover-container").removeClass("uploaded")
                $(".cover-container").addClass("uploading")
                $(".cover-container").removeClass("error")


            },
            success: function (response) {



                $(".music_cover_url").val(response.cover)

                $(".cover-container").addClass("uploaded")

                $(".uploaded-image").css("background-image", `url('${response.cover}')`);

            },
            error: function (response) {

                Swal.fire({
                    title: "ERROR",
                    text: response.responseJSON.message,
                    icon: "error"
                });


            },
            complete: function () {
                $(".cover-container").addClass("uploaded")
                $(".cover-container").removeClass("error")
                $(".cover-container").removeClass("uploading")
                $(".cover-upload .uploading-percent").text(`0%`)
            }

        });

    });

    $(".delete-cover").click(function (e) {
        e.preventDefault();

        $(".cover-container").removeClass("uploaded");

        $(".music_cover_url").val("");


    })


    $(".music-uploader input[type='file']").change(function (e) {

        e.preventDefault();

        let uploader_box = $(this).closest(".music-uploader")

        let files = e.target.files;

        if (!files.length) {
            return;
        }

        let quality = e.target.id

        let file = files[0];


        let form_data = new FormData;
        form_data.append("music_audio", file)
        form_data.append("music_quality", quality)

        $.ajax({
            type: "POST",
            url: "../ajax/music/ajax-upload-music.php",
            data: form_data,
            cache: false,
            contentType: false,
            processData: false,
            xhr: function () {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener('progress', function (e) {
                    if (e.lengthComputable) {
                        let total = e.total;
                        let uploaded = e.loaded;
                        let percent = uploaded / total * 100;

                        $(uploader_box).find(".upload-progress span").text(`${Math.round(percent)}%`)
                        $(uploader_box).find(".upload-progress ").css("width", `0%`)

                        $(uploader_box).find(".upload-progress ").css("width", `${Math.round(percent)}%`)

                    }

                })
                return xhr
            },
            beforeSend: function () {

                let preview_url = URL.createObjectURL(file);
                $(uploader_box).addClass("selected uploading");
                $(uploader_box).find(".uploader-music-title").text(file.name)
                $(uploader_box).find(".music-size").text(formatSizeUnits(file.size))
                $(uploader_box).find("audio").attr("src", preview_url)


                // let preview_url = URL.createObjectURL(file);
                // $(".uploading-status").css("background-image", `url('${preview_url}')`);

                // $(".cover-container").removeClass("uploaded")
                // $(".cover-container").addClass("uploading")
                // $(".cover-container").removeClass("error")


            },
            success: function (response) {

                $(uploader_box).addClass("uploaded");

                $(uploader_box).find("input[type='hidden']").val(response.music);

            },
            error: function (response) {

                Swal.fire({
                    title: "ERROR",
                    text: response.responseJSON.message,
                    icon: "error"
                });


            },
            complete: function () {
                $(uploader_box).removeClass("uploading");

            }

        });





    })
})


jQuery('.select2').select2();