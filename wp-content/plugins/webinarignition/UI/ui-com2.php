<?php

// DISPLAY OPTIONS

function display_option_img($num, $data, $title, $id, $help, $options) {

    // Get options:

    $items = trim($items);
    $items = explode(",", $options);

    // Output HTML

    ?>

    <div class="editSection">

        <div class="inputTitle">
            <div class="inputTitleCopy"><?php echo $title; ?></div>
            <div class="inputTitleHelp"><?php echo $help; ?></div>
        </div>


        <div class="inputSection">

            <?php

            $i = 0; // Counter
            $selectedClass = "";

            foreach ($items as $item) {

                // parse value

                $item = explode("[", $item);
                $item[0] = trim($item[0]);
                $item[1] = str_replace("]", "", $item[1]);

                if ($data == "" && $i == "0") {
                    // Is First Element && Data is null
                    $selectedClass = "dub_select_image_selected";
                }

                ?>
                <div class="dub_select_image <?php echo $selectedClass; ?> <?php if ($data == $item[1]) {
                    echo "dub_select_image_selected";
                } ?> ds_<?php echo $id; ?>" dsData="<?php echo $item[1]; ?>" dsID="<?php echo $id; ?>">

                    <img src="<?php echo $item[0]; ?>"/>

                </div>
                <?php

                $i++; // add to counter
                $selectedClass = ""; // Reset Class
            }

            ?>

            <br clear="left">

            <input type='hidden' class="elem" name="<?php echo $id; ?>" id="<?php echo $id; ?>"
                   value="<?php echo $data; ?>"/>

        </div>
        <br clear="left">

    </div>

<?php
}

// DISPLAY A COLOR PICKER

function display_color($num, $data, $title, $id, $help, $placeholder) {

    // Output HTML

    ?>

    <div class="editSection">

        <div class="inputTitle">
            <div class="inputTitleCopy"><?php echo $title; ?></div>
            <div class="inputTitleHelp"><?php echo $help; ?></div>
        </div>

        <div class="inputSection ">
            <input class="inputField elem  cp-picker color-field-picker" placeholder="<?php echo $placeholder; ?>"
                   type="text" name="<?php echo $id; ?>" id="<?php echo $id; ?>"
                   value="<?php echo htmlspecialchars(stripcslashes($data)); ?>"
                   style=" background-color: <?php echo htmlspecialchars(stripcslashes($data)); ?>;">
        </div>
        <br clear="left">

    </div>

<?php
}

// DISPLAY A COLOR PICKER
function display_date($num, $data, $title, $id, $help, $placeholder) {

    // Output HTML

    ?>

    <div class="editSection">

        <div class="inputTitle">
            <div class="inputTitleCopy"><?php echo $title; ?></div>
            <div class="inputTitleHelp"><?php echo $help; ?></div>
        </div>

        <div class="inputSection ">
            <input class="inputField elem dp-date date-field-picker" placeholder="<?php echo $placeholder; ?>"
                   type="text" name="<?php echo $id; ?>" id="<?php echo $id; ?>"
                   value="<?php echo htmlspecialchars(stripcslashes($data)); ?>">
        </div>
        <br clear="left">

    </div>

<?php
}

// DISPLAY A TIME PICKER - 24hr
function display_time($num, $data, $title, $id, $help, $placeholder = '') {

    // Output HTML

    ?>

    <div class="editSection">

        <div class="inputTitle">
            <div class="inputTitleCopy"><?php echo $title; ?></div>
            <div class="inputTitleHelp"><?php echo $help; ?></div>
        </div>

        <div class="inputSection ">

            <?php if (empty($data)) $data = '18:00'; ?>
            <input class="inputField elem dp-time" placeholder="<?php echo $placeholder; ?>"
                   type="text" name="<?php echo $id; ?>" id="<?php echo $id; ?>"
                   value="<?php echo htmlspecialchars(stripcslashes($data)); ?>">

        </div>
        <br clear="left">

    </div>

<?php
}

