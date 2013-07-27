<?php
	require('./wp-blog-header.php');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head profile="http://gmpg.org/xfn/11">
	<title>Wordpress Parola Sıfırlama Aracı</title>

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta http-equiv="content-language" content="tr" />
	
	<script type="text/javascript">
	function KontrolEt()
	{    
		var a = document.ysifreformu.ykullanici;
		var b = document.ysifreformu.yparola;
		
		if ( a.value.length < 1 || b.value.length < 1 ) {
			alert('Lütfen formu eksiksiz doldurunuz!');
			a.focus();
			return false;
		}
		
		return true;
	}
	</script>

	<style type="text/css">
		body { font-family: Arial, Tahoma, Verdana, sans-serif; font-size:76%; font-size:0.75em; color:#444444; text-align:center; }
		#govde { width:450px; text-align:center; margin: 0 auto; }
		#kutu {width:450px; height:250px; border:1px solid #e2e8f6; margin:120px 0px 20px 0px; text-align:left;}
		.baslik { background-color:#e2e8f6; height:40px; padding-left:10px; font-weight:bold; font-size:1.3em; padding-top:20px; }
		.durum { height:35px; margin-bottom:30px; }
		.hata, .ikaz, .tamam, .bilgi { border-bottom: 2px solid #fff; border-top: 2px solid #fff; color: #444;padding:10px;}
		.hata    {background-color: #fbe3e4; border-color: #e0011b}
		.hata a  {color: #d12f19}
		.ikaz    {background-color: #fff6bf; border-color: #ffd324}
		.ikaz a  {color: #817134}
		.tamam   {background-color: #e9ffdd; border-color: #72c868}
		.tamam a {color: #529214}
		.bilgi   {background-color: #e2ecee; border-color: #9ddae6}
		.bilgi a {color: #2d7ba2}
		table { width:100%; }
		td {	height:25px;padding:0px 10px 0px 10px;}
		.bilgisi { width:110px; }
		.kutucuk{width:190px; border:1px solid #bdcdf3; color:#777777;}
		.dugme {border:1px solid #999999; color: #666666; background-color:#ededed; padding:2px 5px 2px 5px; float:right; }
		#altbilgi {border:1px solid #e2e8f6; padding:5px;}
		#altbilgi a{	color:#529214;text-decoration:none;}
		#altbilgi a:hover{color:#666666;}	
	</style>

</head>
<body>

<div id="govde">
	<div id="kutu">

		<div class="baslik">Wordpress Parola Sıfırlama Aracı</div>

		<div class="durum">
			<?php
			
				if (isset($_POST['sifirla'])) {
						
					$kullanici_tablo	= $wpdb->prefix."users";
					$yeni_parola 		= md5($_POST['yparola']);
					$sorgu				= "UPDATE $kullanici_tablo SET user_pass = '$yeni_parola' WHERE user_login = '$_POST[ykullanici]'";
					$sonuc = $wpdb->query($sorgu);
					
					if ($sonuc) 
						echo '<div class="tamam">Başarılı bir şekilde parolanızı sıfırladınız. Yeni parolanız "<strong>'.$_POST['yparola'].'</strong>"</div>';
					else
						echo '<div class="hata">Hatalı giriş nedeniyle parolanız sıfırlanamadı!</div>';
				
				}			
				else 
				{
					echo '<div class="ikaz">"Kullanıcı Adı" ve "Yeni Parola" kutularını doldurunuz.</div>';
				}
			
			?>
		</div>
		
		<form name="ysifreformu" id="ysifreformu" method="post" action="ysifre.php" onsubmit="return KontrolEt();" >
		<table>
			<tr>
				<td class="bilgisi">Kullanıcı Adı</td>
				<td><input type="text" name="ykullanici" id="ykullanici" class="kutucuk" tabindex="1" /></td>
			</tr>
			<tr>
				<td class="bilgisi">Yeni Parola</td>
				<td><input type="password" name="yparola" id="yparola" class="kutucuk" tabindex="2" /></td>
			</tr>
			<tr>
				<td class="bilgisi"></td>
				<td><br /><br /><input type="submit" name="sifirla" class="dugme" tabindex="3" value="Parolayı Sıfırla"/></td>
			</tr>
		</table>
		</form>
		
	</div>
	
	<div id="altbilgi">
		<a href="http://www.yakuter.com/wordpress-parola-sifirlama-araci/">Wordpress Parola Sıfırlama Aracı</a> |
		Telif Hakkı &copy; 2010 &nbsp;|&nbsp;
		<a href="http://www.yakuter.com/" title="Wordpress">Yakuter</a>
	</div>
</div>

</body>
</html>