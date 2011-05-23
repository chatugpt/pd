<?php
class VerificationCodeImage
{
	public static function genPNGImage()
	{
		session_start();
		$width=120;
		$height=30;
		$sourcestrings="0123456789";
		//$sourcestrings="0123456789ABCDEFGHJKMNPWRSTUVWXYZ";
		$ssSize = strlen($sourcestrings);

		$image=imagecreate($width,$height);
		$white=imagecolorallocate($image,255,255,255);
		imagefill($image,0,0,$white);

		//background
		$max = $width * $height / 60;
		for($i=0 ; $i< $max; $i++)
		{
			$i_x=rand(4,$width-10);
			$i_y=rand(0,$height-10);
			imageString($image, 4, $i_x, $i_y, '*', imagecolorallocate($image,rand(200,255),rand(200,255),rand(200,255)));
		}

		//$fonts= $APP_ROOT."/fonts/";
		$fonts = dirname(__FILE__).'/';
		//putenv('GDFONTPATH='.$fonts);
		$fontname=$fonts.'KELLYAG_.TTF';
		//$fontname='KELLYAG_.TTF';

		/*
		-----------------------------------------
		1. generate 6-digits verification code image
		2. set session
		3. output
		-----------------------------------------
		*/
		// 1. generate 6-digits verification code image
		//---------------------------------------------
		$strsize=4;
		$verCode = "";
		$colorReds = array(0x99, 0xcc, 0xff);
		$colorGreens = array(0x00, 0x33, 0x66, 0x99);
		$colorBlues = array(0x00, 0x33, 0x66, 0x99, 0xcc, 0xff);

		for($i=0;$i<$strsize;$i++)
		{
			$rate = rand(55,88) * 0.01;
			$font_size=floor($height * $rate);
			$x_i = $i * $width / ($strsize) + $font_size - floor($height * 0.5);
			$y_i = $height * 0.8 + rand(-2,2);
			$angle_i = rand(-30,45);

			$verChar = $sourcestrings[rand(0,($ssSize-1))];
			$verCode.= $verChar;

			$rId = rand(0,2);
			$gId = rand(0,3);
			$bId = rand(0,5);

			$fontColor=imagecolorallocate($image,$colorReds[$rId],$colorGreens[$gId],$colorBlues[$bId]);
			if(isset($fontColorOld))
			{
				while(true)
				{
					if($fontColor == $fontColorOld)
					{
						$rId = rand(0,2);
						$gId = rand(0,3);
						$bId = rand(0,5);
						$fontColor=imagecolorallocate($image,$colorReds[$rId],$colorGreens[$gId],$colorBlues[$bId]);
					}
					else
					{
						break;
					}
				}
			}
			$fontColorOld = $fontColor;
			imagettftext($image,$font_size,$angle_i,$x_i,$y_i,$fontColor,$fontname,$verChar);
		}
		// 2. set session
		//-----------------------------------------
		unset($_SESSION['VERIFICATION_CODE']);
		$_SESSION['VERIFICATION_CODE'] = md5($verCode);


		// 3. output
		//-----------------------------------------
		header('content-type:image/png');
		imagepng($image);
		imagedestroy($image);
	}

	public static function checkVerficationCode()
	{
		global $_REQUEST;
		if(isset($_REQUEST['VERIFICATION_CODE']))
		{
			$inVerCode = $_REQUEST['VERIFICATION_CODE'];
			if(isset($_SESSION['VERIFICATION_CODE']))
			{
				if($_SESSION['VERIFICATION_CODE']==md5($inVerCode))
				{
					unset($_SESSION['VERIFICATION_CODE']);
					return true;
				}
				else
				{
					unset($_SESSION['VERIFICATION_CODE']);
					return false;
				}
			}
			else
			{
				return false;
			}
		}
		else
		{
			unset($_SESSION['VERIFICATION_CODE']);
			return false;
		}
	}
}
?>