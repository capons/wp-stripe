<?php
define( 'WP_USE_THEMES', true );
require( '../../../../wp-load.php' );
global $post;
global $wpdb;
$getPage = $wpdb->prefix . "scarcitybuilderx";
$getID   = $_GET['edit'];

if ( is_numeric( $getID ) ) {
	$getID     = substr( $getID, 0, 3 );
	$variables = $wpdb->get_results(
		$wpdb->prepare(
			"SELECT * FROM $getPage WHERE id = %d",
			array(
				$getID
			)
		), ARRAY_A );
} else {
	echo "<b>ERROR</b> : Not A Real ID";
}


$tpl = get_post_meta( $post->ID, '_template', true );

foreach ( $variables as $template ) {
}

// Get Day Translations:
$translate = get_option( 'translate' . '_' . $template['name'] );
if ( $translate == "" ) {
	$translate = "Days, Hours, Minutes, Seconds|Day, Hour, Minute, Second";
}
// Break Apart Translation
$translate = trim( $translate );
$tmp       = explode( '|', $translate );

$translate  = explode( ",", $tmp[0] );
$translate1 = explode( ",", $tmp[1] );
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title><?php echo $template['name']; ?></title>
<?php if ( $template['font'] == "" ) {
} else {
	?>
	<link rel="stylesheet"
	      href='//fonts.googleapis.com/css?family=<?php echo str_replace( " ", "+", $template['font'] ); ?>'>
<?php } ?>
<script type="text/javascript" src="//code.jquery.com/jquery-latest.js"></script>
<script type="text/javascript" src="jquery.plugin.js"></script>
<script type="text/javascript" src="jquery.countdown.js"></script>
<script type="text/javascript" src="jquery.cookie.js"></script>
<script type="text/javascript" src="moment.js"></script>
<script type="text/javascript">
	$(window).load(function () {

		// Check if date has been passed:
		var checkIfExpiedOnLoad = setInterval(function () {
			console.log($(".countdown-amount").text());

			if ($(".countdown-amount").text() == "000") {
				// run onexpirey fn
				liftOff();
				clearInterval(checkIfExpiedOnLoad);
			} else {
				clearInterval(checkIfExpiedOnLoad);
			}

		}, 500);

		var ontick_cb = function () {
			window.parent.document.getElementById(window.name).style.height = document.getElementById('until2d').scrollHeight + 'px';
		};


		<?php if ($template['type'] == '' || $template['type'] == '2' ) { ?>
		var dateGo = new Date('<?php echo $template["date"]; ?> <?php echo $template["time"]; ?>:00');
		$('#until2d').countdown({
			until: dateGo,
			onExpiry: liftOff,
			alwaysExpire: true,
			timezone: <?php echo $template['timezone']; ?>,
			labels: ['Years', 'Months', 'Weeks', '<?php echo $translate[0]; ?>', '<?php echo $translate[1]; ?>', '<?php echo $translate[2]; ?>', '<?php echo $translate[3]; ?>'],
			labels1: ['Year', 'Month', 'Week', '<?php echo $translate1[0]; ?>', '<?php echo $translate1[1]; ?>', '<?php echo $translate1[2]; ?>', '<?php echo $translate1[3]; ?>'],
			onTick: ontick_cb,
			format: 'dhmS'
		});

		function liftOff() {
			<?php if ($template['expiryaction'] == '' || $template['expiryaction'] == '1' ) { ?>

			<?php } ?>
			<?php if ($template['expiryaction'] == '2' ) { ?>
			window.parent.location = "<?php echo $template['redirecturl']; ?>";
			<?php } ?>
			<?php if ($template['expiryaction'] == '3' ) { ?>
			$('.countdown').hide();
			$('#expired').show();
			setTimeout(function () {
				$(".scarcitybuilder", top.document).css("height", $(document).height());
			}, 50);
			<?php } ?>
			<?php if ($template['expiryaction'] == '4' ) { ?>
			$(".scarcitybuilder", top.document).css("display", "none");
			<?php } ?>
		}

		<?php } else if ($template['type'] == '1') { ?>

		$('#until2d').countdown({
			until: '+<?php echo $template["day"]; ?>d +<?php echo $template["hour"]; ?>h +<?php echo $template["minutes"]; ?>m',
			onExpiry: liftOff,
			alwaysExpire: true,
			labels: ['Years', 'Months', 'Weeks', '<?php echo $translate[0]; ?>', '<?php echo $translate[1]; ?>', '<?php echo $translate[2]; ?>', '<?php echo $translate[3]; ?>'],
			labels1: ['Year', 'Month', 'Week', '<?php echo $translate1[0]; ?>', '<?php echo $translate1[1]; ?>', '<?php echo $translate1[2]; ?>', '<?php echo $translate1[3]; ?>'],
			onTick: ontick_cb,
			format: 'dhmS'
		});

		function liftOff() {
			<?php if ($template['expiryaction'] == '' || $template['expiryaction'] == '1' ) { ?>

			<?php } ?>
			<?php if ($template['expiryaction'] == '2' ) { ?>
			window.parent.location = "<?php echo $template['redirecturl']; ?>";
			<?php } ?>
			<?php if ($template['expiryaction'] == '3' ) { ?>
			$('.countdown').hide();
			$('#expired').show();
			setTimeout(function () {
				$(".scarcitybuilder", top.document).css("height", $(document).height());
			}, 50);
			<?php } ?>
			<?php if ($template['expiryaction'] == '4' ) { ?>
			$(".scarcitybuilder", top.document).css("display", "none");
			<?php } ?>
		}

		<?php } else if ($template['type'] == '3') { ?>

		// Cookie Based

		// Check If Cookie Is Set ::
		if ($.cookie('stbx_<?php echo $getID; ?>')) {

			// Read Cookie ::
			var future = $.cookie('stbx_<?php echo $getID; ?>');

		} else {

			// Set Cookie ::
			$randomHour = Math.floor((Math.random() * 6) + 1);
			$randomMinutes = Math.floor((Math.random() * 55) + 1);
			$randomSeconds = Math.floor((Math.random() * 55) + 1);

			var cookie_days = <?php echo !empty($template['day'])?$template['day']:0; ?>;
			var cookie_hours = <?php echo !empty($template['hour'])?$template['hour']:0; ?>;
			var cookie_minutes = <?php echo !empty($template['minutes'])?$template['minutes']:0; ?>;

			$futureTime = moment().add('days', cookie_days).add('hours', cookie_hours).add('minutes', cookie_minutes);
			//$futureTime = moment($futureTime).subtract('hours', $randomHour);
			//$futureTime = moment($futureTime).subtract('minutes', $randomMinutes);
			//$futureTime = moment($futureTime).subtract('seconds', $randomSeconds);
			$futureTime = moment($futureTime).format();
			var future = $futureTime;

			$.cookie('stbx_<?php echo $getID; ?>', future, {expires: 70});

		}

		function liftOff() {
			<?php if ($template['expiryaction'] == '' || $template['expiryaction'] == '1' ) { ?>

			<?php } ?>
			<?php if ($template['expiryaction'] == '2' ) { ?>
			window.parent.location = "<?php echo $template['redirecturl']; ?>";
			<?php } ?>
			<?php if ($template['expiryaction'] == '3' ) { ?>
			$('.countdown').hide();
			$('#expired').show();
			setTimeout(function () {
				$(".scarcitybuilder", top.document).css("height", $(document).height());
			}, 50);
			<?php } ?>
			<?php if ($template['expiryaction'] == '4' ) { ?>
			$(".scarcitybuilder", top.document).css("display", "none");
			<?php } ?>
		}

		var dateGo = new Date(future);
		$('#until2d').countdown({
			until: dateGo,
			alwaysExpire: true,
			onExpiry: liftOff,
			labels: ['Years', 'Months', 'Weeks', '<?php echo $translate[0]; ?>', '<?php echo $translate[1]; ?>', '<?php echo $translate[2]; ?>', '<?php echo $translate[3]; ?>'],
			labels1: ['Year', 'Month', 'Week', '<?php echo $translate1[0]; ?>', '<?php echo $translate1[1]; ?>', '<?php echo $translate1[2]; ?>', '<?php echo $translate1[3]; ?>'],
			onTick: ontick_cb,
			format: 'dhmS'
		});

		<?php } ?>


	});
