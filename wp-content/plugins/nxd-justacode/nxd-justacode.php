<?php
/*
Plugin Name: NXD Just a code
Version: 1.0
*/
$jam = true;
//$jam_partner_domain = 'musicplacementsystem.yalepartnership.com';
//$jam_usercode = 'd645920e395fedad7bbbed0eca3fe2e0';
//$jam_this_domain = 'musicplacementsystem.com';
$jam_partner_domain = 'musicsupervisorguide.yalepartnership.com';
$jam_usercode = '33e75ff09dd601bbe69f351039152189';
$jam_this_domain = 'musicsupervisorguide.com';

$jac_scripts_on_pages[] = Array(
	'pages' => Array(4129, 4131),
	'scripts' => Array('uvjs' => 'https://upviral.s3.amazonaws.com/uvjs/1856-2465.js')
);

if ($jam && !empty($_GET['u'])){ 
    if( $curl = curl_init() ) {
      $agent = 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1)';
      curl_setopt($curl, CURLOPT_URL, 'http://' . $jam_partner_domain . '/js/remote/1/' . $_GET['u'] . '/username/' . $jam_usercode);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
      curl_setopt($curl, CURLOPT_USERAGENT, $agent);
      $c = curl_exec($curl);
      curl_close($curl);
    }
    $cid = json_decode($c); 
    $cookie_expires = 1 * 60 * 60 * 24 * 365;
    $cookie_domain = '.' . $jam_this_domain; //DON'T FORGET THE . (dot) before the domain
    if (isset($cid->value))
    setcookie('jamcom', $cid->value, time()+$cookie_expires,"/", $cookie_domain);
}

//add_action('wp_footer', 'your_function');
add_action('wp_head', 'your_function');

function your_function() {
$content = <<<EOT
<script>
    function _uGC(l,n,s) {
        if (!l || l=="" || !n || n=="" || !s || s=="") return "";
        var i,i2,i3,c="";
        i=l.indexOf(n);
        i3=n.indexOf("=")+1;
        if (i > -1) {
            i2=l.indexOf(s,i); if (i2 < 0) { i2=l.length; }
            c=l.substring((i+i3),i2);
        }
        return c;
    }

    function getGAcid(){
        var uaGaCkVal= _uGC(document.cookie, '_ga=', ';');

        var uaGaCkValArray= uaGaCkVal.split('.');
        var uaUIDVal="";
        var gacid="";
        if(uaGaCkValArray.length==4) {
            uaUIDVal=uaGaCkValArray[2] + "." + uaGaCkValArray[3];
            gacid=uaUIDVal.replace(/%2F/g,"-");
        } else {
            uaUIDVal = "";
            gacid = "";
        }

        return gacid;
    }

    jQuery(document).ready(function (){
       jQuery('a[href*="_xclick"]').each(function (index) {
          jQuery(this).attr('href', jQuery(this).attr('href')+'&custom=' + 
+getGAcid()+"_"+_uGC(document.cookie, 'jamcom=', ';')+"_msg");
       })
    });
</script>

EOT;
  echo $content;
}


	

/*
	add_action( 'wp_enqueue_scripts', 'my_wp_enqueue_scripts' );
	function my_wp_enqueue_scripts(){
	
		var_dump(is_page());
		if (is_page()) {
			global $post;
			foreach($jac_scripts_on_pages as $item){
				if (in_array($post->ID, $item['pages']))
					foreach($item['pages'] as $name => $url) {
						wp_register_script( $name, $url );
						wp_enqueue_script( $name );
					}
			}
		}
	}
*/