// DISPLAY EDIT TOGLE
function display_edit_toggle_old($icon, $title, $ID) {
    ?>
    <div class="editableSectionHeading" editSection="<?php echo $ID; ?>">

        <div class="editableSectionTitle">
            <i class="icon-<?php echo $icon; ?>"></i>
            <?php echo $title; ?>
        </div>

        <div class="editableSectionToggle">
            <i class="toggleIcon  icon-chevron-down "></i>
        </div>

        <br clear="all"/>

    </div>
<?php
}

// TEST
function display_edit_toggle($icon, $title, $ID, $exta) {
    ?>
    <div class="editableSectionHeading" editSection="<?php echo $ID; ?>">

        <div class="editableSectionIcon">
            <i class="icon-<?php echo $icon; ?> icon-2x"></i>
        </div>

        <div class="editableSectionTitle">
            <?php echo $title; ?>
            <span class="editableSectionTitleSmall"><?php if ($exta == "") {
                    echo "Not Setup yet...";
                } else {
                    echo $exta;
                } ?></span>
        </div>

        <div class="editableSectionToggle">
            <i class="toggleIcon  icon-chevron-down icon-2x"></i>
        </div>

        <br clear="all"/>

    </div>
    <div class="editableSectionSep"></div>
<?php
}

// Display Info Block
function display_info($title, $info) {
    ?>
    <div class="editSection infoSection">
        <h4><i class="icon-question-sign"></i> <?php echo $title; ?></h4>

        <p><?php echo $info; ?></p>
    </div>
<?php
}

// DISPLAY EDIT TOGLE
function display_tutorial($title, $url) {
    ?>
    <div class="editableSectionHeading-help">

        <div class="editableSectionTitle">
            <i class="icon-question-sign"></i>
            <?php echo $title; ?>
        </div>

        <div class="editableSectionToggle">
            <a href="<?php echo $url; ?>" target="_blank" class="viewTutorial"><i class="icon-play-sign"></i> Watch
                Tutorial Video</a>
        </div>

        <br clear="all"/>

    </div>
<?php
}