</script>
<style type="text/css">

body {
	background: none;
	color: #444;
	font: normal 16px "<?php echo $template['font']; ?>", sans-serif;
	margin: 0;
}

ul.countdown {
	list-style: none;
	margin: 0 0;
	padding: 0;
	display: block;
	text-align: center;
}

ul.countdown li {
	display: inline-block;
	margin: 0 5px;
	padding: 10px 10px;
	background: #eee;
	border: 3px solid #ccc;
	border-radius: 10px;
	width: 90px;
}

ul.countdown li span {
	font-size: 67px;
	font-weight: 300;
	font-weight: bold;
	line-height: 67px;
}

ul.countdown li p {
	opacity: .9;
	font-size: 17px;
	padding: 0;
	margin: 0;
}

#expired {
	padding: 15px;
	text-align: center;
	border-radius: 10px;
}

<?php if($template['color'] == '2') { ?>
ul.countdown li, #expired {
	background: #FCD871;
	border: 3px solid #90776A;
	color: #7B4E37;
}

<?php } ?>
<?php if($template['color'] == '3') { ?>
ul.countdown li, #expired {
	background: #A9E2F6;
	border: 3px solid #80C7E0;
	color: #487686;
}

<?php } ?>
<?php if($template['color'] == '4') { ?>
ul.countdown li, #expired {
	background: #FE3939;
	border: 3px solid #C72D2D;
	color: #fff;
}

