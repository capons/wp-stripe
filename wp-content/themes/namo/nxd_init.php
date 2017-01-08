<?php 

function nxd_init2($form_post) {

if (is_page() /*&& in_array($post->ID, $pages)*/) { ?>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/jquery.validate.min.js"></script>
<style>
.submit {
	margin-left: 90px;
	margin-top: 10px;
}

#mch_form_description {
	font-size: 20px;
	color: #000000;
	margin-bottom: 10px;
	border-bottom: 1px solid #ebebeb;
}

.submit span.shot {
	display: none;
}

.submit:before {
    content: ' ';
    background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAJYAAAB8CAMAAAC8ALk0AAAC+lBMVEX6xy7////6xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy76xy7KzuBfAAAA/XRSTlMAAAECAwQFBgcICQoLDA0ODxAREhMUFRYXGBkaGxwdHh8gISIjJCUmJygpKissLS4vMDEyMzQ1Njc4OTo7PD0+P0BBQkNERUZHSElKS0xNTk9QUVJTVFVWV1hZWltcXV5fYGFiY2RlZmdoaWprbG1ub3Byc3R1dnd4eXp8fX5/gIGCg4SFhoeIiYqLjI2PkJGSk5SVlpeYmZqbnJ2en6ChoqOkpaanqKmqq6ytrq+wsbKztLW2t7i5uru8vb6/wMHCw8TFxsfIycrLzM3Oz9DR0tPU1dbX2Nna29zd3t/g4eLj5OXm5+jp6uvs7e7v8PHy8/T19vf4+fr7/P3+nalUdwAACXpJREFUeNrN3GlUFFcWAOBLVe/sO0iDgogLahSC0RCJGHAbRYlD0HFhAooT445MjMpIZtyiCDpI0MQdHY1rkIxO3HEZER0URBaDyKrIYncjdNNd9c6ZHxjFdBW9VNvP+7v6nK/vve+9eq+qG4ApCMAWFhYWFhYW2iABuErdhO8Yy14aEDE3OcLu3WGJRT0Cx85ee+D6w8q/2rwLLAIkol6DJsWs3nepsLkZoY4drvhZzs49B0yKX7P76r1nctQZuWOxszzjlq7Zcam4SdGG6JcqVDlNiJuVfPNBU6sKvRHP/+FC4mW5nW1BWqH+cTDmbNnFlmq0WMpbk8WYixiSrc1CtfFWmFluKU3arLZ/SjGzLOfVaLNQQSSJl8WfcIWhis+WOeBlgd/3bdqsFzv7E3hZTkmNtLYL10T/iiWcelubRVUnOOFlEQFZKu1stWYNw8sCx9W12ixNfgwPL0sYdZvSdsm2+xJYWcTgPS8Ypq4HkSKsLLD/soIhXQ1rhXhZ/NALDDMqdTmMh5UFvdbKGKrYtMAJLwtCbzCw5LsDhFhZhPtBhqmLKl4uJbFmy3peFUO6FIfD8bIg7BzDuqgu+ZsPgZXlm9HAkC5l9jgJVpYk+qqSwVW6vAdWFhmwjWEHhFT/nm6LkwV20bkUUxn3hohxsqBnah0DS317iTOBk+UQX8rAQg37w7Fmizdsj4LJ1bhzCImRBeLpF5i6CxXFOeJk8ftvqGdQ0dWZgQKMLLAdf4apjOryLf1FBD4WeKxhShdCxfOsMLIIy8+uq5lY8j0f8DBmS+C1rISp69V1mUMs8bGA53OIcTDSzRv9hfhY4LCikbG7lBeiMGYLYHBKNaOrYd9IAiMLgn/qYHS1HZ9ojZElXauiGV3Nm4MwskTDjzYxzhKt1+a48rCxQDz1PCMLyc4t6SPExhL4bHiCmIdj8YrBQlwsQjxsX42G0UVfXugpMHpA8jixACRjs58xtn3H04ORnkY/mnXqK+TEIvt9fZ+5jOrak3F9jWV5xiz25MICQeDWGmYXRd1YM9S4/iL7rUqZ4UByYAGM2llNMcM6Chb7i4y5ixYEbs9Pn9iLx4FFOH/+0xMWl/zYnIHOfMNZoqAsFboY6y3kkC3RgIRrMmYWXX90+UipxPCEjTiJEMqJ9CCNZ4FgUNIdxBKK/M1TvSwNdQnGnlUhddmmIHvCeBZA0JZHajZYzZHP/Qxluf7pjBKh9rvrQmwI41mk/cT0QlZXy5kl/oa5CM/E/A6EEKrKinTikC1hzwl7a9lYtOyXle8bdmjivKy2c46WH5/iZDwL+C4xOe00G+xp7voob0NOTVySXi61dF3GBPb5SycLCO/47HoNC4tqLDiyNMRR71sd8r3tdZ3fkVb8b8Nodw4sQZ/p+6tUbHVUPr60drKfvs+0ReOOvFpoW4syI3qQxrKAFEtnnmRte6R5fnPX/FAP/SopmZTT+nptbciKtDWaBcDzW3xfyepC7dVnU2cOd9RnzhdEXum6bNRsC3YlCGNZIBz01cUWih2mKDnxTcQAG92ThSi+sOvwUd3aNEUqJo1lgdBn1r7ybhJGtdzavXB8H10tRnh8Vdl19GhkJelRLkZnC4DwmnCgsoPdhVR1F3Z9GaajxUj3lQ/eSDpNVez+xNJ4FpDSeWe6YyHUVvXL1phRHt0+fnT55vHveoGqTPnElmc0C8D7iyuabl1IUZKTsXi0l5D9ht1/t9bZWXtB6hgvofEscI06UtW9SyMvv/Zd4sSBTg5WBNObmJLoG1oLBt2Wn/Gpl8B4FpCBiVflOmCK8vzj6fOnBPdzZOh/aUIJ0xbvUcYfrDiwAJxij9XpqKSm/XnzvZxtSXMjfR0dnAiya9IkC0oYP1OeNkzEhSXwmXf4MYV0hrq+8Nqp1CVx0z7s7WIteVVPYi7zpoUq3hTmzoEFkkFxp2uRHqHuUDQX5Z3al5YwKeKjvg5SdxsgwTP5OctgKT00W8ozngXC3rEHajRIr6DoRnnjo59Pn/ph+aKFM0aMCJl9gm1roKzYE2LFgQXg/PG6AkQjvaNd9kJV+eBO7omjR86VqVin48IkH04sIL1jTzTpz0I0QohC6g654kkb+9ehCpOGEFxYAFZDk29RyPDovviVeyNcOLEApNFZvyITB/X0cLSYE4sA4dD5JxtMy6LbKjb6EZyyRZBgHbLlntq0rhc3V3oLuLAAAPgfLj5WZtqEKSvSQu1Ijix77zFLc+pNC3t6cKQtwYkFpMjKa0oK2+mJcXVEpat6cssWABASx4Do1P92mHA4tuXNlXJlAcG3kvhOzryv0ZhOVrox0JIjCwBIgH4x+wsUakNWpG6j9bsxdgRXFgAB4kGzM+82yJQmarBH6/3F3FkAAJb949NO36yVm8TV/p859iZhEQB2A6JWZB4tUZjCJb+c0M8k2QIAsOk7KiJxf9ELpKI5t1nVzmCTvdZDit16B8duvVRR1djO1VWe+h6YLEi+lcR3/OrtR89VyxFFGa9qur3D5C9neQZNmrX+QF5xST2tRMbYWkoO7xhnASYPKw//4dELkjKyrxdXtaiRhqYNmNWo6uOrwkYSb4EFJPDFHn7Dx8QlbvshO6/s18eV7ZQ+MBqpqvK2fNbf2sLibbBeTrNCB4+g4HEzE9avSzpUps/SSctubP9ioBPf4u2xOoMvthG7+fh5hadX606XovpYQgj3pVrvyRbAcWWpLlRbxc+bZ/hJwEwsAABCmqzjvAfVX9wwta8bgDlZgmHp3W9JZI93zQ1wBNK8LMuwf7V00+ntRce+De/x23pjxmyNPs2+T2qvuvD1uIGvF0HzscgJV1lZzXfS/+zd9WTXfCyH2CKW+aGpYP/CgDePwc3Hcl94h2au3/HEj9x+d7H5WLw5xTTDUlOXmxbVyx6wsQSLtE8RqaqbW2I+cAYSG4sYuFfr103Ksl0L/O2YDvHNxhL+Ma/jzfLJH57/e7gX89VmY4mmXXvjgJKqO5P8qS/bsyuzsQQTc7tmq+Vu5kxfe9arzcbizyp+jXp2/+DyULdurjYby2bRo99QmvIfV43y6PbPJszFIqziijv3Guragm8nD7AG4l1gAX/+Qxohmnp+PWNZkKOul9LMxvL+vgMhJLu79y/ve+m+2lwswZh8Cmnqzq8KddXnRwrmYtlE5qGGy2mz/ez1utxcLNvwA+UH4wNc9XwD01ws3sg1KeNd9P6FnNla3jPmYwOOOsx3Y2NnyL/idLL+D6NL6lWHcVGEAAAAAElFTkSuQmCC);
    width: 75px;
    height: 62px;
    background-size: 100% 100%;
    position: absolute;
    left: -53px; /*-83px;*/
    top: -10px;
}

.submit button {
	margin: 0;
	text-transform: none;
	background-color: #ffbe35; 
	width: 90%; 
	height: 58px; 
	padding: 12px; 
	border: 3px solid transparent;
	font-size: 24px;
	font-weight: bold;
/*	color: #2d3333 !important; */
	color: #000 !important;
	/*text-shadow: 0 1px 0 rgba(140,140,140,0.6) , -1px -1px 1px rgba(0,0,0,0.67) ;*/
	text-shadow: 1px 1px 1px #ffffff;
/*  
	text-shadow: 0px 0px 3px rgba(255,255,255,0.5);
	-webkit-background-clip: text;
		-moz-background-clip: text;
          background-clip: text; 
		
	background-color: #565656;
    color: transparent;
    text-shadow: 0px 2px 3px rgba(255,255,255,0.5);
    -webkit-background-clip: text;
       -moz-background-clip: text;
          background-clip: text;
*/
}

.submit button:hover {
	border-color: #FFDD54;
}

#mailchimp_div .features-pics {
	padding-right:22px;
}

