<?php

function adminpage_for_scarcitybuilderx()
{
    ?>
    <script src='//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js'></script>
    <script src="<?php echo plugins_url(); ?>/scarcitybuilder/include/jquery.fontselect.js"></script>
    <link rel="stylesheet" href="<?php echo plugins_url(); ?>/scarcitybuilder/include/fontselect.css">
    <script>
        jQuery(document).ready(function ($) {
            $(".tabLink").click(function () {
                tabLink = $(this).attr('tab');
                $('.tab').hide();
                $("." + tabLink).delay(500).show();
                $(".tabLink").removeClass('active');
                $(this).addClass('active');
            });

            $(".second").click(function () {
                tabLink = $(this).attr('tab');
                $('.inner_tab').hide();
                $("." + tabLink).delay(500).show();
                $(".second").removeClass('active');
                $(this).addClass('active');
            });

            $('#message').fadeOut(3000);
            $('input.fonts').fontselect('lookahead: 10').change(function () {
                var font = $(this).val().replace(/\+/g, ' ');
                font = font.split(':');
                $('.font').val(font[0]);
            });
            <?php if($_GET['edit'] != '') { ?>

            $('#newEdit').html('<img src="https://cdn0.iconfinder.com/data/icons/30_Free_Black_ToolBar_Icons/40/Black_Calendar.png" style="margin-bottom: -6px; width: 24px; opacity: .8;margin-right: 8px">Currently Editing Countdown');


            <?php } ?>


            $("#expiryaction_edit").change(function () {
                if ($(this).val() == '2') {
                    $('.contentExpired').hide();
                    $('.redirectExpired').show();
                }
                if ($(this).val() == '3') {
                    $('.redirectExpired').hide();
                    $('.contentExpired').show();
                }
                if ($(this).val() == '1' || $(this).val() == '4') {
                    $('.redirectExpired').hide();
                    $('.contentExpired').hide();
                }
            });

            $("#type").change(function () {
                if ($(this).val() == '1') {
                    $('.dateTime').hide();
                    $('.cookies').hide();
                    $('.linkEverGreen').show();
                }
                if ($(this).val() == '2') {
                    $('.linkEverGreen').hide();
                    $('.cookies').hide();
                    $('.dateTime').show();
                }
                if ($(this).val() == '3') {
                    $('.linkEverGreen').hide();
                    $('.dateTime').hide();
                    $('.cookies').show();
                }
            });

            if ($("#type").val() == '1') {
                $('.dateTime').hide();
                $('.cookies').hide();
                $('.linkEverGreen').show();
            }
            if ($("#type").val() == '2') {
                $('.linkEverGreen').hide();
                $('.cookies').hide();
                $('.dateTime').show();
            }
            if ($("#type").val() == '3') {
                $('.linkEverGreen').hide();
                $('.dateTime').hide();
                $('.cookies').show();
            }


        });
    </script>
    <link href='//fonts.googleapis.com/css?family=Average+Sans' rel='stylesheet' type='text/css'>
    <link href='//fonts.googleapis.com/css?family=Patrick+Hand' rel='stylesheet' type='text/css'>
    <style>
    #options_panel {
        width: 700px;
        border-radius: 5px;
        border: 1px solid #ccc;
        background: #F7F8FA;
        box-shadow: 0 0 4px #ddd;
        font-size: 15px;
        margin-top: 20px;
        line-height: 21px;
        color: #333;
        font-family: 'Helvetica Neue', Arial, sans-serif;
    }

    #options_panel input[type=text], #options_panel input[type=number], #options_panel textarea, #options_panel select {
        width: 100%;
        display: block;
        margin: 8px 0;
        padding: 10px;
        font-size: 15px;
    }

    #options_panel select {
        height: 45px;
        width: 100%;
    }

    #options_panel h1 {
        font-family: 'Patrick Hand', cursive;
    }

    #options_panel select {
        width: 100%;
        display: block;
        margin: 8px 0;
    }

    #options_panel h1, #options_panel h2, #options_panel h3, #options_panel h4, #options_panel h5 {
        color: #37505C;
    }

    .tabLink {
        float: left;
        position: relative;
        padding: 17px 13px;
        text-decoration: none;
        color: #37505C;
        font-weight: bold;

    }

    .tabLink2 {
        float: left;
        position: relative;
        padding: 17px 13px;
        text-decoration: none;
        color: #37505C;
        font-weight: bold;

    }

    .tabLink:first-child {
    }

    #topnewbie {
        width: 680px;
        display: block;
        padding: 10px 10px;

        padding-bottom: 2px;
        border-bottom: 5px solid #F4F4F6;
        background-image: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSIgdmlld0JveD0iMCAwIDEwMCAxMDAiIHByZXNlcnZlQXNwZWN0UmF0aW89Im5vbmUiPjxsaW5lYXJHcmFkaWVudCBpZD0iaGF0MCIgZ3JhZGllbnRVbml0cz0ib2JqZWN0Qm91bmRpbmdCb3giIHgxPSI1MCUiIHkxPSIxMDAlIiB4Mj0iNTAlIiB5Mj0iLTEuNDIxMDg1NDcxNTIwMmUtMTQlIj4KPHN0b3Agb2Zmc2V0PSIwJSIgc3RvcC1jb2xvcj0iI2Y3ZjlmYiIgc3RvcC1vcGFjaXR5PSIxIi8+CjxzdG9wIG9mZnNldD0iNCUiIHN0b3AtY29sb3I9IiNmN2Y3ZjkiIHN0b3Atb3BhY2l0eT0iMSIvPgo8c3RvcCBvZmZzZXQ9IjEwMCUiIHN0b3AtY29sb3I9IiNmZmYiIHN0b3Atb3BhY2l0eT0iMSIvPgogICA8L2xpbmVhckdyYWRpZW50PgoKPHJlY3QgeD0iMCIgeT0iMCIgd2lkdGg9IjEwMCIgaGVpZ2h0PSIxMDAiIGZpbGw9InVybCgjaGF0MCkiIC8+Cjwvc3ZnPg==);
        background-image: -moz-linear-gradient(bottom, #f7f9fb 0%, #f7f7f9 3.76%, #fff 100%);
        background-image: -o-linear-gradient(bottom, #f7f9fb 0%, #f7f7f9 3.76%, #fff 100%);
        background-image: -webkit-linear-gradient(bottom, #f7f9fb 0%, #f7f7f9 3.76%, #fff 100%);
        background-image: linear-gradient(bottom, #f7f9fb 0%, #f7f7f9 3.76%, #fff 100%);

        border-top-left-radius: 5px;
        border-top-right-radius: 5px;

    }

    #options_panel a:hover {
        color: #446EA9;
    }

    a:focus {
        outline: none;
    }

    .active, .tabLink:hover, .tabLink2:hover {
        color: #446EA9 !important;
        background-image: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSIgdmlld0JveD0iMCAwIDEwMCAxMDAiIHByZXNlcnZlQXNwZWN0UmF0aW89Im5vbmUiPjxsaW5lYXJHcmFkaWVudCBpZD0iaGF0MCIgZ3JhZGllbnRVbml0cz0ib2JqZWN0Qm91bmRpbmdCb3giIHgxPSI1MCUiIHkxPSIxMDAlIiB4Mj0iNTAlIiB5Mj0iLTEuNDIxMDg1NDcxNTIwMmUtMTQlIj4KPHN0b3Agb2Zmc2V0PSIwJSIgc3RvcC1jb2xvcj0iI2Q2ZGNlOCIgc3RvcC1vcGFjaXR5PSIxIi8+CjxzdG9wIG9mZnNldD0iMyUiIHN0b3AtY29sb3I9IiNlZmYxZjMiIHN0b3Atb3BhY2l0eT0iMSIvPgo8c3RvcCBvZmZzZXQ9Ijg2JSIgc3RvcC1jb2xvcj0iI2Y1ZjhmYSIgc3RvcC1vcGFjaXR5PSIxIi8+CjxzdG9wIG9mZnNldD0iOTclIiBzdG9wLWNvbG9yPSIjZWZmMWYzIiBzdG9wLW9wYWNpdHk9IjEiLz4KPHN0b3Agb2Zmc2V0PSIxMDAlIiBzdG9wLWNvbG9yPSIjZGFlMGU2IiBzdG9wLW9wYWNpdHk9IjEiLz4KICAgPC9saW5lYXJHcmFkaWVudD4KCjxyZWN0IHg9IjAiIHk9IjAiIHdpZHRoPSIxMDAiIGhlaWdodD0iMTAwIiBmaWxsPSJ1cmwoI2hhdDApIiAvPgo8L3N2Zz4=);
        background-image: -moz-linear-gradient(bottom, #d6dce8 0%, #eff1f3 3%, #f5f8fa 86.21%, #eff1f3 97%, #dae0e6 100%);
        background-image: -o-linear-gradient(bottom, #d6dce8 0%, #eff1f3 3%, #f5f8fa 86.21%, #eff1f3 97%, #dae0e6 100%);
        background-image: -webkit-linear-gradient(bottom, #d6dce8 0%, #eff1f3 3%, #f5f8fa 86.21%, #eff1f3 97%, #dae0e6 100%);
        background-image: linear-gradient(bottom, #d6dce8 0%, #eff1f3 3%, #f5f8fa 86.21%, #eff1f3 97%, #dae0e6 100%);
        box-shadow: 0 0 3px #d6dce8 inset;

    }

    .second {
        border-bottom: none;
        float: left;
        margin-right: 4px;
        padding: 8px;
        text-decoration: none;
        color: #333;

    }

    .tab {
        clear: both;
    }

    hr {
        border: none;
        border-radius: 4px;
        border-top: 1px solid #eee;
    }

    .save {

        font-size: 17px;
        color: #333;
        padding: 20px;
        width: 95%;
        border: 1px solid #a97612;
        font-weight: bold;
        cursor: pointer;
    }

    .nav {
        background-image: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSIgdmlld0JveD0iMCAwIDEwMCAxMDAiIHByZXNlcnZlQXNwZWN0UmF0aW89Im5vbmUiPjxsaW5lYXJHcmFkaWVudCBpZD0iaGF0MCIgZ3JhZGllbnRVbml0cz0ib2JqZWN0Qm91bmRpbmdCb3giIHgxPSI1MCUiIHkxPSIxMDAlIiB4Mj0iNTAlIiB5Mj0iLTEuNDIxMDg1NDcxNTIwMmUtMTQlIj4KPHN0b3Agb2Zmc2V0PSIwJSIgc3RvcC1jb2xvcj0iI2Q4ZGZlZSIgc3RvcC1vcGFjaXR5PSIxIi8+CjxzdG9wIG9mZnNldD0iMSUiIHN0b3AtY29sb3I9IiNkOGRmZWUiIHN0b3Atb3BhY2l0eT0iMSIvPgo8c3RvcCBvZmZzZXQ9IjMlIiBzdG9wLWNvbG9yPSIjZWZmMWY0IiBzdG9wLW9wYWNpdHk9IjEiLz4KPHN0b3Agb2Zmc2V0PSI4NSUiIHN0b3AtY29sb3I9IiNmZmYiIHN0b3Atb3BhY2l0eT0iMSIvPgo8c3RvcCBvZmZzZXQ9Ijk3JSIgc3RvcC1jb2xvcj0iI2YxZjNmNSIgc3RvcC1vcGFjaXR5PSIxIi8+CjxzdG9wIG9mZnNldD0iMTAwJSIgc3RvcC1jb2xvcj0iI2Q5ZTNlZCIgc3RvcC1vcGFjaXR5PSIxIi8+CiAgIDwvbGluZWFyR3JhZGllbnQ+Cgo8cmVjdCB4PSIwIiB5PSIwIiB3aWR0aD0iMTAwIiBoZWlnaHQ9IjEwMCIgZmlsbD0idXJsKCNoYXQwKSIgLz4KPC9zdmc+);
        background-image: -moz-linear-gradient(bottom, #d8dfee 0%, #d8dfee 0.76%, #eff1f4 3%, #fff 85.47%, #f1f3f5 97.49%, #d9e3ed 100%);
        background-image: -o-linear-gradient(bottom, #d8dfee 0%, #d8dfee 0.76%, #eff1f4 3%, #fff 85.47%, #f1f3f5 97.49%, #d9e3ed 100%);
        background-image: -webkit-linear-gradient(bottom, #d8dfee 0%, #d8dfee 0.76%, #eff1f4 3%, #fff 85.47%, #f1f3f5 97.49%, #d9e3ed 100%);
        background-image: linear-gradient(bottom, #d8dfee 0%, #d8dfee 0.76%, #eff1f4 3%, #fff 85.47%, #f1f3f5 97.49%, #d9e3ed 100%);

        border-top: 1px solid #e3e3e3;
    }

    .nav2 {

        background: #fff;
        font-size: 14px;
        border-bottom: 1px solid #e3e3e3;
        width: 700px;
        margin-left: -20px;
        margin-top: -20px;
        margin-bottom: 15px;
    }

    .nav2 a {
        padding: 10px 20px;
        color: #37505C;
        margin: 0;
    }

    .nav2 a.active, .nav2 a.second:hover {
        background-image: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSIgdmlld0JveD0iMCAwIDEwMCAxMDAiIHByZXNlcnZlQXNwZWN0UmF0aW89Im5vbmUiPjxsaW5lYXJHcmFkaWVudCBpZD0iaGF0MCIgZ3JhZGllbnRVbml0cz0ib2JqZWN0Qm91bmRpbmdCb3giIHgxPSI1MCUiIHkxPSIxMDAlIiB4Mj0iNTAlIiB5Mj0iLTEuNDIxMDg1NDcxNTIwMmUtMTQlIj4KPHN0b3Agb2Zmc2V0PSIwJSIgc3RvcC1jb2xvcj0iI2Y3ZjlmYiIgc3RvcC1vcGFjaXR5PSIxIi8+CjxzdG9wIG9mZnNldD0iNCUiIHN0b3AtY29sb3I9IiNmN2Y3ZjkiIHN0b3Atb3BhY2l0eT0iMSIvPgo8c3RvcCBvZmZzZXQ9IjEwMCUiIHN0b3AtY29sb3I9IiNmZmYiIHN0b3Atb3BhY2l0eT0iMSIvPgogICA8L2xpbmVhckdyYWRpZW50PgoKPHJlY3QgeD0iMCIgeT0iMCIgd2lkdGg9IjEwMCIgaGVpZ2h0PSIxMDAiIGZpbGw9InVybCgjaGF0MCkiIC8+Cjwvc3ZnPg==);
        background-image: -moz-linear-gradient(bottom, #f7f9fb 0%, #f7f7f9 3.76%, #fff 100%);
        background-image: -o-linear-gradient(bottom, #f7f9fb 0%, #f7f7f9 3.76%, #fff 100%);
        background-image: -webkit-linear-gradient(bottom, #f7f9fb 0%, #f7f7f9 3.76%, #fff 100%);
        background-image: linear-gradient(bottom, #f7f9fb 0%, #f7f7f9 3.76%, #fff 100%);
        color: #222 !important;
        box-shadow: 0 0 3px #d6dce8 inset;
        margin: 0;
    }

    .items {
        padding: 10px;
        border-bottom: 1px solid #e3e3e3;
        background: #fff;
    }

    .createButton, .createButton:hover {
        background: #F39926;
        padding: 8px 13px;
        color: #fff !important;
        font-family: 'Helvetica Neue', sans-serif;
        font-size: 17px;
        border-radius: 4px;
        -moz-border-radius: 4px;
        -webkit-border-radius: 4px;
        text-shadow: 1px 1px 0 #c06a1e !important;
        border: 2px solid #c06a1e !important;
    }

    .saveButton, .saveButton:hover {
        background: #446EA9;
        padding: 8px 13px;
        color: #fff;
        font-family: 'Helvetica Neue', sans-serif;
        font-size: 17px;
        border-radius: 4px;
        -moz-border-radius: 4px;
        -webkit-border-radius: 4px;
        border: 2px solid #245eae;
        text-shadow: 0 0 3px #245eae !important;
    }

    .EditPage {
        background: #fff;
        padding: 20px;
    }

    .titleArea {
        padding-bottom: 1px;
        background-image: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSIgdmlld0JveD0iMCAwIDEwMCAxMDAiIHByZXNlcnZlQXNwZWN0UmF0aW89Im5vbmUiPjxsaW5lYXJHcmFkaWVudCBpZD0iaGF0MCIgZ3JhZGllbnRVbml0cz0ib2JqZWN0Qm91bmRpbmdCb3giIHgxPSI1MCUiIHkxPSIxMDAlIiB4Mj0iNTAlIiB5Mj0iLTEuNDIxMDg1NDcxNTIwMmUtMTQlIj4KPHN0b3Agb2Zmc2V0PSIwJSIgc3RvcC1jb2xvcj0iI2Y3ZjlmYiIgc3RvcC1vcGFjaXR5PSIxIi8+CjxzdG9wIG9mZnNldD0iNCUiIHN0b3AtY29sb3I9IiNmN2Y3ZjkiIHN0b3Atb3BhY2l0eT0iMSIvPgo8c3RvcCBvZmZzZXQ9IjEwMCUiIHN0b3AtY29sb3I9IiNmZmYiIHN0b3Atb3BhY2l0eT0iMSIvPgogICA8L2xpbmVhckdyYWRpZW50PgoKPHJlY3QgeD0iMCIgeT0iMCIgd2lkdGg9IjEwMCIgaGVpZ2h0PSIxMDAiIGZpbGw9InVybCgjaGF0MCkiIC8+Cjwvc3ZnPg==);
        background-image: -moz-linear-gradient(bottom, #f7f9fb 0%, #f7f7f9 3.76%, #fff 100%);
        background-image: -o-linear-gradient(bottom, #f7f9fb 0%, #f7f7f9 3.76%, #fff 100%);
        background-image: -webkit-linear-gradient(bottom, #f7f9fb 0%, #f7f7f9 3.76%, #fff 100%);
        background-image: linear-gradient(bottom, #f7f9fb 0%, #f7f7f9 3.76%, #fff 100%);
        border: 1px solid #eee;
        padding: 20px;
        margin-bottom: 20px;
    }

    .titleArea h2 {
        margin: 0;
        padding: 5px 0;
        font-weight: bold;
        letter-spacing: -1px;
        font-size: 28px;
        color: #446EA9 !important;
    }

    #siteOptions a {
        color: #446EA9;
    }

    .EditPage h4 {
        background: url(https://cdn3.iconfinder.com/data/icons/eightyshades/512/17_Question-16.png) no-repeat right;
        color: #222 !important;
    }

    .titleArea h5 {
        margin: 0;
        color: #444;
        padding: 5px 0;
        font-weight: normal;
        letter-spacing: 1px;
        opacity: .6;
        font-size: 11px;
        text-transform: uppercase;
    }
    </style>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/redmond/jquery-ui.css">
    <script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
    <script>
        jQuery(function () {
            jQuery("#datepicker").datepicker();
            jQuery("#datepicker2").datepicker();
        });
    </script>

    <div id="options_panel">
    <div id="topnewbie" style="position: relative">
        <img src="<?php echo plugins_url() ?>/scarcitybuilder/include/overlay.png"
             style="position: absolute; top: 0; right: 0; height: 105px;">
        <img src="<?php echo plugins_url() ?>/scarcitybuilder/include/logo.png"
             style="margin-left: -15px; width: 380px;">


        <div style="float: right; width: 300px; padding-top: 20px;">

            <?php

            if ($_REQUEST['type'] == '3') {
                $_REQUEST['day'] = $_REQUEST['cookie_day'];
                $_REQUEST['hour'] = $_REQUEST['cookie_hour'];
                $_REQUEST['minutes'] = $_REQUEST['cookie_minutes'];
            }

            if ('updatePlayer' == $_REQUEST['action']) {

                scarcitybuilderx_updatePlayer(stripslashes($_REQUEST['name']), stripslashes($_REQUEST['color']), stripslashes($_REQUEST['font']), stripslashes($_REQUEST['size']), stripslashes($_REQUEST['day']), stripslashes($_REQUEST['hour']), stripslashes($_REQUEST['minutes']), stripslashes($_REQUEST['date']), stripslashes($_REQUEST['timezone']), stripslashes($_REQUEST['expiryaction']), stripslashes($_REQUEST['expiredtext']), stripslashes($_REQUEST['redirecturl']), stripslashes($_REQUEST['type']), stripslashes($_REQUEST['cookie']), stripslashes($_REQUEST['dateTime']), $_GET['edit']);

                update_option('translate' . '_' . $_REQUEST['name'], $_REQUEST['translate']);

                echo '<div id="message" class="updated fade" style="clear: both; position: relative; margin: 0;"><p><strong>Successfully Updated Countdown</strong></p></div>';
            }

            ?>

            <?php


            if ('new' == $_REQUEST['action']) {

                scarcitybuilderx_addPlayer(stripslashes($_REQUEST['name']), stripslashes($_REQUEST['color']), stripslashes($_REQUEST['font']), stripslashes($_REQUEST['size']), stripslashes($_REQUEST['day']), stripslashes($_REQUEST['hour']), stripslashes($_REQUEST['minutes']), stripslashes($_REQUEST['date']), stripslashes($_REQUEST['timezone']), stripslashes($_REQUEST['expiryaction']), stripslashes($_REQUEST['expiredtext']), stripslashes($_REQUEST['redirecturl']), stripslashes($_REQUEST['type']), stripslashes($_REQUEST['cookie']), stripslashes($_REQUEST['dateTime']));

                update_option('translate' . '_' . $_REQUEST['name'], $_REQUEST['translate']);

                echo '<div id="message" class="updated fade" style="clear: both; position: relative; margin: 0;"><p><strong>Successfully Created New Countdown</strong></p></div> ';
            }


            if ($_GET['delete'] != "") {

                scarcitybuilderx_deletePlayer($_GET['delete']);

                echo '<div id="message" class="updated fade" style="clear: both; position: relative; margin: 0;"><p><strong>Deleted a Countdown</strong></p></div> ';
            }

            if ($_GET['edit'] != '') {
                ?>
                <script>
                    jQuery(document).ready(function ($) {
                        $('.tab').hide();
                        $('.tab2').show();
                    });
                </script>
            <?php
            }
            ?>
        </div>


    </div>
    <div class="nav">
        <a  <?php if ($_GET['edit'] != '') { ?> href="admin.php?page=scarcitybuilderx" <?php
        } else {
            echo 'href="#"';
        } ?> tab="tab1" class="tabLink <?php if ($_GET['edit'] == '') { ?> dash <?php } ?>"><img
                src="https://cdn0.iconfinder.com/data/icons/30_Free_Black_ToolBar_Icons/40/Black_Home.png"
                style="margin-bottom: -6px;width: 24px; opacity: .8; margin-right: 8px">Dashboard</a>
        <a href="#" id="newEdit" tab="tab2"
           class="tabLink newEbook <?php if ($_GET['edit'] != '') { ?> active <?php } ?>"><img
                src="https://cdn0.iconfinder.com/data/icons/30_Free_Black_ToolBar_Icons/40/Black_Calendar.png"
                style="margin-bottom: -6px; width: 24px; opacity: .8;margin-right: 8px">Create New Countdown</a>
        <a href="http://support.digitalkickstart.com/support/home" target="_blank" class="tabLink2"><img
                src="https://cdn0.iconfinder.com/data/icons/30_Free_Black_ToolBar_Icons/40/Black_Connect.png"
                style="margin-bottom: -6px; width: 24px; opacity: .8; margin-right: 8px">Support</a>
        <br clear="all">
    </div>


    <div class="tab tab1">
        <script>
            function myFunction() {
                var x;
                var r = confirm("Press a button!");
                if (r == true) {
                    x = "You pressed OK!";
                }
                else {
                    return false;
                }
                document.getElementById("demo").innerHTML = x;
            }
        </script>

        <?php
        global $post;
        global $wpdb;
        $getPage = $wpdb->prefix . "scarcitybuilderx";
        $templates = $wpdb->get_results("SELECT * FROM $getPage ORDER BY id DESC", ARRAY_A);

        $tpl = get_post_meta($post->ID, '_template', true);
        $checkNumber = 0;

        foreach ($templates as $template) {
            $checkNumber += 1;
        }
        ?>

        <div style="">
            <?php foreach ($templates as $template) { ?>
                <div class="items">
                    <strong
                        style="padding: 10px;font-size: 17px; padding-top: 19px; color: #444;text-transform: capitalize; float: left"><a
                            href="admin.php?page=scarcitybuilderx&edit=<?php echo $template['id']; ?>"
                            style="color: #333 ; text-decoration: none"><?php echo $template['name']; ?></a></strong>

                    <strong
                        style="padding: 5px; margin-right: 10px;font-size: 11px; letter-spacing: 1px; color: #98836a; border-radius: 4px; margin-top: 13px; border: 1px solid #ddd;background: #F7F8FA; float: right; font-weight: normal; width: 150px;"><input
                            style="margin: 0;font-size: 11px; padding: 3px; color: #888" type="text"
                            value='[scarcitybuilderx id="<?php echo $template['id']; ?>"]'></strong>

                    <strong style="padding: 6px; padding-top: 16px;font-size: 13px; opacity: .6;float: right;"><a
                            onclick="if (confirm('Are you sure you want to delete this countdown?')) commentDelete(1); return false"
                            href="admin.php?page=scarcitybuilderx&delete=<?php echo $template['id']; ?>"><img
                                src="https://cdn0.iconfinder.com/data/icons/30_Free_Black_ToolBar_Icons/40/Black_Trash.png"
                                style="width: 20px; margin-top:2px; margin-right: 20px;"></a></strong>

                    <strong style="padding: 6px; padding-top: 16px;font-size: 13px;opacity: .6; float: right;"><a
                            href="admin.php?page=scarcitybuilderx&edit=<?php echo $template['id']; ?>"><img
                                src="https://cdn0.iconfinder.com/data/icons/30_Free_Black_ToolBar_Icons/40/Black_Settings.png"
                                style="width: 24px;"></a></strong>
                    <!-- <strong style="padding: 6px; padding-top: 14px;font-size: 16px; opacity: .6;float: right;"><img src="https://cdn3.iconfinder.com/data/icons/wpzoom-developer-icon-set/500/34-48.png" style="width: 32px;"> <span style="margin-left: 6px; margin-top: 4px; color: #000;float: right">20</span></strong> -->


                    <br clear="all"></div>
            <?php } ?>
            <?php if ($checkNumber == 0) { ?>
                <h3 style="padding: 5px 50px;"><img
                        src="https://cdn3.iconfinder.com/data/icons/freeapplication/png/24x24/Warning.png"
                        style="float: left; margin-right: 10px">Start adding new shortcodes. <a href="#" tab="tab2"
                                                                                                style="background: none; padding: 0; border: none; text-decoration: underline; margin: 0; font-size: 18px;color: #2b5695 !important; text-shadow: none; float: none; display: inline"
                                                                                                class="tabLink newEbook">Click
                        here to add new shortcode.</a></h3>
            <?php } ?>
        </div>


        <br>
        <a href="#" tab="tab2" class="tabLink createButton"
           style="float: right; margin-right: 20px; text-decoration: none;">Create New Countdown</a>
        <br clear="all">
    </div>
    <div class="tab tab2" style="display: none">

    <?php if ($_GET['edit'] != '') { ?>

        <?php
        global $post;
        global $wpdb;
        $getPage = $wpdb->prefix . "scarcitybuilderx";
        $getID = $_GET['edit'];
        $editBook = $wpdb->get_results("SELECT * FROM $getPage WHERE id = $getID", ARRAY_A);


        $tpl = get_post_meta($post->ID, '_template', true);

        foreach ($editBook as $template) {
        }
        ?>




        <div class="EditPage" style="  border-bottom: 1px solid #ddd; margin-bottom: 10px;">
        <div class="nav2">
            <a href="#" tab="brand" class="second active">Countdown Type</a>
            <a href="#" tab="design" class="second linkEverGreen"
               style="display: none; <?php if ($template['type'] == '1') { ?> display: block <?php } ?>">Ever Green</a>
            <a href="#" tab="timed" class="second dateTime"
               style="display: none; <?php if ($template['type'] == '2') { ?> display: block <?php } ?>">Date / Time</a>
            <a href="#" tab="cookiesTab" class="second cookies"
               style="display: none; <?php if ($template['type'] == '3') { ?> display: block <?php } ?>">Cookie
                Countdown</a>
            <a href="#" tab="extraContent" class="second">Expiry Action</a>
            <a href="#" tab="a_responder" class="second">Design</a>
            <br style="clear: both">
        </div>
        <form id="newEbook" method="post" action="<?php echo str_replace('%7E', '~', $_SERVER['REQUEST_URI']); ?>">
        <input type="hidden" name="action" value="updatePlayer"/>
        <input type="hidden" name="pageID" value="<?php echo $getID; ?>"/>

        <div class="brand inner_tab">
            <input type="hidden" value="<?php echo htmlspecialchars($template['name']); ?>" name="name"/>

            <div class="titleArea">
                <h2>Choose Countdown Type</h2>
                <h5><strong>EverGreen</strong> or traditional <strong>Date/Time</strong> types. </h5>
            </div>
            <div style="width: 220px; opacity: .8; float: left">
                <h4 style="padding: 0; margin: 0; padding: 5px 0;">Choose Type of Countdown</h4>

                <p>Select from a variety of countdown action style...</p>
            </div>
            <div style="width: 400px; float: right">
                <strong>Countdown Type</strong>

                <select name="type" id="type">
                    <option value="1" <?php if ($template['type'] == '1') { ?> selected <?php } ?>>Ever Green</option>
                    <option value="2" <?php if ($template['type'] == '2') { ?> selected <?php } ?>>Date &amp; Time
                    </option>
                    <option value="3" <?php if ($template['type'] == '3') { ?> selected <?php } ?>>Cookie Based
                        Countdown
                    </option>
                </select>
            </div>
            <br clear="all">

        </div>
        <div class="cookiesTab inner_tab" style="display: none">

            <div class="titleArea">
                <h2>Setup Cookie-Based Countdown</h2>
                <h5>Choose the exact <strong>Day</strong>, <strong>Hour</strong> and <strong>Minute</strong> to expire.
                </h5>
            </div>
            <div style="width: 220px; opacity: .8; float: left">
                <h4 style="padding: 0; margin: 0; padding: 5px 0;">Cookie Countdown</h4>

                <p>This countdown will be different for each user, when they land, it will look as if the countdown had
                    already been going on, and it will show them some time based on the number of days you choose. They
                    will be cookied, so when they return, time has actually passed by.</p></div>
            <div style="width: 400px; float: right">
                <strong>Days:</strong>
                <input type="text" placeholder="1" name="cookie_day"
                       value="<?php echo htmlspecialchars($template['day']); ?>"/>
                <strong>Hours:</strong>
                <input type="text" placeholder="6" name="cookie_hour"
                       value="<?php echo htmlspecialchars($template['hour']); ?>"/>
                <strong>Minutes:</strong>
                <input type="text" placeholder="30" name="cookie_minutes"
                       value="<?php echo htmlspecialchars($template['minutes']); ?>"/>
            </div>
            <br clear="all">
        </div>
        <div class="design inner_tab" style="display: none">

            <div class="titleArea">
                <h2>Setup Ever Green Countdown</h2>
                <h5>Choose the exact <strong>Day</strong>, <strong>Hour</strong> and <strong>Minute</strong> to expire.
                </h5>
            </div>
            <div style="width: 220px; opacity: .8; float: left">
                <h4 style="padding: 0; margin: 0; padding: 5px 0;">EverGreen Countdown</h4>

                <p>This countdown type will countdown and restart for ever use to keep your countdown always running for
                    all visitors.</p>
            </div>
            <div style="width: 400px; float: right">
                <strong>Days:</strong>
                <input type="text" placeholder="1" name="day"
                       value="<?php echo htmlspecialchars($template['day']); ?>"/>
                <strong>Hours:</strong>
                <input type="text" placeholder="6" name="hour"
                       value="<?php echo htmlspecialchars($template['hour']); ?>"/>
                <strong>Minutes:</strong>
                <input type="text" placeholder="30" name="minutes"
                       value="<?php echo htmlspecialchars($template['minutes']); ?>"/>
            </div>
            <br clear="all">

        </div>
        <div class="timed inner_tab" style="display: none">
        <div class="titleArea">
            <h2>Setup Date / Time Countdown</h2>
            <h5>Choose the exact <strong>Month, Day and Year</strong> and choose your timezone. </h5>
        </div>
        <div style="width: 220px; opacity: .8; float: left">
            <h4 style="padding: 0; margin: 0; padding: 5px 0;">Date, Time and Timezone</h4>

            <p>Choose a date with the calender date picker, select a specific time and timezone for accurate
                time.</p>

            <p><strong>Time is 24HR ex. 09:00 is 9am and 21:00 is 9pm</strong></p>
        </div>
        <div style="width: 400px; float: right">
        <strong>Choose Date:</strong>
        <input type="text" id="datepicker2" placeholder="Choose Date" name="date"
               value="<?php echo htmlspecialchars($template['date']); ?>"/>
        <strong>End Time:</strong>
        <!-- <input type="text" name="dateTime" value="<?php echo htmlspecialchars($template['time']); ?>" placeholder="12:00"> -->
        <select name="dateTime">
            <?php

            for ($hour = 0; $hour < 24; $hour ++) {
                $pretty_hour = str_pad( $hour, 2, '0', STR_PAD_LEFT );
                for ($minute = 0; $minute < 60; $minute += 30) {
                    $pretty_minute = str_pad( $minute, 2, '0', STR_PAD_LEFT );
                    $pretty_time   = $pretty_hour . ':' . $pretty_minute;
                    ?>
                    <option value="<?php echo $pretty_time; ?>" <?php if ($template['time'] == $pretty_time) {
                        echo "selected";
                    } ?> > <?php echo $pretty_time; ?>
                    </option>
                <?php
                }
            }

            ?>
        </select>

        <strong>Choose Timezone:</strong>

        <select name="timezone" class="timezone">
            <option value="-5.0" <?php if ($template['timezone'] == '-5.0') { ?> selected <?php } ?>>Eastern
                Time (US &amp; Canada), Bogota, Lima
            </option>
            <option value="-12.0" <?php if ($template['timezone'] == '-12.0') { ?> selected <?php } ?>>Eniwetok,
                Kwajalein
            </option>
            <option value="-11.0" <?php if ($template['timezone'] == '-11.0') { ?> selected <?php } ?>>Midway
                Island, Samoa
            </option>
            <option value="-10.0" <?php if ($template['timezone'] == '-10.0') { ?> selected <?php } ?>>Hawaii
            </option>
            <option value="-9.0" <?php if ($template['timezone'] == '-9.0') { ?> selected <?php } ?>>Alaska
            </option>
            <option value="-8.0" <?php if ($template['timezone'] == '-8.0') { ?> selected <?php } ?>>Pacific
                Time (US &amp; Canada)
            </option>
            <option value="-7.0" <?php if ($template['timezone'] == '-7.0') { ?> selected <?php } ?>>Mountain
                Time (US &amp; Canada)
            </option>
            <option value="-6.0" <?php if ($template['timezone'] == '-6.0') { ?> selected <?php } ?>>Central
                Time (US &amp; Canada), Mexico City
            </option>
            <option value="-5.0" <?php if ($template['timezone'] == '-5.0') { ?> selected <?php } ?>>Eastern
                Time (US &amp; Canada), Bogota, Lima
            </option>
            <option value="-4.0" <?php if ($template['timezone'] == '-4.0') { ?> selected <?php } ?>>Atlantic
                Time (Canada), Caracas, La Paz
            </option>
            <option value="-3.5" <?php if ($template['timezone'] == '-3.5') { ?> selected <?php } ?>>
                Newfoundland
            </option>
            <option value="-3.0" <?php if ($template['timezone'] == '-3.0') { ?> selected <?php } ?>>Brazil,
                Buenos Aires, Georgetown
            </option>
            <option value="-2.0" <?php if ($template['timezone'] == '-2.0') { ?> selected <?php } ?>>
                Mid-Atlantic
            </option>
            <option value="-1.0" <?php if ($template['timezone'] == '-1.0') { ?> selected <?php } ?>>Azores,
                Cape Verde Islands
            </option>
            <option value="0.0" <?php if ($template['timezone'] == '0.0') { ?> selected <?php } ?>>Western
                Europe Time, London, Lisbon, Casablanca
            </option>
            <option value="1.0" <?php if ($template['timezone'] == '1.0') { ?> selected <?php } ?>>Brussels,
                Copenhagen, Madrid, Paris
            </option>
            <option value="2.0" <?php if ($template['timezone'] == '2.0') { ?> selected <?php } ?>>Kaliningrad,
                South Africa
            </option>
            <option value="3.0" <?php if ($template['timezone'] == '3.0') { ?> selected <?php } ?>>Baghdad,
                Riyadh, Moscow, St. Petersburg
            </option>
            <option value="3.5" <?php if ($template['timezone'] == '3.5') { ?> selected <?php } ?>>Tehran
            </option>
            <option value="4.0" <?php if ($template['timezone'] == '4.0') { ?> selected <?php } ?>>Abu Dhabi,
                Muscat, Baku, Tbilisi
            </option>
            <option value="4.5" <?php if ($template['timezone'] == '4.5') { ?> selected <?php } ?>>Kabul
            </option>
            <option value="5.0" <?php if ($template['timezone'] == '5.0') { ?> selected <?php } ?>>Ekaterinburg,
                Islamabad, Karachi, Tashkent
            </option>
            <option value="5.5" <?php if ($template['timezone'] == '5.5') { ?> selected <?php } ?>>Bombay,
                Calcutta, Madras, New Delhi
            </option>
            <option value="5.75" <?php if ($template['timezone'] == '5.75') { ?> selected <?php } ?>>Kathmandu
            </option>
            <option value="6.0" <?php if ($template['timezone'] == '6.0') { ?> selected <?php } ?>>Almaty,
                Dhaka, Colombo
            </option>
            <option value="7.0" <?php if ($template['timezone'] == '7.0') { ?> selected <?php } ?>>Bangkok,
                Hanoi, Jakarta
            </option>
            <option value="8.0" <?php if ($template['timezone'] == '8.0') { ?> selected <?php } ?>>Beijing,
                Perth, Singapore, Hong Kong
            </option>
            <option value="9.0" <?php if ($template['timezone'] == '9.0') { ?> selected <?php } ?>>Tokyo, Seoul,
                Osaka, Sapporo, Yakutsk
            </option>
            <option value="9.5" <?php if ($template['timezone'] == '9.5') { ?> selected <?php } ?>>Adelaide,
                Darwin
            </option>
            <option value="10.0" <?php if ($template['timezone'] == '10.0') { ?> selected <?php } ?>>Eastern
                Australia, Guam, Vladivostok
            </option>
            <option value="11.0" <?php if ($template['timezone'] == '11.0') { ?> selected <?php } ?>>Magadan,
                Solomon Islands, New Caledonia
            </option>
            <option value="12.0" <?php if ($template['timezone'] == '12.0') { ?> selected <?php } ?>>Auckland,
                Wellington, Fiji, Kamchatka
            </option>

        </select>
        </div>
        <br clear="all">
        </div>
        <div class="a_responder inner_tab" style="display: none">
            <div class="titleArea">
                <h2>Customize Design Styles</h2>
                <h5>Choose the Font style, countdown size and a variety of colors. </h5>
            </div>
            <div style="width: 220px; opacity: .8; float: left">
                <h4 style="padding: 0; margin: 0; padding: 5px 0;">Customize Design</h4>

                <p>Change the font style, countdown size and the color of the countdown style.</p>
            </div>
            <div style="width: 400px; float: right">
                <strong>Choose Font</strong>

                <div style="width: 400px; ">
                    <input type="text" class="fonts" style="width: 400px;"
                           value="<?php echo htmlspecialchars($template['font']); ?>"/>
                    <input type="hidden" name="font" class="font"
                           value="<?php echo htmlspecialchars($template['font']); ?>"/>
                </div>

                <strong>Countdown Size</strong>
                <select name="size" id="size">
                    <option value="4" <?php if ($template['size'] == '4') { ?> selected <?php } ?>>Extra Small</option>
                    <option value="1" <?php if ($template['size'] == '1') { ?> selected <?php } ?>>Small</option>
                    <option value="2" <?php if ($template['size'] == '2') { ?> selected <?php } ?>>Medium</option>
                    <option value="3" <?php if ($template['size'] == '3') { ?> selected <?php } ?>>Large</option>
                </select>
                <strong>Choose Color</strong>
                <select name="color" id="color">
                    <option value="12" <?php if ($template['color'] == '12') { ?> selected <?php } ?>>Plain Text -
                        Black
                    </option>
                    <option value="13" <?php if ($template['color'] == '13') { ?> selected <?php } ?>>Plain Text -
                        White
                    </option>
                    <option value="1" <?php if ($template['color'] == '1') { ?> selected <?php } ?>>Grey - Flat</option>
                    <option value="2" <?php if ($template['color'] == '2') { ?> selected <?php } ?>>Gold - Flat</option>
                    <option value="3" <?php if ($template['color'] == '3') { ?> selected <?php } ?>>Blue - Flat</option>
                    <option value="4" <?php if ($template['color'] == '4') { ?> selected <?php } ?>>Red - Flat</option>
                    <option value="6" <?php if ($template['color'] == '6') { ?> selected <?php } ?>>Green - Flat
                    </option>
                    <option value="5" <?php if ($template['color'] == '5') { ?> selected <?php } ?>>Black - Flat
                    </option>
                    <option value="7" <?php if ($template['color'] == '7') { ?> selected <?php } ?>>Grey - Gradient
                    </option>
                    <option value="8" <?php if ($template['color'] == '8') { ?> selected <?php } ?>>Gold - Gradient
                    </option>
                    <option value="9" <?php if ($template['color'] == '9') { ?> selected <?php } ?>>Blue - Gradient
                    </option>
                    <option value="10" <?php if ($template['color'] == '10') { ?> selected <?php } ?>>Red - Gradient
                    </option>
                    <option value="11" <?php if ($template['color'] == '11') { ?> selected <?php } ?>>Green - Gradient
                    </option>
                </select>

                <strong>Translate</strong>

                <p>Translate: Days, Hours, Minutes, Seconds | Day, Hour, Minute, Second</p>
                <input type="text" name="translate" placeholder="countdown translation..." id="translate"
                       value="<?php if (get_option('translate' . '_' . $template['name']) == "") {
                           echo "Days, Hours, Minutes, Seconds|Day, Hour, Minute, Second";
                       } else {
                           echo get_option('translate' . '_' . $template['name']);
                       } ?>">
            </div>
            <br clear="all">

        </div>
        <div class="extraContent inner_tab" style="display: none">

            <div class="titleArea">
                <h2>Setup Expiry Action</h2>
                <h5>Activate this choice when your countdown is expired. </h5>
            </div>
            <div style="width: 220px; opacity: .8; float: left">
                <h4 style="padding: 0; margin: 0; padding: 5px 0;">Expiry Action</h4>

                <p>Choose what happens when your countdown has reached the end of countdown date or time.</p>
            </div>
            <div style="width: 400px; float: right">
                <strong>Expiry Action</strong>
                <select name="expiryaction" id="expiryaction_edit">
                    <option value="1" <?php if ($template['expiryaction'] == '1') { ?> selected <?php } ?>>Do Nothing
                    </option>
                    <option value="2" <?php if ($template['expiryaction'] == '2') { ?> selected <?php } ?>>Redirect to
                        URL
                    </option>
                    <option value="3" <?php if ($template['expiryaction'] == '3') { ?> selected <?php } ?>>Show Expired
                        Content
                    </option>
                    <option value="4" <?php if ($template['expiryaction'] == '4') { ?> selected <?php } ?>>Hide
                        Countdown
                    </option>
                </select>

                <div class="redirectExpired"
                     style="display: none; <?php if ($template['expiryaction'] == '2') { ?> display: block <?php } ?>">
                    <strong>Redirect URL:</strong>
                    <input type="text" placeholder="URL to Redirect After Expired Countdown" name="redirecturl"
                           value="<?php echo htmlspecialchars($template['redirecturl']); ?>"/>
                </div>

            </div>
            <br clear="all">

            <div class="contentExpired"
                 style="display: none; <?php if ($template['expiryaction'] == '3') { ?> display: block <?php } ?>">

                <?php $settings = array('wautop' => true); ?>
                <?php wp_editor($template['expiredtext'], 'expiredtext', $settings); ?>
            </div>
        </div>

        <!-- <input type="submit" value="Click Here to Save Shortcode" class="save " > -->
        </div>
        <br clear="all">
        <input type="submit" value="Save Countdown Shortcode" class="saveButton"
               style="float: right; cursor: pointer; font-weight: bold; margin: 10px 0; margin-right: 20px; text-decoration: none;"/>
        <br clear="all">
        </form>
    <?php } else { ?>

        <div class="EditPage" style="border-bottom: 1px solid #ddd; margin-bottom: 10px;">
        <div class="nav2">
            <a href="#" tab="brand" class="second active">Countdown Type</a>
            <a href="#" tab="design" class="second linkEverGreen"
               style="display: none; <?php if ($template['type'] == '1') { ?> display: block <?php } ?>">Ever Green</a>
            <a href="#" tab="timed" class="second dateTime"
               style="display: none; <?php if ($template['type'] == '2') { ?> display: block <?php } ?>">Date / Time</a>
            <a href="#" tab="cookiesTab" class="second cookies"
               style="display: none; <?php if ($template['type'] == '3') { ?> display: block <?php } ?>">Cookie
                Countdown</a>

            <a href="#" tab="extraContent" class="second">Expiry Action</a>
            <a href="#" tab="a_responder" class="second">Design Options</a>
            <br style="clear: both">
        </div>
        <form id="newEbook" method="post" action="<?php echo str_replace('%7E', '~', $_SERVER['REQUEST_URI']); ?>">
        <input type="hidden" name="action" value="new"/>

        <div class="brand inner_tab">
            <div class="titleArea">
                <h2>Choose Countdown Type</h2>
                <h5><strong>EverGreen</strong> or traditional <strong>Date/Time</strong> types. </h5>
            </div>
            <div style="width: 220px; opacity: .8; float: left">
                <h4 style="padding: 0; margin: 0; padding: 5px 0;">Choose Type of Countdown</h4>

                <p>Select from a variety of countdown styles from simple countdown, evergreen or add countdown box
                    type with a headline.</p>
            </div>
            <div style="width: 400px; float: right">
                <strong>Player Name
                    <small>(* Required)</small>
                    :</strong>
                <input type="text" placeholder="Name for Your Shortcode" required name="name"/>

                <strong>Countdown Type</strong>
                <select name="type" id="type">
                    <option value="1" <?php if ($template['type'] == '1') { ?> selected <?php } ?>>Ever Green
                    </option>
                    <option value="2" <?php if ($template['type'] == '2') { ?> selected <?php } ?>>Date &amp; Time
                    </option>
                    <option value="3" <?php if ($template['type'] == '3') { ?> selected <?php } ?>>Cookie Based
                        Countdown
                    </option>
                </select>
            </div>
            <br clear="all">
        </div>
        <div class="cookiesTab inner_tab" style="display: none">

            <div class="titleArea">
                <h2>Setup Cookie-Based Countdown</h2>
                <h5>Choose the exact <strong>Day</strong>, <strong>Hour</strong> and <strong>Minute</strong> to
                    expire. </h5>
            </div>
            <div style="width: 220px; opacity: .8; float: left">
                <h4 style="padding: 0; margin: 0; padding: 5px 0;">Cookie Countdown</h4>

                <p>This countdown will be different for each user, when they land, it will look as if the countdown
                    had already been going on, and it will show them some time based on the number of days you
                    choose. They will be cookied, so when they return, time has actually passed by.</p>
            </div>
            <div style="width: 400px; float: right">
                <strong>Number Of Days:</strong>
                <!-- <input type="text"   placeholder="1" name="cookie" value="<?php echo htmlspecialchars($template['cookie']); ?>" /> -->
                <select name="cookie" id="cookie">
                    <option value="1" <?php if ($template['cookie'] == "1") {
                        echo "selected";
                    } ?> >1 Day
                    </option>
                    <option value="2" <?php if ($template['cookie'] == "2") {
                        echo "selected";
                    } ?> >2 Days
                    </option>
                    <option value="3" <?php if ($template['cookie'] == "3") {
                        echo "selected";
                    } ?> >3 Days
                    </option>
                    <option value="4" <?php if ($template['cookie'] == "4") {
                        echo "selected";
                    } ?> >4 Days
                    </option>
                </select>
            </div>
            <br clear="all">
        </div>
        <div class="design inner_tab" style="display: none">
            <div class="titleArea">
                <h2>Setup Ever Green Countdown</h2>
                <h5>Choose the exact <strong>Day</strong>, <strong>Hour</strong> and <strong>Minute</strong> to
                    expire. </h5>
            </div>
            <div style="width: 220px; opacity: .8; float: left">
                <h4 style="padding: 0; margin: 0; padding: 5px 0;">EverGreen Countdown</h4>

                <p>This countdown type will countdown and restart for ever use to keep your countdown always running
                    for all visitors.</p>
            </div>
            <div style="width: 400px; float: right">
                <strong>Days:</strong>
                <input type="text" placeholder="1" name="day"/>
                <strong>Hours:</strong>
                <input type="text" placeholder="6" name="hour"/>
                <strong>Minutes:</strong>
                <input type="text" placeholder="30" name="minutes"/>
            </div>
            <br clear="all">
        </div>
        <div class="timed inner_tab" style="display: none">
            <div class="titleArea">
                <h2>Setup Date / Time Countdown</h2>
                <h5>Choose the exact <strong>Month, Day and Year</strong> and choose your timezone. </h5>
            </div>
            <div style="width: 220px; opacity: .8; float: left">
                <h4 style="padding: 0; margin: 0; padding: 5px 0;">Date, Time and Timezone</h4>

                <p>Choose a date with the calender date picker, select a specific time and timezone for accurate
                    time.</p>

                <p><strong>Time is 24HR ex. 09:00 is 9am and 21:00 is 9pm</strong></p>
            </div>
            <div style="width: 400px; float: right">
                <strong>End Date:</strong>
                <input type="text" id="datepicker" placeholder="Choose Date" name="date"/>
                <strong>End Time:</strong>
                <input type="text" name="dateTime" placeholder="12:00">
                <strong>Choose Timezone:</strong>
                <select name="timezone" class="timezone">
                    <option value="-5.0">Eastern Time (US &amp; Canada), Bogota, Lima</option>
                    <option value="-12.0" <?php if ($template['timezone'] == '-12.0') { ?> selected <?php } ?>>
                        Eniwetok, Kwajalein
                    </option>
                    <option value="-11.0" <?php if ($template['timezone'] == '-11.0') { ?> selected <?php } ?>>
                        Midway Island, Samoa
                    </option>
                    <option value="-10.0" <?php if ($template['timezone'] == '-10.0') { ?> selected <?php } ?>>
                        Hawaii
                    </option>
                    <option value="-9.0" <?php if ($template['timezone'] == '-9.0') { ?> selected <?php } ?>>
                        Alaska
                    </option>
                    <option value="-8.0" <?php if ($template['timezone'] == '-8.0') { ?> selected <?php } ?>>Pacific
                        Time (US &amp; Canada)
                    </option>
                    <option value="-7.0" <?php if ($template['timezone'] == '-7.0') { ?> selected <?php } ?>>
                        Mountain Time (US &amp; Canada)
                    </option>
                    <option value="-6.0" <?php if ($template['timezone'] == '-6.0') { ?> selected <?php } ?>>Central
                        Time (US &amp; Canada), Mexico City
                    </option>
                    <option value="-5.0" <?php if ($template['timezone'] == '-5.0') { ?> selected <?php } ?>>Eastern
                        Time (US &amp; Canada), Bogota, Lima
                    </option>
                    <option value="-4.0" <?php if ($template['timezone'] == '-4.0') { ?> selected <?php } ?>>
                        Atlantic Time (Canada), Caracas, La Paz
                    </option>
                    <option value="-3.5" <?php if ($template['timezone'] == '-3.5') { ?> selected <?php } ?>>
                        Newfoundland
                    </option>
                    <option value="-3.0" <?php if ($template['timezone'] == '-3.0') { ?> selected <?php } ?>>Brazil,
                        Buenos Aires, Georgetown
                    </option>
                    <option value="-2.0" <?php if ($template['timezone'] == '-2.0') { ?> selected <?php } ?>>
                        Mid-Atlantic
                    </option>
                    <option value="-1.0" <?php if ($template['timezone'] == '-1.0') { ?> selected <?php } ?>>Azores,
                        Cape Verde Islands
                    </option>
                    <option value="0.0" <?php if ($template['timezone'] == '0.0') { ?> selected <?php } ?>>Western
                        Europe Time, London, Lisbon, Casablanca
                    </option>
                    <option value="1.0" <?php if ($template['timezone'] == '1.0') { ?> selected <?php } ?>>Brussels,
                        Copenhagen, Madrid, Paris
                    </option>
                    <option value="2.0" <?php if ($template['timezone'] == '2.0') { ?> selected <?php } ?>>
                        Kaliningrad, South Africa
                    </option>
                    <option value="3.0" <?php if ($template['timezone'] == '3.0') { ?> selected <?php } ?>>Baghdad,
                        Riyadh, Moscow, St. Petersburg
                    </option>
                    <option value="3.5" <?php if ($template['timezone'] == '3.5') { ?> selected <?php } ?>>Tehran
                    </option>
                    <option value="4.0" <?php if ($template['timezone'] == '4.0') { ?> selected <?php } ?>>Abu
                        Dhabi, Muscat, Baku, Tbilisi
                    </option>
                    <option value="4.5" <?php if ($template['timezone'] == '4.5') { ?> selected <?php } ?>>Kabul
                    </option>
                    <option value="5.0" <?php if ($template['timezone'] == '5.0') { ?> selected <?php } ?>>
                        Ekaterinburg, Islamabad, Karachi, Tashkent
                    </option>
                    <option value="5.5" <?php if ($template['timezone'] == '5.5') { ?> selected <?php } ?>>Bombay,
                        Calcutta, Madras, New Delhi
                    </option>
                    <option value="5.75" <?php if ($template['timezone'] == '5.75') { ?> selected <?php } ?>>
                        Kathmandu
                    </option>
                    <option value="6.0" <?php if ($template['timezone'] == '6.0') { ?> selected <?php } ?>>Almaty,
                        Dhaka, Colombo
                    </option>
                    <option value="7.0" <?php if ($template['timezone'] == '7.0') { ?> selected <?php } ?>>Bangkok,
                        Hanoi, Jakarta
                    </option>
                    <option value="8.0" <?php if ($template['timezone'] == '8.0') { ?> selected <?php } ?>>Beijing,
                        Perth, Singapore, Hong Kong
                    </option>
                    <option value="9.0" <?php if ($template['timezone'] == '9.0') { ?> selected <?php } ?>>Tokyo,
                        Seoul, Osaka, Sapporo, Yakutsk
                    </option>
                    <option value="9.5" <?php if ($template['timezone'] == '9.5') { ?> selected <?php } ?>>Adelaide,
                        Darwin
                    </option>
                    <option value="10.0" <?php if ($template['timezone'] == '10.0') { ?> selected <?php } ?>>Eastern
                        Australia, Guam, Vladivostok
                    </option>
                    <option value="11.0" <?php if ($template['timezone'] == '11.0') { ?> selected <?php } ?>>
                        Magadan, Solomon Islands, New Caledonia
                    </option>
                    <option value="12.0" <?php if ($template['timezone'] == '12.0') { ?> selected <?php } ?>>
                        Auckland, Wellington, Fiji, Kamchatka
                    </option>


                </select>
            </div>
            <br clear="all">
        </div>
        <div class="a_responder inner_tab" style="display: none">
            <div class="titleArea">
                <h2>Customize Design Styles</h2>
                <h5>Choose the Font style, countdown size and a variety of colors. </h5>
            </div>
            <div style="width: 220px; opacity: .8; float: left">
                <h4 style="padding: 0; margin: 0; padding: 5px 0;">Customize Design</h4>

                <p>Change the font style, countdown size and the color of the countdown style.</p>
            </div>
            <div style="width: 400px; float: right">
                <strong>Choose Font</strong>
                <input type="text" class="fonts" style="width: 400px;"
                       value="<?php echo htmlspecialchars($template['font']); ?>"/>
                <input type="hidden" name="font" class="font"
                       value="<?php echo htmlspecialchars($template['font']); ?>"/>

                <strong>Countdown Size</strong>
                <select name="size" id="size">
                    <option value="4" <?php if ($template['size'] == '4') { ?> selected <?php } ?>>Extra Small
                    </option>
                    <option value="1" <?php if ($template['size'] == '1') { ?> selected <?php } ?>>Small</option>
                    <option value="2" <?php if ($template['size'] == '2') { ?> selected <?php } ?>>Medium</option>
                    <option value="3" <?php if ($template['size'] == '3') { ?> selected <?php } ?>>Large</option>
                </select>
                <strong>Choose Color</strong>
                <select name="color" id="color">
                    <option value="12" <?php if ($template['color'] == '12') { ?> selected <?php } ?>>Plain Text -
                        Black
                    </option>
                    <option value="13" <?php if ($template['color'] == '13') { ?> selected <?php } ?>>Plain Text -
                        White
                    </option>
                    <option value="1" <?php if ($template['color'] == '1') { ?> selected <?php } ?>>Grey - Flat
                    </option>
                    <option value="2" <?php if ($template['color'] == '2') { ?> selected <?php } ?>>Gold - Flat
                    </option>
                    <option value="3" <?php if ($template['color'] == '3') { ?> selected <?php } ?>>Blue - Flat
                    </option>
                    <option value="4" <?php if ($template['color'] == '4') { ?> selected <?php } ?>>Red - Flat
                    </option>
                    <option value="6" <?php if ($template['color'] == '6') { ?> selected <?php } ?>>Green - Flat
                    </option>
                    <option value="5" <?php if ($template['color'] == '5') { ?> selected <?php } ?>>Black - Flat
                    </option>
                    <option value="7" <?php if ($template['color'] == '7') { ?> selected <?php } ?>>Grey -
                        Gradient
                    </option>
                    <option value="8" <?php if ($template['color'] == '8') { ?> selected <?php } ?>>Gold -
                        Gradient
                    </option>
                    <option value="9" <?php if ($template['color'] == '9') { ?> selected <?php } ?>>Blue -
                        Gradient
                    </option>
                    <option value="10" <?php if ($template['color'] == '10') { ?> selected <?php } ?>>Red -
                        Gradient
                    </option>
                    <option value="11" <?php if ($template['color'] == '11') { ?> selected <?php } ?>>Green -
                        Gradient
                    </option>
                </select>

                <strong>Translate</strong>

                <p>Translate: Days, Hours, Minutes, Seconds | Day, Hour, Minute, Second</p>
                <input type="text" name="translate" placeholder="countdown translation..." id="translate"
                       value="Days, Hours, Minutes, Seconds|Day, Hour, Minute, Second">
            </div>
            <br clear="all">
        </div>

        <div class="extraContent inner_tab" style="display: none">
            <div class="titleArea">
                <h2>Setup Expiry Action</h2>
                <h5>Activate this choice when your countdown is expired. </h5>
            </div>
            <div style="width: 220px; opacity: .8; float: left">
                <h4 style="padding: 0; margin: 0; padding: 5px 0;">Expiry Action</h4>

                <p>Choose what happens when your countdown has reached the end of countdown date or time.</p>
            </div>
            <div style="width: 400px; float: right">
                <strong>Expiry Action</strong>
                <select name="expiryaction" id="expiryaction_edit">
                    <option value="1" <?php if ($template['expiryaction'] == '1') { ?> selected <?php } ?>>Do
                        Nothing
                    </option>
                    <option value="2" <?php if ($template['expiryaction'] == '2') { ?> selected <?php } ?>>Redirect
                        to URL
                    </option>
                    <option value="3" <?php if ($template['expiryaction'] == '3') { ?> selected <?php } ?>>Show
                        Expired Content
                    </option>
                    <option value="4" <?php if ($template['expiryaction'] == '4') { ?> selected <?php } ?>>Hide
                        Countdown
                    </option>
                </select>

                <div class="redirectExpired"
                     style="display: none; <?php if ($template['expiryaction'] == '2') { ?> display: block <?php } ?>">
                    <strong>Redirect URL:</strong>
                    <input type="text" placeholder="URL to Redirect After Expired Countdown" name="redirecturl"
                           value="<?php echo htmlspecialchars($template['redirecturl']); ?>"/>
                </div>

            </div>

            <br clear="all">

            <div class="contentExpired"
                 style="display: none; <?php if ($template['expiryaction'] == '3') { ?> display: block <?php } ?>">

                <?php $settings = array('wautop' => true); ?>
                <?php wp_editor($template['expiredtext'], 'expiredtext', $settings); ?>
            </div>
        </div>

        </div>
        <!-- <input type="submit" value="Click Here to Save Shortcode" class="save " style="float: left;"> -->

        <input type="submit" value="Save Countdown Shortcode" class="saveButton"
               style="float: right; cursor: pointer; font-weight: bold; margin: 10px 0; margin-right: 20px; text-decoration: none;"/>
        <br clear="all">
        </form>

    <?php } ?>
    </div>
    <div class="tab tab3" style="display: none">


    </div>
    <div class="tab tab4" style="display: none">

    </div>

    <br clear="all">
    </div>

    </div>
<?php
}

?>