// Display TIMEZONES
function display_timezones($num, $data, $title, $id, $help, $placeholder) {

    ?>

    <div class="editSection">

        <div class="inputTitle">
            <div class="inputTitleCopy"><?php echo $title; ?></div>
            <div class="inputTitleHelp"><?php echo $help; ?></div>
        </div>

        <div class="inputSection">

            <select name="webinar_timezone" id="webinar_timezone" class="inputField elem ">
                <option value="-12" <?php if ($data == "-12") {
                    echo "selected";
                } ?> >(UTC -12:00) Baker/Howland Island
                </option>
                <option value="-11" <?php if ($data == "-11") {
                    echo "selected";
                } ?> >(UTC -11:00) Samoa Time Zone, Niue
                </option>
                <option value="-10" <?php if ($data == "-10") {
                    echo "selected";
                } ?>>(UTC -10:00) Hawaii-Aleutian Standard Time, Cook Islands, Tahiti
                </option>
                <option value="-930" <?php if ($data == "-930") {
                    echo "selected";
                } ?> >(UTC -9:30) Marquesas Islands
                </option>
                <option value="-9" <?php if ($data == "-9") {
                    echo "selected";
                } ?> >(UTC -9:00) Alaska Standard Time, Gambier Islands
                </option>
                <option value="-8" <?php if ($data == "-8") {
                    echo "selected";
                } ?> >(UTC -8:00) Pacific Standard Time, Clipperton Island
                </option>
                <option value="-7" <?php if ($data == "-7") {
                    echo "selected";
                } ?> >(UTC -7:00) Mountain Standard Time
                </option>
                <option value="-6" <?php if ($data == "-6") {
                    echo "selected";
                } ?> >(UTC -6:00) Central Standard Time
                </option>
                <option value="-5" <?php if ($data == "-5") {
                    echo "selected";
                } else if ($data == '') {
                    echo "selected";
                } ?> >(UTC -5:00) Eastern Standard Time, Western Caribbean Standard Time
                </option>
                <option value="-430" <?php if ($data == "-430") {
                    echo "selected";
                } ?> >(UTC -4:30) Venezuelan Standard Time
                </option>
                <option value="-4" <?php if ($data == "-4") {
                    echo "selected";
                } ?> >(UTC -4:00) Atlantic Standard Time, Eastern Caribbean Standard Time
                </option>
                <option value="-330" <?php if ($data == "-330") {
                    echo "selected";
                } ?> >(UTC -3:30) Newfoundland Standard Time
                </option>
                <option value="-3" <?php if ($data == "-3") {
                    echo "selected";
                } ?> >(UTC -3:00) Argentina, Brazil, French Guiana, Uruguay
                </option>
                <option value="-2" <?php if ($data == "-2") {
                    echo "selected";
                } ?> >(UTC -2:00) South Georgia/South Sandwich Islands
                </option>
                <option value="-1" <?php if ($data == "-1") {
                    echo "selected";
                } ?> >(UTC -1:00) Azores, Cape Verde Islands
                </option>
                <option value="0" <?php if ($data == "0") {
                    echo "selected";
                } ?> >(UTC) Greenwich Mean Time, Western European Time
                </option>
                <option value="+1" <?php if ($data == "+1") {
                    echo "selected";
                } ?> >(UTC +1:00) Central European Time, West Africa Time
                </option>
                <option value="+2" <?php if ($data == "+2") {
                    echo "selected";
                } ?> >(UTC +2:00) Central Africa Time, Eastern European Time, Kaliningrad Time
                </option>
                <option value="+3" <?php if ($data == "+3") {
                    echo "selected";
                } ?> >(UTC +3:00) Moscow Time, East Africa Time
                </option>
                <option value="+330" <?php if ($data == "+330") {
                    echo "selected";
                } ?> >(UTC +3:30) Iran Standard Time
                </option>
                <option value="+4" <?php if ($data == "+4") {
                    echo "selected";
                } ?> >(UTC +4:00) Azerbaijan Standard Time, Samara Time
                </option>
                <option value="+430" <?php if ($data == "+430") {
                    echo "selected";
                } ?> >(UTC +4:30) Afghanistan
                </option>
                <option value="+5" <?php if ($data == "+5") {
                    echo "selected";
                } ?> >(UTC +5:00) Pakistan Standard Time, Yekaterinburg Time
                </option>
                <option value="+530" <?php if ($data == "+530") {
                    echo "selected";
                } ?> >(UTC +5:30) Indian Standard Time, Sri Lanka Time
                </option>
                <option value="+545" <?php if ($data == "+545") {
                    echo "selected";
                } ?> >(UTC +5:45) Nepal Time
                </option>
                <option value="+6" <?php if ($data == "+6") {
                    echo "selected";
                } ?> >(UTC +6:00) Bangladesh Standard Time, Bhutan Time, Omsk Time
                </option>
                <option value="+630" <?php if ($data == "+630") {
                    echo "selected";
                } ?> >(UTC +6:30) Cocos Islands, Myanmar
                </option>
                <option value="+7" <?php if ($data == "+7") {
                    echo "selected";
                } ?> >(UTC +7:00) Krasnoyarsk Time, Cambodia, Laos, Thailand, Vietnam
                </option>
                <option value="+8" <?php if ($data == "+8") {
                    echo "selected";
                } ?> >(UTC +8:00) Australian Western Standard Time, Beijing Time, Irkutsk Time
                </option>
                <option value="+845" <?php if ($data == "+845") {
                    echo "selected";
                } ?> >(UTC +8:45) Australian Central Western Standard Time
                </option>
                <option value="+9" <?php if ($data == "+9") {
                    echo "selected";
                } ?> >(UTC +9:00) Japan Standard Time, Korea Standard Time, Yakutsk Time
                </option>
                <option value="+930" <?php if ($data == "+930") {
                    echo "selected";
                } ?> >(UTC +9:30) Australian Central Standard Time
                </option>
                <option value="+10" <?php if ($data == "+10") {
                    echo "selected";
                } ?> >(UTC +10:00) Australian Eastern Standard Time, Vladivostok Time
                </option>
                <option value="+1030" <?php if ($data == "+1030") {
                    echo "selected";
                } ?>  >(UTC +10:30) Lord Howe Island
                </option>
                <option value="+11" <?php if ($data == "+11") {
                    echo "selected";
                } ?> >(UTC +11:00) Magadan Time, Solomon Islands, Vanuatu
                </option>
                <option value="+1130" <?php if ($data == "+1130") {
                    echo "selected";
                } ?> >(UTC +11:30) Norfolk Island
                </option>
                <option value="+12" <?php if ($data == "+12") {
                    echo "selected";
                } ?> >(UTC +12:00) Fiji, Gilbert Islands, Kamchatka Time, New Zealand Standard Time
                </option>
                <option value="+1245" <?php if ($data == "+1245") {
                    echo "selected";
                } ?> >(UTC +12:45) Chatham Islands Standard Time
                </option>
                <option value="+13" <?php if ($data == "+13") {
                    echo "selected";
                } ?> >(UTC +13:00) Phoenix Islands Time, Tonga
                </option>
                <option value="+14" <?php if ($data == "+14") {
                    echo "selected";
                } ?> >(UTC +14:00) Line Islands
                </option>
            </select>


        </div>
        <br clear="left">

    </div>

<?php

}

