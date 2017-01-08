<?php
// Universal Variables

$pluginName = "webinarignition";
$sitePath = WEBINARIGNITION_URL;
?>

<style type="text/css">



            #mWrapper{

                        font-family: 'Source Sans Pro', sans-serif, 'Helvectica Neue';

                        width: 981px;
                        margin-top: 20px;

                        font-smooth: always;
                        -webkit-font-smoothing: antialiased;

            }

            #mWrapper .inputField {
                        width: 100% !important;
            }

            #mLogo{
                        width: 981px;
                        height: 90px;
                        background-color: #1E1E1E;
                        background-image: url(<?php echo WEBINARIGNITION_URL; ?>images/noise.png), url(<?php echo WEBINARIGNITION_URL; ?>images/logobg.png) !important;
                        background-repeat: repeat, no-repeat;
                        background-position: top top, left bottom;
                        -webkit-border-top-left-radius: 5px;
                        -webkit-border-top-right-radius: 5px;
                        -moz-border-radius-topleft: 5px;
                        -moz-border-radius-topright: 5px;
                        border-top-left-radius: 5px;
                        border-top-right-radius: 5px;
                        border-bottom: 3px solid rgba( 0, 0, 0, .2);
            }

            .mLogoIMG{
                        float: left;
            }

            .mSupport{
                        float: right;
                        padding-right: 20px;
                        padding-top: 40px;
            }

            .mSupport a{
                        background-color: #343336;
                        background-image: url(<?php echo WEBINARIGNITION_URL; ?>images/noise.png) !important;
                        padding: 10px;
                        font-size: 14px;
                        color: #FFF;
                        text-decoration: none;
                        font-weight: bold;
                        -webkit-border-radius: 5px;
                        -moz-border-radius: 5px;
                        border-radius: 5px;
            }

            .welogo{
                        padding-top: 10px;
                        padding-left: 20px;
            }

            #mNav{
                        /*padding: 20px;*/
                        padding-left: 20px;
                        border: 1px solid black;
                        background-color: #161616;
                        background-image: url(data:image/png;charset=utf-8;base64,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);
            }

            #mNav a{
                        color: #FFF;
                        text-decoration: none;
                        font-weight: bold;
                        font-size: 14px;
                        text-shadow: 1px 1px 1px #000000;
                        filter: dropshadow(color=#000000, offx=1, offy=1);
            }

            /*#mNav a:hover{
                            color: #29a8e0;
            }*/

            .navItem{
                        float: left;
                        cursor: pointer;
                        padding: 20px;
            }

            .navItem a{
                        color: #FFF;
                        text-decoration: none;
                        font-weight: bold;
                        font-size: 14px;
                        text-shadow: 1px 1px 1px #000000;
                        filter: dropshadow(color=#000000, offx=1, offy=1);
            }

            .navItem:hover{
                        background-image: -webkit-gradient(linear, center top, center bottom, from(#282829), to(#363637));
                        background-image: -webkit-linear-gradient(top, #282829, #363637);
                        background-image: -moz-linear-gradient(top, #282829, #363637);
                        background-image: -o-linear-gradient(top, #282829, #363637);
                        background-image: -ms-linear-gradient(top, #282829, #363637);
                        background-image: linear-gradient(to bottom, #282829, #363637);
                        -webkit-text-shadow: 0 1px 0 #1e4f73;
                        -moz-text-shadow: 0 1px 0 #1e4f73;
                        text-shadow: 0 1px 0 #1e4f73;
                        border-left: 1px solid #282829;
                        border-right: 1px solid #282829;
                        padding-left: 19px;
                        padding-right: 19px;
            }

            .navSelected{
                        background-image: -webkit-gradient(linear, center top, center bottom, from(#282829), to(#363637));
                        background-image: -webkit-linear-gradient(top, #282829, #363637);
                        background-image: -moz-linear-gradient(top, #282829, #363637);
                        background-image: -o-linear-gradient(top, #282829, #363637);
                        background-image: -ms-linear-gradient(top, #282829, #363637);
                        background-image: linear-gradient(to bottom, #282829, #363637);
                        -webkit-text-shadow: 0 1px 0 #1e4f73;
                        -moz-text-shadow: 0 1px 0 #1e4f73;
                        text-shadow: 0 1px 0 #1e4f73;
                        border-left: 1px solid #282829;
                        border-right: 1px solid #282829;
                        padding-left: 19px;
                        padding-right: 19px;
            }

            #container{
                        /*background-color: #1c222a;*/
                        background-color: #353337;
                        padding: 20px;
                        padding-top: 15px;
                        background-image: url(<?php echo WEBINARIGNITION_URL; ?>images/noise.png) !important;
                        /*border-left: 1px solid #c0c2c4;*/
                        /*border-right: 1px solid #c0c2c4;*/
                        border-bottom: 5px solid #202226;
                        /*border-top: 3px solid #121315;*/
                        border-bottom-right-radius: 5px;
                        border-bottom-left-radius: 5px;
                        /*-webkit-box-shadow: inset 0 3px 3px rgba(0,0,0,0.2);
                        -moz-box-shadow: inset 0 3px 3px rgba(0,0,0,0.2);
                        box-shadow: inset 0 3px 3px rgba(0,0,0,0.2);*/
            }

            /* DASHBOARD CSS :: */

            #listapps{
                        float: left;
                        width: 715px;
                        /*background-color: #FFF;*/
                        /*border: 1px solid #c7cfd9;*/
                        border-radius: 5px;
            }

            #dashinfo{
                        float:left;
                        width:182px;
                        margin-left: 40px;
            }

            /*App Listing*/

            /*App Listing*/

            .appitem{
                        padding: 10px;
                        border-bottom: 3px solid #ECF0F1;
                        height: 56px;
            }

            .appitem:hover{
                        color: #FFF;
                        border-bottom: 3px solid #275b7e;
                        background-color: #6197ba;
            }

            .appitem:hover .ctrl-btn{
                        background-color: #34495E;
            }

            .appitem:hover .ctrl{
                        background-color: rgba(0,0,0,0.10);
            }

            .appitem:hover .ctrl2{
                        background-color: rgba(0,0,0,0.10);
            }

            .appitem:hover .appMeta{
                        color: #FFF;
                        opacity: 0.8;
            }

            .appitem:hover .appedit{
                        display: block;
            }

            #appHeader{
                        padding: 20px;
                        padding-bottom: 17px;
                        color: #FFF;
                        text-decoration: none;
                        font-weight: bold;
                        font-size: 16px;
                        /*border-top-left-radius: 6px;
                        border-top-right-radius: 6px;*/
                        /*background-color: #34495E;*/
                        text-transform: uppercase;
                        /*border-bottom: 3px solid #2C3E50;*/
            }

            .appimage{
                        float: left;
                        margin-left: 10px;
            }

            .appinfo{
                        float: left;
                        margin-left: 20px;
                        /*width: 810px;*/
            }

            .appinfo2{
                        margin-left: 20px;
                        /*width: 810px;*/
            }

            .appedit{
                        float: right;
                        margin-right: 20px;
                        /*width: 50px;*/
                        padding-top: 5px;
            }

            .appTitle{
                        font-weight: bold;
                        display: block;
                        font-size: 16px;
                        margin-top: 9px;
            }

            .appMeta{
                        color: #9d9ea0;
                        font-size: 11px;
            }

            .appnew{
                        padding-top: 20px;
                        padding-bottom: 20px;
                        padding-right: 30px;
                        border-top: 1px dashed #383736;
            }

            .newWebinarBTN{
                        background-color: #E64F1D !important;
                        border-bottom: 3px solid rgba(0, 0, 0, 0.2);
            }


            .btn a{
                        text-decoration: none;
                        /*color: #FFF;*/
            }

            .blue-btn-2{
                        float: right;
                        color: #FFF;
                        font-weight: bold;
                        font-size: 14px;
                        border-radius: 3px;
                        padding: 10px;
                        cursor: pointer;
                        background: #34495E;
                        text-decoration: none;
            }

            .blue-btn-2create{
                        margin-top: 10px;
                        text-align: center;
                        color: #FFF;
                        width: 180px;
                        font-weight: bold;
                        font-size: 16px;
                        border-radius: 3px;
                        padding: 10px;
                        cursor: pointer;
                        background: #34495E;
                        text-decoration: none;
            }
            .blue-btn-2create a{
                        color: #fff;
            }

            .blue-btn-2 i{
                        margin-right: 10px;
            }

            .blue-btn-4{
                        float: right;
                        /*color: #252e32 !impo;*/
                        font-weight: bold;
                        font-size: 14px;
                        border-radius: 3px;
                        padding: 10px;
                        cursor: pointer;
                        background: #5FA426;
                        text-decoration: none;
                        border-bottom: 2px solid rgba(0,0,0,0.10);
            }

            .blue-btn-44{
                        float: right;
                        /*color: #252e32 !impo;*/
                        font-weight: bold;
                        font-size: 14px;
                        border-radius: 3px;
                        padding: 10px;
                        cursor: pointer;
                        background: #5FA426;
                        text-decoration: none;
                        border-bottom: 2px solid rgba(0,0,0,0.10);
            }

            .blue-btn-44:hover{
                        background: #E64F1D;
            }

            .blue-btn-44 a{
                        color: #FFF !important;
            }

            .blue-btn-5{
                        color: #FFF;
                        font-weight: bold;
                        font-size: 14px;
                        border-radius: 3px;
                        padding: 10px;
                        cursor: pointer;
                        background: #34495E;
                        text-decoration: none;
            }

            .blue-btn-4 a{
                        color: #FFF;
            }

            .blue-btn-4:hover{
                        background: #E64F1D;
                        color: #FFF !important;
            }

            .blue-btn-4 i{
                        margin-right: 10px;
            }

            .blue-btn-5 a{
                        color: #FFF;
            }

            .blue-btn-5:hover{
                        background: #3E8FC7;
                        color: #FFF !important;
            }

            .blue-btn-5 i{
                        margin-right: 10px;
            }

            .blue-btn{
                        color: #FFF;
                        font-weight: bold;
                        font-size: 14px;
                        border-radius: 3px;
                        padding: 10px;
                        cursor: pointer;
                        border: 1px solid #67191d;
                        border-bottom: 1px solid #67191d;
                        background-color: #be333b;
                        background-image: -webkit-gradient(linear, center top, center bottom, from(#be333b), to(#9f252b));
                        background-image: -webkit-linear-gradient(top, #be333b, #9f252b);
                        background-image: -moz-linear-gradient(top, #be333b, #9f252b);
                        background-image: -o-linear-gradient(top, #be333b, #9f252b);
                        background-image: -ms-linear-gradient(top, #be333b, #9f252b);
                        background-image: linear-gradient(to bottom, #be333b, #9f252b);
                        -webkit-box-shadow: 0 1px 1px rgba(0,0,0,0.75), inset 0 1px 0 #b33339;
                        -moz-box-shadow: 0 1px 1px rgba(0,0,0,0.75), inset 0 1px 0 #b33339;
                        box-shadow: 0 1px 1px rgba(0,0,0,0.75), inset 0 1px 0 #b33339;
                        -webkit-text-shadow: 0 1px 0 #67191d;
                        -moz-text-shadow: 0 1px 0 #67191d;
                        text-shadow: 0 1px 0 #67191d;
            }

            .blue-btn-2 a{
                        text-decoration: none;
                        color: #FFF;
            }

            .blue-btn a{
                        text-decoration: none;
                        color: #FFF;
            }

            .blue-btn:hover{
                        border: 1px solid #191919;
                        border-bottom: 1px solid #191919;
                        background-color: #363637;
                        background-image: -webkit-gradient(linear, center top, center bottom, from(#363637), to(#282829));
                        background-image: -webkit-linear-gradient(top, #363637, #282829);
                        background-image: -moz-linear-gradient(top, #363637, #282829);
                        background-image: -o-linear-gradient(top, #363637, #282829);
                        background-image: -ms-linear-gradient(top, #363637, #282829);
                        background-image: linear-gradient(to bottom, #363637, #282829);
                        -webkit-box-shadow: 0 1px 1px rgba(0,0,0,0.75), inset 0 1px 0 #474747;
                        -moz-box-shadow: 0 1px 1px rgba(0,0,0,0.75), inset 0 1px 0 #474747;
                        box-shadow: 0 1px 1px rgba(0,0,0,0.75), inset 0 1px 0 #474747;
                        -webkit-text-shadow: 0 1px 0 #191919;
                        -moz-text-shadow: 0 1px 0 #191919;
                        text-shadow: 0 1px 0 #191919;
            }

            .black-btn{
                        color: #FFF;
                        font-weight: bold;
                        font-size: 14px;
                        border-radius: 3px;
                        padding: 10px;
                        cursor: pointer;
                        border: 1px solid #194a73;
                        border-bottom: 1px solid #085081;
                        border: 1px solid #191919;
                        border-bottom: 1px solid #191919;
                        background-color: #363637;
                        background-image: -webkit-gradient(linear, center top, center bottom, from(#363637), to(#282829));
                        background-image: -webkit-linear-gradient(top, #363637, #282829);
                        background-image: -moz-linear-gradient(top, #363637, #282829);
                        background-image: -o-linear-gradient(top, #363637, #282829);
                        background-image: -ms-linear-gradient(top, #363637, #282829);
                        background-image: linear-gradient(to bottom, #363637, #282829);
                        -webkit-box-shadow: 0 1px 1px rgba(0,0,0,0.75), inset 0 1px 0 #474747;
                        -moz-box-shadow: 0 1px 1px rgba(0,0,0,0.75), inset 0 1px 0 #474747;
                        box-shadow: 0 1px 1px rgba(0,0,0,0.75), inset 0 1px 0 #474747;
                        -webkit-text-shadow: 0 1px 0 #191919;
                        -moz-text-shadow: 0 1px 0 #191919;
                        text-shadow: 0 1px 0 #191919;
            }

            .black-btn a{
                        text-decoration: none;
                        color: #FFF;
            }

            .grey-btn{
                        font-weight: bold;
                        font-size: 14px;
                        border-radius: 3px;
                        padding: 10px;
                        cursor: pointer;
                        border: 1px solid #b9b9b9;
                        background-color: #fdfdfd;
                        background-image: -webkit-gradient(linear, center top, center bottom, from(#fdfdfd), to(#f5f5f5));
                        background-image: -webkit-linear-gradient(top, #fdfdfd, #f5f5f5);
                        background-image: -moz-linear-gradient(top, #fdfdfd, #f5f5f5);
                        background-image: -o-linear-gradient(top, #fdfdfd, #f5f5f5);
                        background-image: -ms-linear-gradient(top, #fdfdfd, #f5f5f5);
                        background-image: linear-gradient(to bottom, #fdfdfd, #f5f5f5);
                        -webkit-box-shadow: 0 1px 1px rgba(0,0,0,0.25), inset 0 1px 0 #FFF;
                        -moz-box-shadow: 0 1px 1px rgba(0,0,0,0.25), inset 0 1px 0 #FFF;
                        box-shadow: 0 1px 1px rgba(0,0,0,0.25), inset 0 1px 0 #FFF;
                        -webkit-text-shadow: 0 1px 0 #FFF;
                        -moz-text-shadow: 0 1px 0 #FFF;
                        text-shadow: 0 1px 0 #FFF;
            }

            .grey-btn:hover{
                        background-color: #FFF !important;
            }

            .grey-btn a{
                        text-decoration: none;
                        color: #372f2b;
            }

            .grey-btn2{
                        font-weight: bold;
                        font-size: 14px;
                        border-radius: 3px;
                        padding: 10px;
                        cursor: pointer;
                        background-color: #dca19b;
                        color: #FFF !important;
            }

            .grey-btn2:hover{
                        background-color: #dc4032 !important;
            }

            .grey-btn3{
                        font-weight: bold;
                        font-size: 14px;
                        border-radius: 3px;
                        padding: 10px;
                        cursor: pointer;
                        background-color: #9fd685;
                        color: #FFF !important;
                        margin-right: 15px;
            }

            .grey-btn3:hover{
                        background-color: #88a61f !important;
            }

            .grey-btn55{
                        font-weight: bold;
                        font-size: 11px;
                        border-radius: 3px;
                        padding: 5px;
                        cursor: pointer;
                        border: 1px solid #b9b9b9;
                        background-color: #fdfdfd;
                        background-image: -webkit-gradient(linear, center top, center bottom, from(#fdfdfd), to(#f5f5f5));
                        background-image: -webkit-linear-gradient(top, #fdfdfd, #f5f5f5);
                        background-image: -moz-linear-gradient(top, #fdfdfd, #f5f5f5);
                        background-image: -o-linear-gradient(top, #fdfdfd, #f5f5f5);
                        background-image: -ms-linear-gradient(top, #fdfdfd, #f5f5f5);
                        background-image: linear-gradient(to bottom, #fdfdfd, #f5f5f5);
                        -webkit-box-shadow: 0 1px 1px rgba(0,0,0,0.25), inset 0 1px 0 #FFF;
                        -moz-box-shadow: 0 1px 1px rgba(0,0,0,0.25), inset 0 1px 0 #FFF;
                        box-shadow: 0 1px 1px rgba(0,0,0,0.25), inset 0 1px 0 #FFF;
                        -webkit-text-shadow: 0 1px 0 #FFF;
                        -moz-text-shadow: 0 1px 0 #FFF;
                        text-shadow: 0 1px 0 #FFF;
            }

            .grey-btn55 i{
                        margin-right: 5px;
            }


            .ctrl-btn{
                        display: inline;
                        font-weight: bold;
                        font-size: 14px;
                        border-radius: 3px;
                        padding: 10px;
                        cursor: pointer;
                        background-color: #34495E;
                        color: #fff;
            }

            .ctrl-btn:hover{
                        background-color: #34495E;
            }

            .ctrl-btn:hover .ic{
                        color: #fff;
            }

            .ctrl-btn a{
                        text-decoration: none;
                        color: #FFF;
            }

            .ctrl{
                        display: inline;
                        font-weight: bold;
                        font-size: 14px;
                        border-radius: 3px;
                        padding: 10px;
                        background-color: rgba(0,0,0,0.03);
            }

            .ctrl:hover{
                        background-color: rgba(0,0,0,0.35);
            }

            .ctrl2{
                        display: inline;
                        font-weight: bold;
                        font-size: 14px;
                        border-radius: 3px;
                        padding: 10px;
                        background-color: rgba(0,0,0,0.03);
            }

            .ctrl2:hover{
                        background-color: rgba(0,0,0,0.35);
            }

            /*EDIT AREA*/

            .editTop{
                        color: #FFF;
                        /*padding: 10px;*/
                        /*background-color: #FFF;*/
                        /*border: 1px solid #c0c2c4;*/
            }

            .editArea{
                        padding: 20px;
                        background-color: #FFF;
                        /*border-left: 1px solid #c0c2c4;*/
                        /*border-right: 1px solid #c0c2c4;*/
                        border-bottom: 5px solid #d9d5d5;
                        border-bottom-right-radius: 5px;
                        border-bottom-left-radius: 5px;
                        -webkit-box-shadow: 0 2px 4px rgba(0,0,0,0.26);
                        -moz-box-shadow: 0 2px 4px rgba(0,0,0,0.26);
                        box-shadow: 0 2px 4px rgba(0,0,0,0.26);
            }

            .editNav{
                        background-color: #202020;
                        text-decoration: none;
                        font-size: 14px;
                        -webkit-border-top-left-radius: 5px;
                        -webkit-border-top-right-radius: 5px;
                        -moz-border-radius-topleft: 5px;
                        -moz-border-radius-topright: 5px;
                        border-top-left-radius: 5px;
                        border-top-right-radius: 5px;
                        font-weight: bold;
                        border-bottom: 3px solid #E94F1C;
                        background-image: url(<?php echo WEBINARIGNITION_URL; ?>images/noise.png) !important;
            }

            .editItem{
                        float: left;
                        cursor: pointer;
                        padding: 10px 19px;
                        font-size: 12px;
                        /*margin: 10px;*/
                        margin-bottom: 0px;
                        margin-top: 0px;
                        /*-webkit-border-top-left-radius: 5px;
                        -webkit-border-top-right-radius: 5px;
                        -moz-border-radius-topleft: 5px;
                        -moz-border-radius-topright: 5px;
                        border-top-left-radius: 5px;
                        border-top-right-radius: 5px;*/
                        text-align: center;
                        border-right: 1px dashed #3a3938;

                        color: #c5c2b7;
            }

            .editItem:last-of-type {
                        border-right: none;
            }

            .editItem2{
                        float: left;
                        cursor: pointer;
                        padding: 20px;
            }

            .editItem:hover{
                        background-color: #E94F1C;
                        background-image: url(<?php echo WEBINARIGNITION_URL; ?>images/noise.png) !important;
                        color: #f3e4de;
                        border-right: 1px dashed #E94F1C;
            }

            .editItem:hover i{
                        color: #FFF !important;
            }

            .editSelected i{
                        color: #FFF !important;
            }

            .editItem i{
                        display: block;
                        margin-bottom: 5px;
                        color: #51504e;
            }

            .editSelected{
                        background-color: #E94F1C;
                        background-image: url(<?php echo WEBINARIGNITION_URL; ?>images/noise.png) !important;
                        color: #f3e4de;
                        border-right: 1px dashed #E94F1C;
            }

            .editItemFirst{
                        -webkit-border-top-left-radius: 5px;
                        -moz-border-radius-topleft: 5px;
                        border-top-left-radius: 5px;
            }

            .editItemEnd{
                        /*-webkit-border-top-right-radius: 5px;
                        -moz-border-radius-topright: 5px;
                        border-top-right-radius: 5px;
                        padding-left: 23px;
                        padding-right: 24px;*/
            }

            .editSection{
                        padding: 20px;
                        padding-top: 30px;
                        border-bottom: 1px dotted #e4e4e4;
            }

            .inputTitle{
                        float: left;
                        font-size: 14px;
                        font-weight: bold;
                        width: 260px;
                        padding-right: 20px;
                        margin-right: 20px;
                        border-right: 1px dotted #e5e5e5;
            }

            .inputSection{
                        float: left;
                        width: 550px;
                        /*background-color: #000;*/
            }

            .inputField{

                        height: 56px !important;
                        /*padding-top: 26px !important;
                        padding-bottom: 26px !important;*/
                        line-height: 56px !important;

                        padding-left: 15px !important;
                        padding-right: 15px !important;
                        border: 1px solid #DFDFDF !important;
                        color: #333;
                        font-weight: bold;
                        width: 100%;

                        -webkit-box-shadow: 0 0 0 3px rgba(0,0,0,0.03) !important;
                        -moz-box-shadow: 0 0 0 3px rgba(0,0,0,0.03) !important;
                        box-shadow: 0 0 0 3px rgba(0,0,0,0.03) !important;

            }

            .inputFieldDash{

                        height: 32px !important;
                        line-height: 32px !important;

                        margin-top: 0px;

            }

            .inputFieldDash2{

                        height: 37px !important;
                        line-height: 37px !important;

                        margin-top: 0px;

            }

            .inputField_select{

                        height: 56px !important;
                        /*padding-top: 26px !important;
                        padding-bottom: 26px !important;*/
                        line-height: 56px !important;

                        padding-left: 15px !important;
                        padding-right: 15px !important;
                        border: 1px solid #DFDFDF !important;
                        color: #333;
                        font-weight: bold;
                        width: 100% !important;

                        -webkit-box-shadow: 0 0 0 3px rgba(0,0,0,0.03) !important;
                        -moz-box-shadow: 0 0 0 3px rgba(0,0,0,0.03) !important;
                        box-shadow: 0 0 0 3px rgba(0,0,0,0.03) !important;
            }

            .inputField:focus{
                        border-color: #e9322d !important;
            }

            .inputTextarea{
                        padding: 25px !important;
                        border: 1px solid #DFDFDF !important;
                        color: #333;
                        font-weight: bold;
                        width: 100%;
                        height: 120px;

                        -webkit-box-shadow: 0 0 0 3px rgba(0,0,0,0.03) !important;
                        -moz-box-shadow: 0 0 0 3px rgba(0,0,0,0.03) !important;
                        box-shadow: 0 0 0 3px rgba(0,0,0,0.03) !important;

            }

            .inputTextarea:focus {
                        border: 1px solid #d1b8a7 !important;
                        background-color: #ffffe9;
                        color: #6a341d;
            }

            .inputField:focus {
                        border: 1px solid #d1b8a7 !important;
                        background-color: #ffffe9;
                        color: #6a341d;

                        /*-webkit-box-shadow: 0 0 0 3px rgba(62,143,199, 1) !important;
                        -moz-box-shadow: 0 0 0 3px rgba(62,143,199, 1) !important;
                        box-shadow: 0 0 0 3px rgba(62,143,199, 1) !important;*/

            }

            .iconHelp{
                        margin-bottom: -4px;
                        margin-left: 10px;
                        cursor: help;
            }


            .titleBar{
                        margin-top: -20px;
                        margin-left: -20px;
                        margin-right: -20px;
                        padding-left: 40px;
                        padding-right: 40px;
                        padding-top: 10px;
                        padding-bottom: 15px;
                        border-bottom: 2px solid #f2efe9;
                        background-color: #FCF9F4;
                        /*background-image: url(<?php echo WEBINARIGNITION_URL; ?>images/headerbg.png), url(<?php echo WEBINARIGNITION_URL; ?>images/logowatermark.png);*/
                        /*background-repeat: repeat-x, no-repeat;*/
                        /*background-position: top, top right;*/
                        /*background-image: url(<?php echo WEBINARIGNITION_URL; ?>images/noise.png) !important;*/
                        background-image: url(<?php echo WEBINARIGNITION_URL; ?>images/watermarklogo.png), url(<?php echo WEBINARIGNITION_URL; ?>images/noise.png);
                        background-repeat: no-repeat, repeat;
                        background-position: right -70px, top;
            }

            .titleBar h2{
                        color: #393635;
                        font-size: 24px;
            }

            .titleBar p{
                        margin-top: -10px;
                        color: #484442;
            }

            .titleBarIcon{
                        float: right;
                        color: #80a1bf;
                        width: 50px;
                        /*margin-right: 10px;*/
                        padding-top: 10px;
            }

            .titleBarText{
                        float: left;
            }

            .alertIT {
                        color: #C09853;
                        padding: 8px 35px 8px 14px;
                        margin-bottom: 20px;
                        text-shadow: 0 1px 0 rgba(255, 255, 255, 0.5);
                        background-color: #FCF8E3;
                        border: 1px solid #FBEED5;
                        -webkit-border-radius: 4px;
                        -moz-border-radius: 4px;
                        border-radius: 4px;
            }

            #leads_filter input{
                        float: right;
                        /*padding: 15px;*/
                        height: 30px;
                        line-height: 30px;
                        margin-left: 10px;
                        margin-bottom: 15px;
                        /*background-image: url(http://cdn3.iconfinder.com/data/icons/woothemesiconset/16/search_button_green.png);*/
                        background-repeat: no-repeat;
                        background-position: 180px center;
                        /*background-position: 180px -48px 0;*/
                        background-image: url("<?php echo WEBINARIGNITION_URL; ?>images/search-icon.png");
            }

            #leads_length{
                        /*float: left;*/
                        margin-bottom: -24px;
            }

            #leads_paginate{
                        margin-top: -10px;
            }

            #leads_info{
                        padding-top: 10px;
            }

            #leads_length select{
                        margin-bottom: -13px;
            }

            .leads{
                        margin-top: 0px;
                        margin-left: -20px;
                        margin-right: -20px;
                        padding-top: 20px;
                        padding-right: 20px;
                        padding-left: 20px;
                        border-top: 3px solid #DDD;
            }

            .leads tr{
                        /*background-color: #000;*/
                        background-image: url("<?php echo WEBINARIGNITION_URL; ?>images/tablebg.png") !important;
                        background-repeat: repeat-x;
                        background-position: top;
            }

            .leads tr .odd{
                        /*background-color: #000;*/
                        background-image: url("<?php echo WEBINARIGNITION_URL; ?>images/tablebg.png") !important;
                        background-repeat: repeat-x;
                        background-position: top;
            }

            .leads tr:nth-child(2n+1){
                        background-color: #daf0ff !important;
            }

            .leads th{
                        padding-top: 10px;
                        padding-bottom: 10px;
                        color: #385D79;
                        border-bottom: 3px solid #a6d4f2;
                        background-color: #daf0ff;
                        background-image: url(<?php echo WEBINARIGNITION_URL; ?>images/headerbg.png);
                        background-repeat: repeat-x;
                        background-position: top;
            }

            .leads tr:hover,
            .leads tr .odd:hover{
                        color: #385D79;
                        /*font-weight: bold;*/
                        background-color: #daf0ff;
                        background-image: url(<?php echo WEBINARIGNITION_URL; ?>images/headerbg.png) !important;
                        background-repeat: repeat-x !important;
                        background-position: top;
            }
            #leads_info{
                        float: left;
                        margin-bottom: 0px;
                        color: #959595;
            }
            #leads_paginate{
                        float: right;
                        /*margin-bottom: 20px;*/
                        margin-top: 10px;
            }
            .paginate_disabled_previous {
                        font-weight: bold;
                        font-size: 14px;
                        border-radius: 3px;
                        padding: 10px;
                        cursor: pointer;
                        border: 1px solid #dbdbdb;
                        background-color: #fdfdfd;
                        background-image: -webkit-gradient(linear, center top, center bottom, from(#fdfdfd), to(#f5f5f5));
                        background-image: -webkit-linear-gradient(top, #fdfdfd, #f5f5f5);
                        background-image: -moz-linear-gradient(top, #fdfdfd, #f5f5f5);
                        background-image: -o-linear-gradient(top, #fdfdfd, #f5f5f5);
                        background-image: -ms-linear-gradient(top, #fdfdfd, #f5f5f5);
                        background-image: linear-gradient(to bottom, #fdfdfd, #f5f5f5);
                        -webkit-box-shadow: 0 1px 1px rgba(0,0,0,0.25), inset 0 1px 0 #FFF;
                        -moz-box-shadow: 0 1px 1px rgba(0,0,0,0.25), inset 0 1px 0 #FFF;
                        box-shadow: 0 1px 1px rgba(0,0,0,0.25), inset 0 1px 0 #FFF;
                        -webkit-text-shadow: 0 1px 0 #FFF;
                        -moz-text-shadow: 0 1px 0 #FFF;
                        text-shadow: 0 1px 0 #FFF;
                        text-decoration: none;
                        color: #828989;
            }

            .paginate_disabled_previous:hover {
                        color: #828989;
            }

            .paginate_enabled_previous{
                        font-weight: bold;
                        font-size: 14px;
                        border-radius: 3px;
                        padding: 10px;
                        cursor: pointer;
                        border: 1px solid #b9b9b9;
                        background-color: #fdfdfd;
                        background-image: -webkit-gradient(linear, center top, center bottom, from(#fdfdfd), to(#f5f5f5));
                        background-image: -webkit-linear-gradient(top, #fdfdfd, #f5f5f5);
                        background-image: -moz-linear-gradient(top, #fdfdfd, #f5f5f5);
                        background-image: -o-linear-gradient(top, #fdfdfd, #f5f5f5);
                        background-image: -ms-linear-gradient(top, #fdfdfd, #f5f5f5);
                        background-image: linear-gradient(to bottom, #fdfdfd, #f5f5f5);
                        -webkit-box-shadow: 0 1px 1px rgba(0,0,0,0.25), inset 0 1px 0 #FFF;
                        -moz-box-shadow: 0 1px 1px rgba(0,0,0,0.25), inset 0 1px 0 #FFF;
                        box-shadow: 0 1px 1px rgba(0,0,0,0.25), inset 0 1px 0 #FFF;
                        -webkit-text-shadow: 0 1px 0 #FFF;
                        -moz-text-shadow: 0 1px 0 #FFF;
                        text-shadow: 0 1px 0 #FFF;
                        text-decoration: none;
                        color: #372f2b;
            }

            .paginate_disabled_next {
                        margin-left: 15px;
                        font-weight: bold;
                        font-size: 14px;
                        border-radius: 3px;
                        padding: 10px;
                        cursor: pointer;
                        border: 1px solid #dbdbdb;
                        background-color: #fdfdfd;
                        background-image: -webkit-gradient(linear, center top, center bottom, from(#fdfdfd), to(#f5f5f5));
                        background-image: -webkit-linear-gradient(top, #fdfdfd, #f5f5f5);
                        background-image: -moz-linear-gradient(top, #fdfdfd, #f5f5f5);
                        background-image: -o-linear-gradient(top, #fdfdfd, #f5f5f5);
                        background-image: -ms-linear-gradient(top, #fdfdfd, #f5f5f5);
                        background-image: linear-gradient(to bottom, #fdfdfd, #f5f5f5);
                        -webkit-box-shadow: 0 1px 1px rgba(0,0,0,0.25), inset 0 1px 0 #FFF;
                        -moz-box-shadow: 0 1px 1px rgba(0,0,0,0.25), inset 0 1px 0 #FFF;
                        box-shadow: 0 1px 1px rgba(0,0,0,0.25), inset 0 1px 0 #FFF;
                        -webkit-text-shadow: 0 1px 0 #FFF;
                        -moz-text-shadow: 0 1px 0 #FFF;
                        text-shadow: 0 1px 0 #FFF;
                        text-decoration: none;
                        color: #828989;
            }

            .paginate_disabled_next:hover {
                        color: #828989;
            }

            .paginate_enabled_next{
                        margin-left: 15px;
                        font-weight: bold;
                        font-size: 14px;
                        border-radius: 3px;
                        padding: 10px;
                        cursor: pointer;
                        border: 1px solid #b9b9b9;
                        background-color: #fdfdfd;
                        background-image: -webkit-gradient(linear, center top, center bottom, from(#fdfdfd), to(#f5f5f5));
                        background-image: -webkit-linear-gradient(top, #fdfdfd, #f5f5f5);
                        background-image: -moz-linear-gradient(top, #fdfdfd, #f5f5f5);
                        background-image: -o-linear-gradient(top, #fdfdfd, #f5f5f5);
                        background-image: -ms-linear-gradient(top, #fdfdfd, #f5f5f5);
                        background-image: linear-gradient(to bottom, #fdfdfd, #f5f5f5);
                        -webkit-box-shadow: 0 1px 1px rgba(0,0,0,0.25), inset 0 1px 0 #FFF;
                        -moz-box-shadow: 0 1px 1px rgba(0,0,0,0.25), inset 0 1px 0 #FFF;
                        box-shadow: 0 1px 1px rgba(0,0,0,0.25), inset 0 1px 0 #FFF;
                        -webkit-text-shadow: 0 1px 0 #FFF;
                        -moz-text-shadow: 0 1px 0 #FFF;
                        text-shadow: 0 1px 0 #FFF;
                        text-decoration: none;
                        color: #372f2b;
            }

            .delete_lead{
                        cursor: pointer;
            }


            .alertIT2 {
                        color: #3e3e3f;
                        padding: 8px 35px 8px 14px;
                        margin-bottom: 20px;
                        text-shadow: 0 1px 0 rgba(255, 255, 255, 0.5);
                        background-color: #f2f2f2;
                        -webkit-border-radius: 4px;
                        -moz-border-radius: 4px;
                        border-radius: 4px;
            }

            #chooseapp{
                        padding: 10px;
                        margin-top: 5px;
                        background-color: #f3f8fc;
                        border: 3px solid #c3dfed;
                        -webkit-border-radius: 10px;
                        border-radius: 10px;
            }

            #chooseapp img{
                        padding: 10px;
                        cursor: pointer;
            }

            .choosenapp{
                        padding: 4px;
                        background-color: #22649b;
                        /*border: 3px solid #c3dfed;*/
                        -webkit-border-radius: 10px;
                        border-radius: 10px;
            }

            .choosenapp span{
                        color: #FFF;
            }


            .appselect{
                        padding: 4px;
                        float: left;
                        text-align: center;
            }

            .appselect img{
                        display: block;
            }

            .appname{
                        font-weight: bold;
            }

            .ex-tooltip{
                        position: absolute;
                        background-color: #000;
                        color: #FFF;
            }

            .stat{
                        float: left;
                        width: 398px;
                        height: 90px;
                        text-align: center;
                        background-color: #f2f2f2;
                        padding: 20px;
                        -webkit-border-radius: 10px;
                        -moz-border-radius: 10px;
                        border-radius: 10px;
            }

            .stat:hover{
                        background-color: #fbfbfb;
            }

            .stat_number{
                        display: block;
                        font-size: 30px;
                        font-weight: bold;
                        padding-top: 25px;
            }

            .stat_title{
                        display: block;
                        padding-top: 15px;
                        font-size: 12px;
                        font-weight: bold;
                        color: #4e4e4e;
            }

            .dub_select_image{
                        float: left;
                        cursor: pointer;
                        /*background-color: #f4f4f4;*/
                        /*border: 2px solid #ffffff;*/
                        border-radius: 5px;
                        -webkit-box-shadow: 0 1px 5px rgba(0,0,0,0.29);
                        -moz-box-shadow: 0 1px 5px rgba(0,0,0,0.29);
                        box-shadow: 0 1px 5px rgba(0,0,0,0.29);
                        margin-right: 25px;
            }

            .dub_select_image:hover{
                        background-color: #E54E1C;
            }

            .dub_select_image:nth-child(3){
                        margin-top: 25px;
            }

            .dub_select_image img{
                        /*padding-left: 15px;
                        padding-right: 15px;
                        padding-top: 15px;
                        padding-bottom: 12px;*/
                        padding: 3px;
                        width: 240px;
            }

            .dub_select_image_selected{
                        float: left;
                        background-color: #E54E1C;
                        border-radius: 5px;
                        -webkit-box-shadow: 0 1px 5px rgba(0,0,0,0.29);
                        -moz-box-shadow: 0 1px 5px rgba(0,0,0,0.29);
                        box-shadow: 0 1px 5px rgba(0,0,0,0.29);
            }

            .color-field-picker{
                        background-image: url(<?php echo WEBINARIGNITION_URL; ?>images/color.png) !important;
                        background-position: right center;
                        background-repeat: no-repeat;
            }

            .date-field-picker{
                        background-image: url(<?php echo WEBINARIGNITION_URL; ?>images/date.png) !important;
                        background-position: right center;
                        background-repeat: no-repeat;
            }

            .color-addon{
                        margin-top: 1px !important;
                        text-align: center;
                        background-color: #efeef5 !important;
                        width: 40px !important;
                        height: 44px !important;
                        border-top: 2px solid #DFDFDF !important;
                        border-bottom: 2px solid #DFDFDF !important;
                        border-right: 2px solid #DFDFDF !important;
                        border-left: 0px !important;
                        -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075) !important;
                        -moz-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075) !important;
                        box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075) !important;
                        -webkit-transition: border linear .2s, box-shadow linear .2s !important;
            }

            /*EDITING TOP SECTIONS*/
            .editableSectionHeading{
                        color: #F0EDE2;
                        padding-top: 20px;
                        padding-bottom: 20px;
                        margin-left: -20px;
                        margin-right: -20px;
                        padding-left: 30px;
                        padding-right: 30px;
                        font-weight: bold;
                        font-size: 16px;

                        /*border-bottom: 3px solid rgba(0,0,0,0.10);*/
                        /*border-top: 1px solid rgba(0,0,0,0.10);*/

                        cursor: pointer;

                        background-color: #212121;
                        /*background-image: -webkit-gradient(linear, center top, center bottom, from(#252e3b), to(#1B2129));
                        background-image: -webkit-linear-gradient(top, #252e3b, #1B2129);
                        background-image: -moz-linear-gradient(top, #252e3b, #1B2129);
                        background-image: -o-linear-gradient(top, #252e3b, #1B2129);
                        background-image: -ms-linear-gradient(top, #252e3b, #1B2129);
                        background-image: linear-gradient(to bottom, #252e3b, #1B2129);*/

                        /*background-color: #252525;
                        background-image: -webkit-gradient(linear, center top, center bottom, from(#323232), to(#252525));
                        background-image: -webkit-linear-gradient(top, #323232, #252525);
                        background-image: -moz-linear-gradient(top, #323232, #252525);
                        background-image: -o-linear-gradient(top, #323232, #252525);
                        background-image: -ms-linear-gradient(top, #323232, #252525);
                        background-image: linear-gradient(to bottom, #323232, #252525);*/

                        /*background-color: #242424;
                        background-image: -webkit-gradient(linear, center top, center bottom, from(#2a2a2a), to(#242424));
                        background-image: -webkit-linear-gradient(top, #2a2a2a, #242424);
                        background-image: -moz-linear-gradient(top, #2a2a2a, #242424);
                        background-image: -o-linear-gradient(top, #2a2a2a, #242424);
                        background-image: -ms-linear-gradient(top, #2a2a2a, #242424);
                        background-image: linear-gradient(to bottom, #2a2a2a, #242424);
                        */

                        background-image: url(<?php echo WEBINARIGNITION_URL; ?>images/noise.png) !important;

            }

            .dashHeaderListing{
                        color: #a39f98 !important;
                        background-image: url(<?php echo WEBINARIGNITION_URL; ?>images/noise.png) !important;
                        padding-bottom: 25px;
                        padding-top: 25px;
                        background-color: #1F1F1F !important;
                        text-shadow: 2px 2px 1px rgba(0,0,0,0.20);
                        border-bottom: 3px solid rgba(0,0,0,0.20);
                        -webkit-border-top-left-radius: 5px;
                        -webkit-border-top-right-radius: 5px;
                        -moz-border-radius-topleft: 5px;
                        -moz-border-radius-topright: 5px;
                        border-top-left-radius: 5px;
                        border-top-right-radius: 5px;
            }

            .dashList{
                        background-color: #1F1F1F !important;
                        background-image: url(<?php echo WEBINARIGNITION_URL; ?>images/noise.png) !important;
                        border-bottom: 3px solid rgba(0,0,0,0.20) !important;
            }

            .editableSectionHeading:nth-child(even){
                        background-color: #252525;
            }

            .editableSectionSep{
                        height: 1px;
                        /*border-bottom: 1px dotted #161b22;*/
                        background-color: #2d2d2d;
                        margin-right: -30px;
                        margin-left: -20px;
                        width: 941px;
            }

            .editableSectionHeading2{
                        color: #FFF;
                        padding-top: 20px;
                        padding-bottom: 20px;
                        margin-left: -20px;
                        margin-right: -20px;
                        padding-left: 30px;
                        padding-right: 30px;
                        font-weight: bold;
                        font-size: 16px;

                        border-bottom: 3px solid rgba(0,0,0,0.10);
                        border-top: 3px solid rgba(0,0,0,0.10);

                        /*cursor: pointer;*/

                        background-color: #252c39;
                        /*background-image: -webkit-gradient(linear, center top, center bottom, from(#252e3b), to(#1B2129));
                        background-image: -webkit-linear-gradient(top, #252e3b, #1B2129);
                        background-image: -moz-linear-gradient(top, #252e3b, #1B2129);
                        background-image: -o-linear-gradient(top, #252e3b, #1B2129);
                        background-image: -ms-linear-gradient(top, #252e3b, #1B2129);
                        background-image: linear-gradient(to bottom, #252e3b, #1B2129);*/

            }

            .editableSectionHeading:hover{
                        /*background-color: #3E8FC7;
                        background-image: -webkit-gradient(linear, center top, center bottom, from(#439ad9), to(#3a85ba));
                        background-image: -webkit-linear-gradient(top, #439ad9, #3a85ba);
                        background-image: -moz-linear-gradient(top, #439ad9, #3a85ba);
                        background-image: -o-linear-gradient(top, #439ad9, #3a85ba);
                        background-image: -ms-linear-gradient(top, #439ad9, #3a85ba);
                        background-image: linear-gradient(to bottom, #439ad9, #3a85ba);*/
                        color: #FFF;
                        background-color: #121212;
                        /*background-image: -webkit-gradient(linear, center top, center bottom, from(#161a1d), to(#161a1d));
                        background-image: -webkit-linear-gradient(top, #161a1d, #161a1d);
                        background-image: -moz-linear-gradient(top, #161a1d, #161a1d);
                        background-image: -o-linear-gradient(top, #161a1d, #161a1d);
                        background-image: -ms-linear-gradient(top, #161a1d, #161a1d);
                        background-image: linear-gradient(to bottom, #161a1d, #161a1d);*/

            }

            .editableSectionHeading_open{
                        /*background-color: #3E8FC7;
                        background-image: -webkit-gradient(linear, center top, center bottom, from(#439ad9), to(#3a85ba));
                        background-image: -webkit-linear-gradient(top, #439ad9, #3a85ba);
                        background-image: -moz-linear-gradient(top, #439ad9, #3a85ba);
                        background-image: -o-linear-gradient(top, #439ad9, #3a85ba);
                        background-image: -ms-linear-gradient(top, #439ad9, #3a85ba);
                        background-image: linear-gradient(to bottom, #439ad9, #3a85ba);*/
                        color: #FFF;
                        background-color: #121212 !important;
                        /*background-image: -webkit-gradient(linear, center top, center bottom, from(#161a1d), to(#161a1d));
                        background-image: -webkit-linear-gradient(top, #161a1d, #161a1d);
                        background-image: -moz-linear-gradient(top, #161a1d, #161a1d);
                        background-image: -o-linear-gradient(top, #161a1d, #161a1d);
                        background-image: -ms-linear-gradient(top, #161a1d, #161a1d);
                        background-image: linear-gradient(to bottom, #161a1d, #161a1d);*/
            }

            .editableSectionHeading-help{
                        color: #a7472a;
                        padding-top: 20px;
                        padding-bottom: 20px;
                        margin-left: -20px;
                        margin-right: -20px;
                        padding-left: 30px;
                        padding-right: 30px;
                        font-weight: bold;
                        font-size: 16px;

                        /*border-bottom: 1px solid rgba(0,0,0,0.10);*/
                        /*border-top: 1px solid rgba(0,0,0,0.10);*/

                        cursor: pointer;

                        background-color: #FEEAAD !important;

                        /*background-image: url(<?php echo WEBINARIGNITION_URL; ?>images/headerbg.png);
                        background-repeat: repeat-x;
                        background-position: top;*/

                        -webkit-box-shadow: inset 0 0 13px 1px rgba(255,255,255,0.31);
                        -moz-box-shadow: inset 0 0 13px 1px rgba(255,255,255,0.31);
                        box-shadow: inset 0 0 13px 1px rgba(255,255,255,0.31);

            }

            .editableSectionIcon{
                        float: left;
                        width: 35px;
                        text-align: center;
                        background-color: rgba(0, 0, 0, .25);
                        margin: -20px;
                        margin-left: -30px;
                        padding: 20px;
                        /*color: rgba(0, 0, 0, .50);*/
                        color: #51504E;
            }

            .editableSectionHeading:hover .editableSectionIcon{
                        background-color: #E64F1D;
                        color: #EFE0DB;
            }

            .editableSectionHeading_open .editableSectionIcon{
                        background-color: #E64F1D;
                        color: #EFE0DB;
            }

            .editableSectionTitle{
                        float: left;
                        text-shadow: 1px 1px 0px rgba(0,0,0,0.30);
                        filter: dropshadow(color=rgba(0,0,0,0.30), offx=1, offy=1);
                        margin-top: -20px;
                        margin-bottom: -20px;
                        margin-left: 20px;
                        /*margin-left: -30px;*/
                        padding: 20px;
                        border-left: 1px dotted rgba(255,255,255, .05);
            }

            .editableSectionTitleDash{
                        width: 765px;
            }

            .editableSectionTitleSmall{
                        display: block;
                        font-size: 12px;
                        font-weight: normal;
                        color: rgba(255,255,255, .55);
            }

            .editableSectionHeading-help .editableSectionTitle{
                        float: left;
                        text-shadow: 1px 1px 0px rgba(255,255,255,0.30);
                        filter: dropshadow(color=rgba(255,255,255,0.30), offx=1, offy=1);
            }

            .editableSectionTitle i{
                        margin-right: 10px;
                        width: 24px;
            }

            .editableSectionToggle{
                        float: right;
                        /*color: rgba(0,0,0,0.50);*/
                        color: #51504E;
                        font-size: 16px;
                        background-color: rgba(0, 0, 0, .10);
                        margin: -20px;
                        margin-right: -30px;
                        padding: 20px;
            }

            .editableSectionHeading:hover .editableSectionToggle{
                        /*color: #FFF;*/
                        color: #555451;
            }

            .editableSectionHeading_open .editableSectionToggle{
                        color: #555451;
            }

            .inputTitleCopy{
                        color: #303030;
                        margin-bottom: 10px;
            }

            .inputTitleHelp{
                        font-weight: normal;
                        color: #747474;
                        font-size: 12px;
            }

            .we_edit_area{
                        display: none;
                        border-top: 3px solid rgba(0,0,0,0.05);
                        border-bottom: 3px solid rgba(0,0,0,0.05);
                        padding-bottom: 20px;
                        margin-left: -20px;
                        margin-right: -20px;
                        padding-left: 20px;
                        padding-right: 20px;
            }

            .bottomSaveArea{
                        border-top: 4px solid rgba(0,0,0,0.10);
                        padding-bottom: 30px;
                        padding-top: 30px;
                        margin-left: -20px;
                        margin-right: -20px;
                        padding-left: 20px;
                        padding-right: 20px;
            }

            .optionSelector{
                        font-size: 16px;
                        text-decoration: none;
                        font-weight: bold;
                        background-color: #F4F4F4;
                        padding: 10px;
                        margin-right: 10px;
                        -webkit-border-radius: 6px;
                        -moz-border-radius: 6px;
                        border-radius: 6px;
                        color: #3a3a3a;
                        border: 2px solid rgba(0,0,0,0.05);
                        border-bottom: 4px solid rgba(0,0,0,0.10);
            }

            .optionSelector i{
                        margin-right: 5px;
            }

            .optionSelectorSelected{
                        background-color: #E64F1D;
                        color: #FFF;
                        text-shadow: 1px 1px 0px rgba(0,0,0,0.20);
                        filter: dropshadow(color=rgba(0,0,0,0.20), offx=1, offy=1);
            }

            .optionSelector:hover{
                        background-color: #E64F1D;
                        color: #FFF;
                        text-shadow: 1px 1px 0px rgba(0,0,0,0.20);
                        filter: dropshadow(color=rgba(0,0,0,0.20), offx=1, offy=1);
            }

            .appactionz{
                        float: right;
            }

            .infoSection{
                        margin-top: 20px;
                        background-color: #f6f6f6;
                        border: 1px dashed #dddddd;
                        border-bottom: 3px solid #d3d3d3;
                        padding-top: 15px;
                        background-image: url(<?php echo WEBINARIGNITION_URL; ?>images/watermarklogo.png), url(<?php echo WEBINARIGNITION_URL; ?>images/noise.png);
                        background-repeat: no-repeat, repeat;
                        background-position: right -20px, top;
                        -webkit-border-radius: 5px;
                        -moz-border-radius: 5px;
                        border-radius: 5px;
                        text-shadow: 1px 1px 0px #ffffff;
                        filter: dropshadow(color=#ffffff, offx=1, offy=1);
            }

            .infoSection h4{
                        font-size: 16px;
                        color: #363636;
            }

            .infoSection i{
                        margin-right: 5px;
            }

            .infoSection p{
                        font-size: 12px;
                        margin-top: -8px;
                        color: #616161;
                        width: 500px;
            }

            .viewTutorial{
                        padding: 5px;
                        font-size: 12px;
                        background-color: #A7472A;
                        color: #FFF;
                        text-shadow: 1px 1px 0px rgba(0,0,0,0.20);
                        filter: dropshadow(color=rgba(0,0,0,0.20), offx=1, offy=1);
                        -webkit-border-radius: 6px;
                        -moz-border-radius: 6px;
                        border-radius: 6px;
                        text-decoration: none;
            }
            .viewTutorial i{
                        margin-right: 5px;
            }

            .viewTutorial:hover{
                        color: #FFF;
                        background-color: #c14321;
            }

            .questionBlock{
                        background-color: #F6F6F6;
                        padding: 15px;
                        -webkit-border-radius: 6px;
                        -moz-border-radius: 6px;
                        border-radius: 6px;
                        border: 1px dashed rgba(0,0,0,0.20);
                        margin-top: 15px;
            }
            .questionBlockTitle{
                        font-size: 16px;
                        padding-bottom: 10px;
                        margin-bottom: 15px;
                        border-bottom: 1px dashed rgba(0,0,0,0.20);
            }

            .statsDashbord{
                        margin-left: -20px;
                        margin-right: -20px;
                        padding-left: 20px;
                        padding-right: 20px;
                        margin-bottom: -16px;
                        padding-bottom: 20px;
                        background-color: #6EBE42;
                        border-top: 3px solid rgba(0,0,0,0.20);
                        border-bottom: 3px solid rgba(0,0,0,0.20);
                        background-image: url(<?php echo WEBINARIGNITION_URL; ?>images/statsbg.png);
                        background-repeat: no-repeat;
                        background-position: 180px top;
            }

            .masterSwitch{
                        margin-left: -20px;
                        margin-right: -20px;
                        padding-left: 20px;
                        padding-right: 20px;
                        /*padding-top: 20px;*/
                        padding-bottom: 20px;
                        /*margin-bottom: -16px;*/
                        padding-bottom: 20px;
                        /*background-color: #161B21;*/
                        border-top: 3px solid rgba(0,0,0,0.05);
                        border-bottom: 3px solid rgba(0,0,0,0.05);
            }

            .masterSwitchTitle{
                        font-size: 18px;
                        font-weight: bold;
                        color: #FFF;
                        text-shadow: 2px 2px 1px rgba(0,0,0,0.20);
                        filter: dropshadow(color=rgba(0,0,0,0.20), offx=2, offy=2);
            }

            .statsDashBlock{
                        float: left;
                        padding-top: 25px;
                        width: 220px;
                        text-align: center;
            }

            .statsDashBlockNumber{
                        color: #FFF;
                        font-size: 32px;
                        font-weight: bold;
                        margin-bottom: 10px;
                        text-shadow: 2px 2px 1px rgba(0,0,0,0.20);
                        filter: dropshadow(color=rgba(0,0,0,0.20), offx=2, offy=2);
            }

            .statsDashBlockTag{
                        color: #21410c;
                        font-size: 12px;
                        font-weight: bold;
            }

            .helpcreate{
                        color: #a1b0c8;
            }

            .createTitle{
                        font-size: 16px;
                        font-weight: bold;
                        margin-bottom: 15px;
            }

            .apptopIcon{
                        float: left;
                        color: #51504E;
                        background-color: #202020;
                        padding-left: 10px;
                        padding-right: 10px;
                        border-radius: 6px;
                        margin-top: 4px;
                        margin-bottom: -5px;
                        padding-top: 5px;
                        padding-bottom: 5px;
                        /*width: 40px;*/
            }

            .apptopTitle{
                        float: left;
                        margin-left: 15px;
            }

            .weDashLeft{
                        float: left;
                        width: 530px;
                        margin-top: 20px;
                        margin-right: 20px;
                        /*background-color: #DDD;*/
            }

            .weDashRight{
                        float: left;
                        margin-top: 20px;
                        width: 350px;
                        /*border: 1px solid #C6C3C3;*/
                        border-radius: 5px;
            }

            .weDashDateTitle{
                        /*font-size: 16px;*/
                        /*font-weight: bold;*/
                        border-top: 1px solid #C49862;
                        border-left: 1px solid #C49862;
                        border-right: 1px solid #C49862;
                        border-bottom: 3px solid #C49862;
                        color: #5A3410;
                        padding: 15px;
                        background-color: #F4BA6A;
                        background-image: url(<?php echo WEBINARIGNITION_URL; ?>images/noise.png) !important;
                        /*background-image: -webkit-gradient(linear, center top, center bottom, from(#f8ddaa), to(#f4ba6a));
                        background-image: -webkit-linear-gradient(top, #f8ddaa, #f4ba6a);
                        background-image: -moz-linear-gradient(top, #f8ddaa, #f4ba6a);
                        background-image: -o-linear-gradient(top, #f8ddaa, #f4ba6a);
                        background-image: -ms-linear-gradient(top, #f8ddaa, #f4ba6a);
                        background-image: linear-gradient(to bottom, #f8ddaa, #f4ba6a);*/

                        -webkit-border-top-left-radius: 5px;
                        -webkit-border-top-right-radius: 5px;
                        -moz-border-radius-topleft: 5px;
                        -moz-border-radius-topright: 5px;
                        border-top-left-radius: 5px;
                        border-top-right-radius: 5px;

                        /*-webkit-box-shadow: inset 0 1px 1px #ccb68d;
                        -moz-box-shadow: inset 0 1px 1px #ccb68d;
                        box-shadow: inset 0 1px 1px #ccb68d;*/
            }

            .weDashDateInner{
                        background-color: #F7F5F5;
                        background-image: url(<?php echo WEBINARIGNITION_URL; ?>images/noise.png) !important;
                        border-left: 1px solid #D5DBE0;
                        border-right: 1px solid #D5DBE0;
                        border-bottom: 1px solid #D5DBE0;
                        -webkit-border-bottom-right-radius: 5px;
                        -webkit-border-bottom-left-radius: 5px;
                        -moz-border-radius-bottomright: 5px;
                        -moz-border-radius-bottomleft: 5px;
                        border-bottom-right-radius: 5px;
                        border-bottom-left-radius: 5px;
            }

            .weDashWebinarInner{
                        background-color: #FAF7F2;
                        background-image: url(<?php echo WEBINARIGNITION_URL; ?>images/noise.png) !important;
                        border-left: 1px solid #51504E;
                        border-right: 1px solid #51504E;
                        border-bottom: 1px solid #51504E;
                        -webkit-border-bottom-right-radius: 5px;
                        -webkit-border-bottom-left-radius: 5px;
                        -moz-border-radius-bottomright: 5px;
                        -moz-border-radius-bottomleft: 5px;
                        border-bottom-right-radius: 5px;
                        border-bottom-left-radius: 5px;
                        padding: 15px;
            }

            .weDashSection{
                        padding: 15px;
                        border-bottom: 1px dashed #E5D6D6;
            }

            .weDashSectionIcon{
                        float: right;
                        color: #979595;
            }

            .weDashSection:nth-child(even){
                        background-color: #f9f6f6;
            }

            .weDashSectionTitle{
                        display: block;
                        font-size: 14px;
                        font-weight: bold;
                        color: #484747;
            }

            .weDashSectionSubTitle{
                        font-weight: normal;
                        color: #706e6e;
            }

            .weDashWebinarTitle{
                        background-color: #333235;
                        padding: 15px;
                        -webkit-border-top-left-radius: 5px;
                        -webkit-border-top-right-radius: 5px;
                        -moz-border-radius-topleft: 5px;
                        -moz-border-radius-topright: 5px;
                        border-top-left-radius: 5px;
                        border-top-right-radius: 5px;

                        border-top: 1px solid #343336;
                        border-left: 1px solid #343336;
                        border-right: 1px solid #343336;

                        border-bottom: 3px solid #343336;

                        background-image: url(<?php echo WEBINARIGNITION_URL; ?>images/noise.png) !important;

                        color: #FFF;

                        text-shadow: 1px 1px 0px rgba(0,0,0,0.20);
                        filter: dropshadow(color=rgba(0,0,0,0.20), offx=1, offy=1);
            }

            .weDashWebinarTitle p, .weDashWebinarTitle h2{
                        margin-top: 0px;
                        margin-bottom: 0px;
            }

            .weDashWebinarTitle h2{
                        margin-top: 3px;
            }

            .weDashWebinarTitle p{
                        margin-top: 3px;
            }

            .dashWebinarTitleIcon{
                        float: left;
                        margin-right: 10px;
            }

            .dashWebinarTitleCopy{
                        float: left;
            }

            .webinarStatus{
                        /*background-color: #3E8FC7;*/
                        background-color: #3a383c;
                        color: #FFF;
                        font-size: 16px;
                        text-decoration: none;
                        font-weight: bold;
                        /*background-color: #F4F4F4;*/
                        padding: 10px;
                        /*-webkit-border-radius: 5px;
                        -moz-border-radius: 5px;
                        border-radius: 5px;*/
                        /*color: #3a3a3a;*/
                        /*border: 2px solid rgba(0,0,0,0.05);*/
                        border-bottom: 4px solid rgba(0,0,0,0.10);
                        float: left;
                        /*width: 100px;*/
                        padding-right: 20px;
                        padding-left: 20px;

                        text-shadow: 1px 1px 0px rgba(0,0,0,0.20);
                        filter: dropshadow(color=rgba(0,0,0,0.20), offx=1, offy=1);
            }

            .webinarStatusSelected{
                        background-color: #E44D1B;
                        color: #FFF;
            }

            .webinarStatus:hover{
                        background-color: #E44D1B;
                        color: #FFF;
            }

            .webinarStatus i{
                        margin-right: 5px;
            }

            .webinarStatusFirst{
                        -webkit-border-top-left-radius: 5px;
                        -webkit-border-bottom-left-radius: 5px;
                        -moz-border-radius-topleft: 5px;
                        -moz-border-radius-bottomleft: 5px;
                        border-top-left-radius: 5px;
                        border-bottom-left-radius: 5px;
            }

            .webinarStatusEnd{
                        -webkit-border-top-right-radius: 5px;
                        -webkit-border-bottom-right-radius: 5px;
                        -moz-border-radius-topright: 5px;
                        -moz-border-radius-bottomright: 5px;
                        border-top-right-radius: 5px;
                        border-bottom-right-radius: 5px;
            }

            .webinarURLArea{
                        margin: -15px;
                        padding: 15px;
                        padding-top: 20px;
                        background-color: #51504E;
                        border-bottom: 1px dashed #51504E;
            }

            .webinarURLArea .inputFieldDash{
                        border: 1px solid #302f2e !important;
                        height: 36px !important;
                        line-height: 36px !important;
                        background-image: url(<?php echo WEBINARIGNITION_URL; ?>inc/lp/images/link.png);
                        background-repeat: no-repeat;
                        background-position: 463px;
            }

            .webinarURLAreaStatus{
                        padding-top: 35px;
                        /*background-image: url(<?php echo WEBINARIGNITION_URL; ?>images/noise.png) !important;*/
            }

            .webinarURLAreaStatusTitle{
                        font-size: 18px;
                        font-weight: bold;
            }

            .webinarURLAreaBTN{
                        font-weight: bold;
                        font-size: 14px;
                        padding: 15px;
                        text-decoration: none;
                        -webkit-border-radius: 5px;
                        -moz-border-radius: 5px;
                        border-radius: 5px;
                        background-color: #3E8FC7;
                        color: #FFF;
                        border-bottom: 4px solid rgba(0,0,0,0.10);
                        text-align: center;
                        width: 100%;

            }

            .webinarPreviewItem{
                        background-color: #F5F3F3;
                        width: 100%;
                        /*border-right: 1px solid #9a9892;*/
                        /*border-bottom: 1px dashed #b8e1ff;*/
            }

            .webinarPreviewItem a{
                        color: #3A383C;
            }

            .webinarPreviewItem a:hover{
                        color: #E94F1C;
            }

            .webinarPreviewItem:nth-child(even){
                        background-color: #f9f6f6;
            }

            .webinarPreviewItemTop{
                        margin-top: 20px;
                        /*border-top: 1px solid #9a9892;*/
                        -webkit-border-top-left-radius: 5px;
                        -webkit-border-top-right-radius: 5px;
                        -moz-border-radius-topleft: 5px;
                        -moz-border-radius-topright: 5px;
                        border-top-left-radius: 5px;
                        border-top-right-radius: 5px;
            }

            .webinarPreviewItemTop .webinarPreviewIcon{
                        -webkit-border-top-left-radius: 5px;
                        -moz-border-radius-topleft: 5px;
                        border-top-left-radius: 5px;
            }

            .webinarPreviewItemBottom{
                        border-bottom: 3px solid #dad7d7;
                        -webkit-border-bottom-left-radius: 5px;
                        -webkit-border-bottom-right-radius: 5px;
                        -moz-border-radius-bottomleft: 5px;
                        -moz-border-radius-bottomright: 5px;
                        border-bottom-left-radius: 5px;
                        border-bottom-right-radius: 5px;
            }

            .webinarPreviewItemBottom .webinarPreviewIcon{
                        -webkit-border-bottom-left-radius: 5px;
                        -moz-border-radius-bottomleft: 5px;
                        border-bottom-left-radius: 5px;
            }

            .webinarPreviewItem:hover{
                        background-color: #fbf8f8;
            }


            .webinarPreviewIcon{
                        float: left;
                        margin-right: 15px;
                        width: 50px;
                        text-align: center;
                        background-color: #3A383C;
                        color: #FFF;
                        padding-top: 15px;
                        padding-bottom: 15px;
            }

            .webinarPreviewTitle{
                        float: left;
                        font-size: 16px;
                        font-weight: bold;
                        padding-top: 19px;
            }

            .webinarPreviewTitle a{
                        text-decoration: none;
            }

            .webinarPreviewTitle i{
                        margin-right: 5px;
            }

            .webinarPreviewStat{
                        float: right;
                        margin-left: 15px;
                        width: 120px;
                        text-align: right;
                        padding-right: 15px;

                        font-size: 18px;
                        font-weight: bold;

                        padding-top: 19px;

                        color: #313F4C;
            }

            .wmsTitle{
                        display: block;
                        font-size: 14px;
                        color: #6e6e6e;
                        font-weight: normal;
                        margin-top: 10px;
            }

            .launchConsole{
                        float: right;
                        background-color: #E64F1D;
                        border-bottom: 4px solid rgba(0,0,0,0.10);
                        color: #FFF;
                        padding: 15px;
                        font-size: 16px;
                        font-weight: bold;
                        -webkit-border-radius: 5px;
                        -moz-border-radius: 5px;
                        border-radius: 5px;
                        background-image: url(<?php echo WEBINARIGNITION_URL; ?>images/noise.png) !important;
                        margin-right: -70px;
                        margin-top: 14px;
            }

            .launchConsole a{
                        color: #FFF;
                        text-decoration: none;
            }

            .launchConsole i{
                        margin-right: 5px;
            }

            .editURLWE{
                        text-decoration: none;
                        background-color: #444347;
                        padding: 5px;
                        -webkit-border-radius: 5px;
                        -moz-border-radius: 5px;
                        border-radius: 5px;
                        background-image: url(<?php echo WEBINARIGNITION_URL; ?>images/noise.png) !important;
                        font-size: 10px;
                        color: #bfbcaf;
                        margin-left: 5px;
            }

            .inputFieldNameEdit{
                        line-height: 27px !important;
                        height: 27px !important;
                        background-color: #1e1e20 !important;
                        color: #F6F3EE !important;
                        border: 1px solid #373539 !important;
                        width: 230px;
                        margin-bottom: 0px !important;
                        margin-top: -4px !important;
                        margin-left: -3px !important;
                        padding-left: 3px !important;
            }

            .createWrapper{
                        background-color: #1F1F1F;
                        background-image: url(<?php echo WEBINARIGNITION_URL; ?>images/noise.png) !important;
                        /*display: none;*/
            }

            .weCreateLeft{
                        float: left;
                        width: 530px;
                        /*margin-top: 20px;*/
                        /*margin-right: 20px;*/
            }

            .weCreateRight{
                        float: right;
                        width: 350px;
                        /*margin-top: 20px;*/
            }

            .weCreateTitle{
                        /*border-bottom: 1px dashed #51504E;*/
                        padding: 15px;
                        padding-bottom: 25px;
            }

            .weCreateTitleIcon{
                        float: right;
            }

            .weCreateTitleCopy{
                        float: left;
            }

            .weCreateTitleHeadline{
                        display: block;
                        font-size: 24px;
                        color: #FFF;
                        font-weight: bold;
            }

            .weCreateTitleSubHeadline{
                        display: block;
                        font-size: 16px;
                        color: #C5C2B7;
                        margin-top: 10px;
            }

            .weCreateExtraSettings{
                        background-color: #373639;
                        background-image: url(<?php echo WEBINARIGNITION_URL; ?>images/noise.png) !important;
                        -webkit-border-radius: 5px;
                        -moz-border-radius: 5px;
                        border-radius: 5px;
                        padding: 15px;
                        padding-top: 20px;
                        padding-bottom: 20px;
            }

            .createTitleCopy1{
                        font-size: 16px;
                        font-weight: bold;
                        color: #FFF;
            }

            .createTitleCopy2{
                        font-size: 12px;
                        color: #C5C2B7;
                        margin-top: 5px;
            }

            .dashViews{
                        font-weight: normal;
                        font-size: 12px;
            }

            .timezoneRef{
                        font-size: 14px;
                        padding-top: 25px;
                        padding-left: 25px;
            }
            .timezoneRefZ{
                        padding-top: 10px;
            }

            .unlockTitle{
                        padding-bottom: 15px;
                        margin-bottom: 15px;
                        border-bottom: 1px dashed #5c5c5c;
            }

            .unlockSmall{
                        padding-top: 15px;
                        margin-top: 15px;
                        border-top: 1px dashed #5c5c5c;
                        font-size: 14px;
                        color: #909090;
            }

            .unlockTitle2{
                        margin-top: 10px;
                        font-size: 27px;
                        color: #FFF;
                        font-weight: bold;
            }

            .unlockTitle3{
                        margin-top: 10px;
                        font-size: 16px;
                        color: #909090;
            }

            .unlockForm{
                        /*display: block;*/
                        width: 350px;
                        font-weight: bold;
                        font-size: 18px;
                        line-height: 52px !important;
                        height: 52px !important;
            }

            .unlockBTN{
                        font-weight: bold;
                        font-size: 18px;
                        /*line-height: 52px !important;*/
                        height: 52px !important;
                        background-color: #E3481D;
                        color: #FFF;
                        text-decoration: none;
                        padding: 15px;
                        border-radius: 6px;
            }

            .unlockBTN:hover{
                        color: #FFF;
                        background-color: #6FA52F;
            }

            .unlockLabels{
                        font-weight: bold;
                        font-size: 14px;
                        color: #FFF;
                        margin-bottom: 10px;
            }

<?php echo file_get_contents("$sitePath/inc/lp/css/utils.css"); ?>

</style>
