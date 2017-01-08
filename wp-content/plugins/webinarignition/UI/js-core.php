
<script type="text/javascript">


//used to do pre-save actions
var pre_save = function () {


    //nothing, must overwrite if need
};


jQuery(document).ready(function ($) {

    // IE BROWSER CHECK

    $BROWSER = $("#iecheck").attr("browser-check");

    if ($BROWSER == "ie6" || $BROWSER == "ie7" || $BROWSER == "ie8") {
        // THEY ARE USING IE6 OR IE7
        $("#IE-NO").show();
    } else if ($BROWSER == "ie9" || $BROWSER == "ie10") {
        // THEY ARE USING IE8, IE9 OR IE10
        $("#IE-REC").show();
    }

    $('.helper').tooltip();

    // Dashboard Click
    $('.editableSectionHeadingDASH').click(function () {

        $ID = $(this).attr("webinarID");

        window.location = "<?php echo $_SERVER["REQUEST_URI"]; ?>&id=" + $ID;

        return false;
    });

    // Create NEW App ::

    $('#createnewapp').click(function () {

        $appname = $("#appname").val();
        $cloneapp = $("#cloneapp").val();


        if ($appname == "") {
            $("#notice_name").fadeIn("fast");
        } else {
            $("#notice_name").fadeOut("fast");

            $('#createnewappBTN').html("Saving...");

            var data = {
                action: '<?php echo $pluginName; ?>_create',
                appname: "" + $appname + "",
                cloneapp: "" + $cloneapp + "",
                webinar_desc: $("#webinar_desc").val(),
                webinar_host: $("#webinar_host").val(),
                webinar_date: $("#webinar_date").val(),
                webinar_start_time: $("#webinar_start_time").val(),
                webinar_timezone: $("#webinar_timezone").val(),
                importcode: $("#importcode").val()
            };

            $.post(ajaxurl, data,
                function (data) {
                    // alert("saved? Check");
                    window.location = "<?php echo site_url(); ?>/wp-admin/?page=<?php echo $pluginName; ?>-dashboard&id=" + data;
                });

        }

        return false;
    });

    // Create NEW App :: AUTO

    $('#createnewapp2').click(function () {

        $appname = $("#appname").val();
        $cloneapp = $("#cloneapp").val();

        if ($appname == "") {
            $("#notice_name").fadeIn("fast");
        } else {
            $("#notice_name").fadeOut("fast");

            var data = {
                action: '<?php echo $pluginName; ?>_create_auto',
                appname: "" + $appname + "",
                cloneapp: "" + $cloneapp + "",
                webinar_desc: $("#webinar_desc").val(),
                webinar_host: $("#webinar_host").val(),
                webinar_dates: $("#webinar_dates").val(),
                webinar_blocked_dates: $("#webinar_blocked_dates").val(),
                webinar_times: $("#webinar_times").val(),
                webinar_instant: $("#webinar_instant").val(),
                webinar_lang: $("#webinar_lang").val()
            };

            $.post(ajaxurl, data,
                function (data) {
                    window.location = "<?php echo site_url(); ?>/wp-admin/?page=<?php echo $pluginName; ?>-dashboard&id=" + data;
                });

        }

        return false;
    });


    // Populate AR fields

    $('.arSplit').click(function (event) {
        event.preventDefault();
        ar_extract_fields();
    });

    function ar_extract_fields() {
        if ($('#ar_code').prop('disabled'))
            return;
        $('#ar_code').prop('disabled', true);
        $.post(ajaxurl, {action: 'ar_extract_fields', form_data: $('#ar_code').val()}, function (data) {
            $('#ar_code').prop('disabled', false);
            if (data) {
                $('#ar_url').val(data.form_action);
                for (i in data.form_fields) {
                    $('#' + i).val(data.form_fields[i].name || data.form_fields[i]);
                }
                $('#ar_integration_status').show().find('.detected_service').text(data.service);
            }
        }, 'json');
    }

    function change_selects() {
        var tags = ['a', 'iframe', 'frame', 'frameset', 'script'], reg, val = $('#ar_code').val(),
            hdn = $('#arcode_hdn_div2'), formurl = $('#ar_url'), hiddenfields = $('#ar_hidden');
        formurl.val('');
        if (jQuery.trim(val) == '')
            return false;
        $('#arcode_hdn_div').html('');
        $('#arcode_hdn_div2').html('');
        for (var i = 0; i < 5; i++) {
            reg = new RegExp('<' + tags[i] + '([^<>+]*[^\/])>.*?</' + tags[i] + '>', "gi");
            val = val.replace(reg, '');

            reg = new RegExp('<' + tags[i] + '([^<>+]*)>', "gi");
            val = val.replace(reg, '');
        }
        var tmpval;
        try {
            tmpval = decodeURIComponent(val);
        } catch (err) {
            tmpval = val;
        }
        hdn.append(tmpval);
        var num = 0;
        var fname_selected = '';
        var lname_selected = '';
        var email_selected = '';
        var phone_selected = '';
        $(':text', hdn).each(function () {
            var name = $(this).attr('name'),
                fname_selected = num == '0' ? name : (num != '0' ? fname_selected : ''),
                lname_selected = num == '1' ? name : lname_selected;
            email_selected = num == '2' ? name : email_selected;
            phone_selected = num == '3' ? name : phone_selected;
            if (num == '0')
                jQuery('#ar_name').val(fname_selected);
            if (num == '1')
                jQuery('#ar_lname').val(lname_selected);
            if (num == '2')
                jQuery('#ar_email').val(email_selected);
            if (num == '3')
                jQuery('#ar_phone').val(phone_selected);
            num++;
        });
        jQuery(':input[type=hidden]', hdn).each(function () {
            jQuery('#arcode_hdn_div').append(jQuery('<input type="hidden" name="' + jQuery(this).attr('name') + '" />').val(jQuery(this).val()));
        });
        var hidden_f = jQuery('#arcode_hdn_div').html();
        formurl.val(jQuery('form', hdn).attr('action'));
        hiddenfields.val(hidden_f);
        //alert(tmpval);
        hdn.html('');

    }
    ;


    // Delete Campaign

    $('#deleteCampaign').click(function () {

        confirmation($(this));

        return false;
    });

    function confirmation($obj) {
        var answer = confirm("Are You Sure You Want To Delete This Campaign?")
        if (answer) {


            var data = {
                id: "<?php echo isset($_GET['id']) ? $_GET['id'] : ""; ?>",
                nonce: $obj.data('nonce')
            };

            var savelead = "<?php echo WEBINARIGNITION_URL ?>inc/delete_app.php";

            $.post(savelead, data,
                function (results) {
                    window.location = "<?php echo site_url(); ?>/wp-admin/admin.php?page=<?php echo $pluginName; ?>-dashboard";
                });


        }
        else {

        }
    }

    // DELETE LEAD
    $('.delete_lead').click(function () {

        $ID = $(this).attr("lead_id");
        confirmation2($ID);

        return false;
    });

    function confirmation2($LEAD) {
        var answer = confirm("Are You Sure You Want To Delete This Lead?")
        if (answer) {


            var data = {
                action: "webinarignition_delete_lead",
                id: "" + $LEAD + ""
            };

            $.post(ajaxurl, data,
                function (results) {
                    $("#table_lead_" + $LEAD).fadeOut("fast");
                });

        }
        else {

        }
    }

    // Delete Campaign

    $('#resetStats').click(function () {

        confirmation44();

        return false;
    });

    function confirmation44() {
        var answer = confirm("Are You Sure You Want To Reset ALL The View Stats For This Campaign?")
        if (answer) {


            var data = {
                action: "webinarignition_reset_stats",
                id: "<?php echo isset($_GET['id']) ? $_GET['id'] : ""; ?>"
            };

            $.post(ajaxurl, data,
                function (results) {
                    window.location = "<?php echo site_url(); ?>/wp-admin/admin.php?page=<?php echo $pluginName; ?>-dashboard&id=<?php echo isset($_GET['id']) ? $_GET['id'] : ""; ?>";
                });


        }
        else {

        }
    }

    // GS Setup
    $('.gsSetup').click(function () {

        // confirmation3();

        return false;
    });

/* The following function is never called in the code. I've commented it out because of
*   the Js error it generates (See here: https://stackoverflow.com/questions/5733275/chrome-uncaught-syntax-error-unexpected-token-illegal)
*
    function confirmation3() {
        var answer = confirm("If you don't have your webinar date & time setup, you will need to edit the schedule for the emails yourself inside of SendGrid...")
        if (answer) {

            var data = {
                action: "webinarignition_set_sg",
                name: $(".appTitle").text(),
                username: $("#gs_username").val(),
                password: $("#gs_password").val(),
                id: "<?php echo isset($_GET['id']) ? $_GET['id'] : ""; ?>",
                admin: "<?php echo get_option('admin_email'); ?>"
            };

            $.post(ajaxurl, data,
                function (results) {
                    alert("Done - You can now edit your scheduled emails inside of SendGrid");
                });

        }
        else {

        }
    }
*/
    // Image Add Media Btns

    $photoURLSelected = "";
    $photoWPEditorCheck = "";

    $('.launch_media_lib').click(function () {

        $photoURLSelected = $(this).attr("photoBox");

        tb_show('Test', 'media-upload.php?type=image&TB_iframe=true');

        return false;
    });

    window.send_to_editor = function (html) {

        imgurl = $('img', html).attr('src');

        $getHTMLEditorClass = $("#" + $photoURLSelected + "").attr("class");

        if ($getHTMLEditorClass == "wp-editor-area") {
            tinyMCE.execCommand('mceInsertContent', false, "<img src='" + imgurl + "' />");
        } else {
            // Normal Input Field
            $("#" + $photoURLSelected + "").val(imgurl);
        }

        tb_remove();
    }

    // Image Option Selector

    $('.dub_select_image').click(function () {
        // Get Data
        $ID = $(this).attr("dsID");
        $Data = $(this).attr("dsData");
        // Set Data
        $("#" + $ID + "").val($Data);
        // Set visible indicator
        $(".ds_" + $ID).removeClass("dub_select_image_selected");
        $(this).addClass("dub_select_image_selected");
        return false;
    });


// --------------------------------------------------------------------------------------



// fix :: global save
// --------------------------------------------------------------------------------------
   window.wi_saveIt = function (cbf)
   {
    pre_save();

    $(".saveIt").html("<i class='icon-save' ></i> Saving...");

    // Loop Through all WP Editors

    $(".wp-editor-wrap").each(function (index) {

        $getID = this.id; // get ID wp-ID-wrap
        $getID = $getID.replace("wp-", ""); // replace pre-fix
        $getID = $getID.replace("-wrap", ""); // replace post-fix

        if ($("#wp-" + $getID + "-wrap").hasClass("tmce-active")) {  // on Visual State

            $getContent = tinyMCE.get($getID).getContent();
            $("#" + $getID).val($getContent);

        } else { // on HTML state

            $getContent = $("#" + $getID).val();
        }

     // if ($getID.indexOf('time'))
     // { console.log($getID, $getContent); }

    }).promise().done(function () { // on complete


// fix :: YouTube video settings
// --------------------------------------------------------
   var etc = ['webinar_iframe_source', 'webinar_live_video'];
   var ifs = document.getElementById('editApp');

   for (var etn in etc)
   {
      if (typeof ifs[(etc[etn])] != "undefined")
      {
         ifs = ifs[(etc[etn])];

         var htm = ifs.value;

         if (htm.indexOf('youtube') > 0)
         {
            var obj = null;                                          // iframe object
            var div = document.createElement('div');                 // div element
            var url = null;                                          // string URL
            var add = {'rel':0, 'autoplay':1, 'start':0};            // add items to url
            var itm = null;                                          // item variable
            var ait = null;                                          // add item text
            var dlm = null;                                          // url variable deliminator

            div.innerHTML = htm;

            obj = div.getElementsByTagName('iframe')[0];
            url = obj.src;

            for (itm in add)
            {
               if (url.indexOf(itm) < 0)
               {
                  dlm = ((url.indexOf('?') < 0) ? '?' : '&');
                  ait = dlm+itm+'=';

                  url += (ait+add[itm]);
               }
            }

            ifs.value = htm.split(obj.src).join(url);
         }
      }
   }
// --------------------------------------------------------


// fix :: time format
// --------------------------------------------------------
     var frm = document.getElementById('editApp');
     var fmt = frm.time_format.value;
     var lst = [frm.auto_time_fixed, frm.auto_time_delayed];

     for (var itm in lst)
     {
        if (!lst[itm])
        { continue; }

        lst[itm].value = (function(val,fmt)
        {
           val = val.split('.').join('').toUpperCase();
           val = ((val.indexOf(' ') < 0) ? (val+' ') : val);

           var pts = (val.split(' ')[0]).split(':');
           var hrs = parseInt(((pts[0][0] == '0') ? pts[0][1] : pts[0]));
           var min = pts[1];
           var apm = ((val.indexOf('AM') > 0) ? 'AM' : ((val.indexOf('PM') > 0) ? 'PM' : false));

           if ((fmt == '12hour') && (apm == false))
           {
              apm = ((hrs > 11) ? 'PM' : 'AM');
              hrs = ((hrs > 11) ? (hrs - 12) : ((hrs < 1) ? 12 : hrs))+'';
              return hrs+':'+min+' '+apm;
           }

           if ((fmt == '24hour') && (apm !== false))
           {
              hrs = (((hrs === 12) && (apm == 'AM')) ? 0 : ((apm == 'PM') ? (hrs + 12) : hrs));
              return ((hrs < 10) ? '0' : '')+hrs+':'+min;
           }

           return val;

        }(lst[itm].value,fmt));
     }
// --------------------------------------------------------

        data = $('#editApp').serializeArray();

        $.post(ajaxurl, data,
            function (data) {

// fix :: dirty-forms :: sync (clean)
// --------------------------------------------------------
                $ = jQuery;

                $(function() {

                    $('form').areYouSure();
                    $('form.dirty-check').areYouSure();
                    $('form').areYouSure( {'message':'Your changes are not saved!'} );

                });
// --------------------------------------------------------

                // $('.saveIt').removeClass("saved");
                // $('.saveIt').addClass("blue-btn");
                $(".saveIt").html('<i class="icon-save" ></i> Save & Update');

                 if (data == "redirect") {
                     // refresh page
                     location.reload();
                 }
                 else
                 {
                    if (typeof cbf == 'function')
                    { cbf(data); }
                 }

            });

    });

    // setTimeout('wpfix()', 1000);
}
// --------------------------------------------------------------------------------------


    // Save Parts ::
      $('.saveIt').click
      (
         function(event)
         {
            event.preventDefault();
            wi_saveIt();
         }
      );

      // fix :: Update webinar date on registration page
      // --------------------------------------------------------
      // Description :: When a member changes their webinar date in the dashboard,
      // we need to update lp_webinar_month, lp_webinar_day, lp_webinar_headline on the registration page
      $('#editApp input[name=webinar_date]').change(function() {
        var dateData = {
          webinar_date: $('#editApp input[name=webinar_date]').val(),
          months: $('#editApp input[name=auto_translate_months]').val(),
          days: $('#editApp input[name=auto_translate_days]').val(),
        }

        if (dateData.webinar_date) {
          var dateArr = dateData.webinar_date.split('-');
          var year = dateArr[2], month = dateArr[0] - 1, day = dateArr[1];
          var dateObj = new Date(year, month, day);
          var monthNames = dateData.months.split(',');

          // users fill in days as follows: 'Monday, Tuesday, Wednesday, Thursday, Friday, Saturday, Sunday' but js date object expects sunday at 0
          // so lets move it to position 0 (Sunday, Monday, Tuesday, Wednesday, Thursday, Friday, Saturday)
          var daysOfWeek = dateData.days.split(',');
          var sunday = daysOfWeek.pop().trim();
          daysOfWeek.unshift(sunday);

          var dayOfMonth = dateObj.getDate();
          var dayName = daysOfWeek[dateObj.getDay()].trim();
          var monthName = monthNames[dateObj.getMonth()];
          var year = dateObj.getFullYear();


          $('#editApp input[name=lp_webinar_month]').val(monthName);
          $('#editApp input[name=lp_webinar_day]').val(dayOfMonth);

          function ordinal(d) {
            if (d > 3 && d < 21) {
                return 'th';
            }

            switch (d % 10) {
                case 1: return 'st';
                case 2: return 'nd';
                case 3: return 'rd';
                default: return 'th';
            }
          }

          var optinHeadline = dayName;
          // if language english display e.g. Tuesday The 29th
          if (sunday === 'Sunday' || sunday === 'sunday') {
              optinHeadline = dayName + ' The ' + dayOfMonth + ordinal(dayOfMonth);
          }
          $('#editApp input[name=lp_webinar_headline]').val(optinHeadline);
        }

      });


    // Tabs For Editing App
    $('.editItem').click(function () {

        $tab = $(this).attr("tab");

        $(".editItem").removeClass("editSelected");
        $(this).addClass("editSelected");

        $(".tabber").hide();
        $("#" + $tab + "").show();

        return false;
    });

    // Date Picker

    $('.dp-date').on('click', function () {

        $(this).pickadate({
            format: 'mm-dd-yyyy',
            formatSubmit: 'dd mmm, yyyy',
            today: 'Today',
            editable: true
        });

    });

    // Time Picker
    $('.dp-time').one('click', function () {

       var tfl = {'12hour':'h:i A', '24hour':'HH:i'};
       var fmt = '<?php echo isset($_GET["id"]) ? get_option("webinarignition_campaign_" . $_GET["id"])->time_format : "24hour"; ?>';

        $(this).pickatime({
            editable: false,
            format: tfl[fmt]
        });
    });


    // Color Picker

    $('.cp-picker').colorpicker().on('changeColor', function (ev)
    {
   // fix :: dirty-forms :: color-picker
   // -----------------------------------------------------
      $(this).trigger('change');
   // -----------------------------------------------------

        $color = ev.color.toHex();
        $(this).css("background-color", $color);
        $(this).val($color);

        // Convert HEX so inner text is visible (black or white)

        var bg = $color.replace("#", "");
        var rgb = bg.match(/../g);
        for (var i = 0; i < 3; ++i)
            rgb[i] = parseInt(rgb[i], 16);
        var hsv = rgbToHsv(rgb[0], rgb[1], rgb[2]);
        var fg = 'ffffff';
        if (hsv[2] > 0.8)
            fg = '000000';
        $(this).css({
            color: '#' + fg
        });

    });


    // Color Picker On Load - HEX Convert

    $(".cp-picker").each(function (index) {

        $color = $(this).val();

        if ($color == "") {
            // do nothing
        } else {

            var bg = $color.replace("#", "");
            var rgb = bg.match(/../g);
            for (var i = 0; i < 3; ++i)
                rgb[i] = parseInt(rgb[i], 16);
            var hsv = rgbToHsv(rgb[0], rgb[1], rgb[2]);
            var fg = 'ffffff';
            if (hsv[2] > 0.8)
                fg = '000000';
            $(this).css({
                color: '#' + fg
            });

        }

    });

    // Toggle Edit Section

    $('.editableSectionHeading').click(function () {

        $getID = $(this).attr("editSection");
        $("#" + $getID).slideToggle();

        $(this).toggleClass("editableSectionHeading_open");

        $(this).find(".toggleIcon").toggleClass("icon-chevron-up icon-chevron-down");

        return false;
    });

    // Option Selector
    $('.optionSelector').click(function () {

        $getID = $(this).attr("data-id");
        $getVALUE = $(this).attr("data-value");

        // Set value
        $("#" + $getID).val($getVALUE);

        // Set Selected
        $(".opts-grp-" + $getID).removeClass("optionSelectorSelected");
        $(this).addClass("optionSelectorSelected");

        // Set Icon
        $(".opts-grp-" + $getID).find("i").removeClass("icon-circle");
        $(".opts-grp-" + $getID).find("i").addClass("icon-circle-blank");
        $(this).find("i").addClass("icon-circle");

        // Set for hide / show editable areas
        $("." + $getID).hide();
        $("#" + $getID + "_" + $getVALUE).show();

        return false;
    });

    // Option Selectors - On Load
    $(".optionSelector").each(function (index) {

        // Get info
        $getID = $(this).attr("data-id");
        $getVALUE = $(this).attr("data-value");

        // Get Current value
        $getCurrent = $("#" + $getID).val();

        $("." + $getID).hide();
        $("#" + $getID + "_" + $getCurrent).show();

    });

    // Question On Load - Sort Answered - Active
    $('.questionBlock').each(function () {

        $getStatus = $(this).attr("data-q-status");
        $getID = $(this).attr("data-id");

        if ($getStatus == "live") {
            // Its an active question
            $(this).appendTo("#we_active_questions");
        } else {
            // marked as answered
            $("#markReadQ-" + $getID).hide();
            $(this).appendTo("#we_answered_questions");
        }

    });

    // Mark Q As Read
    $('.markAsReadQ').click(function () {

        $getID = $(this).attr("data-id");

        // make update on POST
        var data = {action: 'webinarignition_update_question_status', id: "" + $getID + ""};
        $.post(ajaxurl, data, function (results) {
            $("#questionBlock-" + $getID).appendTo("#we_answered_questions");
            $("#markReadQ-" + $getID).hide();
        });

        return false;
    });

    // Delete Question
    $('.deleteQ').click(function () {

        $getID = $(this).attr("data-id");

        // make update on POST
        var data = {action: 'webinarignition_delete_question', id: "" + $getID + ""};
        $.post(ajaxurl, data, function (results) {
            $("#questionBlock-" + $getID).fadeOut("fast");
        });

        return false;
    });

    // LEADS - DASHBOARD
    $('#leads').dataTable();

    $("#leads_filter").find("input").attr("placeholder", "Search Leads Here...");

    // Master Switch Settings

    $('.webinarStatus').click(function () {

        $getData = $(this).attr("data");

        $("#webinar_switch").val($getData);

        $(".webinarStatus").removeClass("webinarStatusSelected");
        $(this).addClass("webinarStatusSelected");

        return false;
    });

    // Edit URL - Show Field
    $('.editURLWE').click(function () {

        $(".weName").toggle();
        $(".weNameField").toggle();

        $getVal = $("#webinarURLName").val();
        $(".weName").text($getVal);
        $("#webinarURLName2").val($getVal);

        return false;
    });

    // Creation -- Show / Hide Based On Type
    $('#cloneapp').change(function () {

        $data = $(this).val();

        if ($data == "new") {
            // show all the bits
            $("#createToggle1").show();
            $("#createToggle2").show();
            $("#createToggle3").show();

            $(".weCreateRight").show();

            $('.weCreateLeft').width(530);

            $(".weCreateRight").animate({marginTop: '0px'}, 'fast');

            $(".weCreateTitleIconI").addClass("icon-arrow-right");
            $(".weCreateTitleIconI").removeClass("icon-arrow-down");

        } else if ($data == "auto") {
            // hide time settings...
            $("#createToggle1").hide();
            $("#createToggle2").hide();
            $("#createToggle3").hide();

            $(".weCreateRight").show();

            $('.weCreateLeft').width(530);

            // $(".weCreateRight").css("margin-top", "83px");
            $(".weCreateRight").animate({marginTop: '83px'}, 'fast');

            $(".weCreateTitleIconI").removeClass("icon-arrow-right");
            $(".weCreateTitleIconI").addClass("icon-arrow-down");

            // $(".weCreateTitleIconI").animate({ marginRight: '-303px' }, 'fast');

        } else if ($data == "import") {
            // hide side bar and change arrow
            $(".weCreateRight").hide();
            $('.weCreateLeft').animate({width: '900'}, 'fast');
            $(".weCreateTitleIconI").removeClass("icon-arrow-right");
            $(".weCreateTitleIconI").addClass("icon-arrow-down");
            $(".importArea").show();
        } else {
            // hide side bar and change arrow
            $(".weCreateRight").hide();
            $('.weCreateLeft').animate({width: '900'}, 'fast');

            $(".weCreateTitleIconI").removeClass("icon-arrow-right");
            $(".weCreateTitleIconI").addClass("icon-arrow-down");
        }

        return false;
    });

    // Timezone -- For User Reference
    var tz = jstz.determine_timezone();
    var tzname = tz.timezone.olson_tz;
    var tzoffset = tz.timezone.utc_offset;
    $(".timezoneRefZ").text(tzname);

    // Get Timezone & info
    var data = {action: 'webinarignition_get_local_tz', tz: "" + tzname + ""};
    $.post(ajaxurl, data, function (results) {
        $(".timezoneRefZ").html(results);
    });

    // Get Timezone & info -- CREATION SET
    var data = {action: 'webinarignition_get_local_tz_set', tz: "" + tzname + ""};
    $.post(ajaxurl, data, function (results) {
        $(".tzCreate").val(results);
    });

    //unlock
    $('#unlockBTN').click(function () {

        // vars
        $username = $("#unlockUsername").val();
        $key = $("#unlockKey").val();
        // loader
        $(this).html("<i class='icon-spinner icon-spin'></i>");

        var data = {action: 'webinarignition_unlock', username: "" + $username + "", key: "" + $key + ""};

        $.post(ajaxurl, data, function (results) {

            if (results == "rD") {
                location.reload();
            } else {
                $('#unlockBTN').html("Activate Plugin");
                alert(results);
            }

        });

        return false;
    });

});
</script>