// Display TIMEZONES
function display_timezone_identifiers($num, $data, $title, $id, $help, $placeholder) {

    ?>

    <div class="editSection">

        <div class="inputTitle">
            <div class="inputTitleCopy"><?php echo $title; ?></div>
            <div class="inputTitleHelp"><?php echo $help; ?></div>
        </div>

        <div class="inputSection">
            <?php
            $timezone_list = timezone_identifiers_list();
            ?>
            <select name="<?php echo $id; ?>" id="<?php echo $id; ?>" class="inputField elem">
                <?php foreach ($timezone_list as $_timezone) { ?>
                    <option value="<?php echo $_timezone; ?>" <?php if ($data == $_timezone) {
                        echo "selected";
                    } ?> ><?php echo $_timezone; ?></option>
                <?php } ?>
            </select>


        </div>
        <br clear="left">

    </div>

<?php

}

// DISPLAY A TIME PICKER - 24hr
function display_time_auto($num, $data, $title, $id, $help) {

    // Output HTML

    ?>

    <div class="editSection">

        <div class="inputTitle">
            <div class="inputTitleCopy"><?php echo $title; ?></div>
            <div class="inputTitleHelp"><?php echo $help; ?></div>
        </div>

        <div class="inputSection ">

            <?php $starttimeTZ = $data; ?>
            <select name="<?php echo $id; ?>" id="<?php echo $id; ?>" class="inputField elem ">
                <option value="08:00" <?php if ($starttimeTZ == "08:00") {
                    echo "selected";
                } ?>>8:00 AM
                </option>
                <option value="08:30" <?php if ($starttimeTZ == "08:30") {
                    echo "selected";
                } ?>>8:30 AM
                </option>
                <option value="09:00" <?php if ($starttimeTZ == "09:00") {
                    echo "selected";
                } ?>>9:00 AM
                </option>
                <option value="09:30" <?php if ($starttimeTZ == "09:30") {
                    echo "selected";
                } ?>>9:30 AM
                </option>
                <option value="10:00" <?php if ($starttimeTZ == "10:00") {
                    echo "selected";
                } ?>>10:00 AM
                </option>
                <option value="10:30" <?php if ($starttimeTZ == "10:30") {
                    echo "selected";
                } ?>>10:30 AM
                </option>
                <option value="11:00" <?php if ($starttimeTZ == "11:00") {
                    echo "selected";
                } ?>>11:00 AM
                </option>
                <option value="11:30" <?php if ($starttimeTZ == "11:30") {
                    echo "selected";
                } ?>>11:30 AM
                </option>
                <option value="12:00" <?php if ($starttimeTZ == "12:00") {
                    echo "selected";
                } ?>>12:00 PM
                </option>
                <option value="12:30" <?php if ($starttimeTZ == "12:30") {
                    echo "selected";
                } ?>>12:30 PM
                </option>
                <option value="13:00" <?php if ($starttimeTZ == "13:00") {
                    echo "selected";
                } ?>>1:00 PM
                </option>
                <option value="13:30" <?php if ($starttimeTZ == "13:30") {
                    echo "selected";
                } ?>>1:30 PM
                </option>
                <option value="14:00" <?php if ($starttimeTZ == "14:00") {
                    echo "selected";
                } ?>>2:00 PM
                </option>
                <option value="14:30" <?php if ($starttimeTZ == "14:30") {
                    echo "selected";
                } ?>>2:30 PM
                </option>
                <option value="15:00" <?php if ($starttimeTZ == "15:00") {
                    echo "selected";
                } ?>>3:00 PM
                </option>
                <option value="15:30" <?php if ($starttimeTZ == "15:30") {
                    echo "selected";
                } ?>>3:30 PM
                </option>
                <option value="16:00" <?php if ($starttimeTZ == "16:00") {
                    echo "selected";
                } ?>>4:00 PM
                </option>
                <option value="16:30" <?php if ($starttimeTZ == "16:30") {
                    echo "selected";
                } ?>>4:30 PM
                </option>
                <option value="17:00" <?php if ($starttimeTZ == "17:00") {
                    echo "selected";
                } ?>>5:00 PM
                </option>
                <option value="17:30" <?php if ($starttimeTZ == "17:30") {
                    echo "selected";
                } ?>>5:30 PM
                </option>
                <option value="18:00" <?php if ($starttimeTZ == "18:00" || $starttimeTZ == "") {
                    echo "selected";
                } ?>>6:00 PM
                </option>
                <option value="18:30" <?php if ($starttimeTZ == "18:30") {
                    echo "selected";
                } ?> >6:30 PM
                </option>
                <option value="19:00" <?php if ($starttimeTZ == "19:00") {
                    echo "selected";
                } ?>>7:00 PM
                </option>
                <option value="19:30" <?php if ($starttimeTZ == "19:30") {
                    echo "selected";
                } ?>>7:30 PM
                </option>
                <option value="20:00" <?php if ($starttimeTZ == "20:00") {
                    echo "selected";
                } ?> >8:00 PM
                </option>
                <option value="20:30" <?php if ($starttimeTZ == "20:30") {
                    echo "selected";
                } ?> >8:30 PM
                </option>
                <option value="21:00" <?php if ($starttimeTZ == "21:00") {
                    echo "selected";
                } ?> >9:00 PM
                </option>
                <option value="21:30" <?php if ($starttimeTZ == "21:30") {
                    echo "selected";
                } ?>  >9:30 PM
                </option>
                <option value="22:00" <?php if ($starttimeTZ == "22:00") {
                    echo "selected";
                } ?> >10:00 PM
                </option>
                <option value="23:00" <?php if ($starttimeTZ == "23:00") {
                    echo "selected";
                } ?> >11:00 PM
                </option>
                <option value="no" <?php if ($starttimeTZ == "no") {
                    echo "selected";
                } ?> >Do Not Show This Time
                </option>
            </select>

        </div>
        <br clear="left">

    </div>

<?php
}

?>