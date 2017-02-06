jQuery(function ($) {
    $(document).ready(function () { //perform actions when DOM is ready

        // 点击获取验证码
        $("#captcha_img").click(
            function () {
                getCaptcha($("#captcha_img"));
            }
        )

        getCaptcha($("#captcha_img"));


        // 注册验证

        $('#email_address').blur(
            function () {
                var email_address = $(this).val();
                if (email_address == "") {
                    $('#email_address_info').html("<font color='red'>empty not allowed</font>");
                }
                else if (email_address.match(/^(\w)+(\.\w+)*@(\w)+((\.\w+)+)$/) == null) {
                    $('#email_address_info').html("<font color='red'>invaild email</font>");
                }
                else {
                    $(this).load("/register/jquerycheckemail?random=" + Math.random(), {'email_address': email_address},
                        function (responseText, responseState, XMLHttpRequest) {
                            $('#email_address_info').html(responseText);
                        })
                }
            }
        );

        $('#password_first').blur(
            function () {
                var password_first = $(this).val();
                if (password_first == "") {
                    $('#password_first_info').html("<font color='red'>empty not allowed</font>");
                }
                else if (password_first.length < 4) {
                    $('#password_first_info').html("<font color='red'>length < 4</font>");
                }
                else if (password_first.search(/[a-zA-Z]/) == -1) {
                    $('#password_first_info').html("<font color='red'>must contain letter</font>");
                }
                else if (password_first.search(/[0-9]/) == -1) {
                    $('#password_first_info').html("<font color='red'>must contain digit</font>");
                }
                else if (password_first.match(/^([0-9a-zA-Z])+$/) == null) {
                    $('#password_first_info').html("<font color='red'>special code not allowed</font>");
                }
                else {
                    $('#password_first_info').html("<font color='green'>acceptable</font>");
                }
            }
        );

        $('#password_second').blur(
            function () {
                var password_first = $("#password_first").val();
                var password_second = $(this).val();
                if (password_second == '') {
                    $('#password_second_info').html("<font color='red'>empty not allowed</font>");
                }
                else if (password_first !== password_second) {
                    $('#password_second_info').html("<font color='red'>password different</font>");
                }

                else {
                    $('#password_second_info').html("<font color='green'>acceptable</font>");
                }
            }
        );

        $('#first_name').blur(
            function () {
                var first_name = $("#first_name").val();
                if (!first_name.match(/^([a-zA-Z])+$/)) {
                    $('#first_name_info').html("<font color='red'>invalid first name</font>");
                }

                else {
                    $('#first_name_info').html("<font color='green'>acceptable</font>");
                }
            }
        );

        $('#last_name').blur(
            function () {
                var last_name = $("#last_name").val();
                if (!last_name.match(/^([a-zA-Z])+$/)) {
                    $('#last_name_info').html("<font color='red'>invalid last name</font>");
                }

                else {
                    $('#last_name_info').html("<font color='green'>acceptable</font>");
                }
            }
        );

        $('#captcha_code').blur(
            function () {
                var captcha_code = $(this).val();
                $('#captcha_code_info').load(
                    "/captcha/jquerycheckcaptcha",
                    {'captcha_code': captcha_code},
                    function (responseText, responseState, XMLHttpRequest) {
                    }
                );
            }
        );

        $("#reset").click(
            function () {
                $('#email_address_info').html("");
                $('#password_first_info').html("");
                $('#password_second_info').html("");
                $('#first_name_info').html("");
                $('#last_name_info').html("");
                $('#captcha_code_info').html("");
            }
        );

        function getCaptcha(element) {
            element.load("/captcha/setcaptcha?random=" + Math.random(), null,
                function (responseText, responseState, XMLHttpRequest) {
                    var jsonObject = eval("(" + responseText + ")");
                    element.attr('src', jsonObject.captcha_url);

                })
        }

        $(".jfilestyle").change(
            function () {
                $("#uploadfile_info").val($(this).val());
            }
        );

        //google map api

        // $("#map").googleMap({
        //      // zoom: 5, // Initial zoom level (optional)
        //         coords: [22.265651, 114.140569], // Map center (optional)
        //                type: "ROADMAP" // Map type (optional)
        // });


        // $("#map").addMarker({
        //     // zoom: 5,
        //     coords: [22.265651, 114.140569], // Map center (optional)
        //     draggable: true,
        //     success: function(e) {
        //         $("#latitude").val(e.lat);
        //         $("#longitude").val(e.lon);
        //         $("#idea_destination").load(
        //             "https://maps.googleapis.com/maps/api/geocode/json?latlng="+$("#latitude").val()+","+$("#longitude").val()+"&key=AIzaSyBAzlvERdn7z0oRAMQIw4ks14KzIok7GRI",
        //             null,
        //             function (responseText,responseState,XMLHttpRequest) {
        //                 var jsonObject = eval("("+responseText+")");
        //                 $("#idea_destination").html("");
        //                 $.each(jsonObject.results,function (key, value) {
        //                     $("#idea_destination").append("<option value='"+value.formatted_address+"'>"+value.formatted_address+"</option>");
        //                 })
        //
        //             }
        //         )
        //
        //     }
        // });

        //Google Maps API







        // $("#map_edit").googleMap({
        //     zoom: 10, // Initial zoom level (optional)
        //     coords: [parseFloat($("#latitude_edit").val()), parseFloat($("#longitude_edit").val())], // Map center (optional)
        //     type: "ROADMAP" // Map type (optional)
        // });
        // $("#map_edit").addMarker({
        //     coords: [parseFloat($("#latitude_edit").val()), parseFloat($("#longitude_edit").val())], // Map center (optional)
        //     draggable: true,
        //     success: function (e) {
        //         $("#latitude_edit").val(e.lat);
        //         $("#longitude_edit").val(e.lon);
        //         $("#idea_destination_edit").load(
        //             "https://maps.googleapis.com/maps/api/geocode/json?latlng=" + $("#latitude_edit").val() + "," + $("#longitude_edit").val() + "&key=AIzaSyBAzlvERdn7z0oRAMQIw4ks14KzIok7GRI",
        //             null,
        //             function (responseText, responseState, XMLHttpRequest) {
        //                 var jsonObject = eval("(" + responseText + ")");
        //                 if ($("#destination_name_edit").val() != "") {
        //                     $("#idea_destination_edit").html("<option value='" + $("#destination_name_edit").val() + "'>" + $("#destination_name_edit").val() + "</option>");
        //                     $("#destination_name_edit").val("");
        //                 }
        //                 else {
        //                     $("#idea_destination_edit").html("");
        //
        //                 }
        //                 $.each(jsonObject.results, function (key, value) {
        //                     $("#idea_destination_edit").append("<option value='" + value.formatted_address + "'>" + value.formatted_address + "</option>");
        //                 })
        //
        //             }
        //         )
        //
        //     }
        // });


        // datepicker
        $(".date").datepicker();
        $(".date").datepicker("option", "dateFormat", "yy-mm-dd");





        }


    );


});