<?php } ?>
<?php if($template['color'] == '5') { ?>
ul.countdown li, #expired {
	background: #2A2A2A;
	border: 3px solid #494949;
	color: #fff;
}

<?php } ?>
<?php if($template['color'] == '6') { ?>
ul.countdown li, #expired {
	background: #C7E082;
	border: 3px solid #9FB768;
	color: #59712F;
}

<?php } ?>

<?php if($template['color'] == '7') { ?>
ul.countdown li, #expired {
	background: #FFF;
	border: 2px solid #b8b8b8;
	color: #343434;
	background-image: -webkit-gradient(linear, center top, center bottom, from(white), to(#d6d6d6));
	background-image: -webkit-linear-gradient(top, white, #d6d6d6);
	background-image: -moz-linear-gradient(top, white, #d6d6d6);
	background-image: -o-linear-gradient(top, white, #d6d6d6);
	background-image: -ms-linear-gradient(top, white, #d6d6d6);
	background-image: linear-gradient(to bottom, white, #d6d6d6);

	-webkit-box-shadow: inset 0 1px 2px rgba(255, 255, 255, 0.33);
	-moz-box-shadow: inset 0 1px 2px rgba(255, 255, 255, 0.33);
	box-shadow: inset 0 1px 2px rgba(255, 255, 255, 0.33);

}

<?php } ?>

<?php if($template['color'] == '8') { ?>
ul.countdown li, #expired {
	background: #e69824;
	border: 2px solid #e69824;
	color: #80300f;
	background-image: -webkit-gradient(linear, center top, center bottom, from(#fcd871), to(#e69824));
	background-image: -webkit-linear-gradient(top, #fcd871, #e69824);
	background-image: -moz-linear-gradient(top, #fcd871, #e69824);
	background-image: -o-linear-gradient(top, #fcd871, #e69824);
	background-image: -ms-linear-gradient(top, #fcd871, #e69824);
	background-image: linear-gradient(to bottom, #fcd871, #e69824);

	-webkit-box-shadow: inset 0 1px 2px rgba(255, 255, 255, 0.33);
	-moz-box-shadow: inset 0 1px 2px rgba(255, 255, 255, 0.33);
	box-shadow: inset 0 1px 2px rgba(255, 255, 255, 0.33);

}

<?php } ?>

<?php if($template['color'] == '9') { ?>
ul.countdown li, #expired {
	background: #a9e2f6;
	border: 2px solid #7adcff;
	color: #487686;
	background-image: -webkit-gradient(linear, center top, center bottom, from(#a9e2f6), to(#7adcff));
	background-image: -webkit-linear-gradient(top, #a9e2f6, #7adcff);
	background-image: -moz-linear-gradient(top, #a9e2f6, #7adcff);
	background-image: -o-linear-gradient(top, #a9e2f6, #7adcff);
	background-image: -ms-linear-gradient(top, #a9e2f6, #7adcff);
	background-image: linear-gradient(to bottom, #a9e2f6, #7adcff);

	-webkit-box-shadow: inset 0 1px 2px rgba(255, 255, 255, 0.33);
	-moz-box-shadow: inset 0 1px 2px rgba(255, 255, 255, 0.33);
	box-shadow: inset 0 1px 2px rgba(255, 255, 255, 0.33);

}

<?php } ?>

<?php if($template['color'] == '10') { ?>
ul.countdown li, #expired {
	background: #dc3521;
	border: 2px solid #ba1b09;
	color: #FFF;
	background-image: -webkit-gradient(linear, center top, center bottom, from(#dc3521), to(#ba1b09));
	background-image: -webkit-linear-gradient(top, #dc3521, #ba1b09);
	background-image: -moz-linear-gradient(top, #dc3521, #ba1b09);
	background-image: -o-linear-gradient(top, #dc3521, #ba1b09);
	background-image: -ms-linear-gradient(top, #dc3521, #ba1b09);
	background-image: linear-gradient(to bottom, #dc3521, #ba1b09);

	-webkit-box-shadow: inset 0 1px 2px rgba(255, 255, 255, 0.33);
	-moz-box-shadow: inset 0 1px 2px rgba(255, 255, 255, 0.33);
	box-shadow: inset 0 1px 2px rgba(255, 255, 255, 0.33);

}

<?php } ?>

<?php if($template['color'] == '11') { ?>
ul.countdown li, #expired {
	background: #c7e082;
	border: 2px solid #b7e043;
	color: #434933;
	background-image: -webkit-gradient(linear, center top, center bottom, from(#c7e082), to(#b7e043));
	background-image: -webkit-linear-gradient(top, #c7e082, #b7e043);
	background-image: -moz-linear-gradient(top, #c7e082, #b7e043);
	background-image: -o-linear-gradient(top, #c7e082, #b7e043);
	background-image: -ms-linear-gradient(top, #c7e082, #b7e043);
	background-image: linear-gradient(to bottom, #c7e082, #b7e043);

	-webkit-box-shadow: inset 0 1px 2px rgba(255, 255, 255, 0.33);
	-moz-box-shadow: inset 0 1px 2px rgba(255, 255, 255, 0.33);
	box-shadow: inset 0 1px 2px rgba(255, 255, 255, 0.33);

}

<?php } ?>

<?php if($template['color'] == '12') { ?>
ul.countdown li {
	background-color: transparent;
	border: none;
	color: #242424;
}

<?php } ?>

<?php if($template['color'] == '13') { ?>
ul.countdown li {
	background-color: transparent;
	border: none;
	color: #FFF;
}

<?php } ?>

<?php if($template['size'] == '3') { ?>
/*large*/
ul.countdown li {
	width: 130px;
}

ul.countdown li span {
	font-size: 90px;
	line-height: 90px;
}

ul.countdown li p {
	font-size: 24px;
}

<?php } ?>
<?php if($template['size'] == '2') { ?>
/*medium*/
ul.countdown li span {
	font-size: 67px;
	line-height: 67px;
}

ul.countdown li p {
	font-size: 17px;
}

<?php } ?>
<?php if($template['size'] == '1') { ?>
/*small*/
ul.countdown li {
	width: 60px;
}

ul.countdown li span {
	font-size: 46px;
	line-height: 46px;
}

ul.countdown li p {
	font-size: 13px;
}

<?php } ?>

<?php if($template['size'] == '4') { ?>
/* extra small*/
ul.countdown li {
	width: 40px;
}

ul.countdown li span {
	font-size: 21px;
	line-height: 21px;
}

ul.countdown li p {
	font-size: 10px;
}

<?php } ?>

a {
	color: #76949F;
	text-decoration: none;
}

a:hover {
	text-decoration: underline;
}

.source {
	width: 405px;
	margin: 0 auto;
	background: #4f5861;
	color: #a7abb1;
	font-weight: bold;
	display: block;
	white-space: pre;
	-webkit-border-radius: 3px;
	-moz-border-radius: 3px;
	border-radius: 3px;
}

.btn {
	background: #f56c4c;
	margin: 40px auto;
	padding: 12px;
	display: block;
	width: 100px;
	color: white;
	text-align: center;
	text-transform: uppercase;
	font-weight: bold;
	text-decoration: none;
	-webkit-border-radius: 2px;
	-moz-border-radius: 2px;
	border-radius: 2px;
}

.btn:hover {
	text-decoration: none;
	opacity: .7;
}

</style>

</head>
<body>
	<ul id="until2d" class="countdown"></ul>

	<div id="expired" style="display: none">
		<?php echo wpautop( $template['expiredtext'] ); ?>
	</div>
</body>
</html>