#mailchimp_div h6{
  text-align: center;
  text-transform: none;
}

#mailchimp_div h4 {
	margin: 0;
}

#mailchimp_form input{
    width: 100%;
    text-transform: none;
    margin-bottom: 10px;
    background-color: #fff;
	border-color: rgb(171, 173, 179);
}

#mailchimp_form input, #mailchimp_form select {
    font-size:16px;
    color: #555;
	margin-top: 4px;
	border: 1px solid rgb(171, 173, 179);
}

#mailchimp_form label {
	padding-bottom: 5px;
}

#mailchimp_form select {
    margin-bottom: 15px;
}

#mailchimp_form input.error, #mailchimp_form select.error {
    border: 1px solid rgb(221, 51, 51);
}

#opt-in-01 {
	width: 90%;
	max-width: 800px;
	padding: 20px;
}

#mch_form_left, #mch_form_right {
	box-sizing: border-box;
	width: 50%;
	color: black;
}

#mch_form_right {
	/*width: 400px;*/
	font-size: 16px;
	line-height: 18px;
	border: 1px solid black; /* #ebebeb; */
	padding: 15px;
}

@media screen and (max-width:800px){
 
	#mch_form_left, #mch_form_description, #mailchimp_div h4.under {
		display: none;
	}

	#mch_form_right {
		width: 100%;
	}
	
	.submit:before{
		background-image: none;
	}
 
	.submit {
		margin-left: 0;
	}
	
	.submit span.wide {
		display: none;
	}

	.submit span.shot {
		display: inherit; /*inline-block;*/
	}

 
}
 
</style>
<div id="opt-in-01" class="white-popup-block mfp-hide">
<?php
	$some_post = & get_post( $form_post );
	echo $some_post->post_content;
?>
</div>	
<script>
jQuery( document ).ready(function() {
	jQuery('.submit button').click(function (){
		jQuery("#mailchimp_form").submit();
	});
	jQuery("#mailchimp_form").validate({
		rules: {
		  Q1: {required: true}, Q2: {required: true}, Q3: {required: true}
		},
		errorPlacement: function(error,element) {
		    return true;
	  }
	});

	jQuery('a[href=#opt-in-01]').magnificPopup({
            type: 'inline',
            preloader: false
        });
});
</script>
<?php } } ?>
