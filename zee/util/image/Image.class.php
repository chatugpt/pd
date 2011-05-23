<?php
abstract class Image
{
	static public function ImageResize($srcFile,$toW,$toH,$toFile=null,$cutMiddle=false)
	{
		//if($toFile==""){ $toFile = $srcFile; }
		$info = "";
		$data = getimagesize($srcFile,$info);
		switch ($data[2])
		{
			case 1:
				if(!function_exists("imagecreatefromgif")){
					echo "你的GD库不能使用GIF格式的图片，请使用Jpeg或PNG格式！<a href='./../java script:go(-1);'>返回</a>";
					exit();
				}
				$im = @imagecreatefromgif($srcFile);
				break;
			case 2:
				if(!function_exists("imagecreatefromjpeg")){
					echo "你的GD库不能使用jpeg格式的图片，请使用其它格式的图片！<a href='./../java script:go(-1);'>返回</a>";
					exit();
				}
				$im = @imagecreatefromjpeg($srcFile);
				break;
			case 3:
				$im = @imagecreatefrompng($srcFile);
				break;
		}

		$srcW=imagesx($im);
		$srcH=imagesy($im);
		$toWH=$toW/$toH;
		$srcWH=$srcW/$srcH;
		if ($cutMiddle)
		{
			if($toWH>=$srcWH){
				$ftoW=$toW;
				$ftoH=$toH;
				$offset = $srcH-($srcW*($toH/$toW));
				$srcX=0;
				$srcY=$offset/2;
				$srcH=$srcH-$offset;
			}
			else{
				$ftoH=$toH;
				$ftoW=$toW;
				$offset = $srcW-($srcH*($toW/$toH));
				$srcX=$offset/2;
				$srcY=0;
				$srcW=$srcW-$offset;
			}
		} else {
			if($toWH<=$srcWH){
				$ftoW=$toW;
				$ftoH=$ftoW*($srcH/$srcW);
				$srcX=0;
				$srcY=0;
			}
			else{
				$ftoH=$toH;
				$ftoW=$ftoH*($srcW/$srcH);
				$srcX=0;
				$srcY=0;
			}
		}
		if($srcW>$toW||$srcH>$toH)
		{
			if(function_exists("imagecreatetruecolor")){
				$ni = @imagecreatetruecolor($ftoW,$ftoH);
				//				$im2 = @imagecreatetruecolor($srcW,$srcH);
				if($ni)
				{
					if ($cutMiddle)
					{
						@imagecopy($im,$im,0,0,$srcX,$srcY,$srcW,$srcH);
					}
					@imagecopyresampled($ni,$im,0,0,0,0,$ftoW,$ftoH,$srcW,$srcH);
				} else {
					$ni=@imagecreate($ftoW,$ftoH);
					//					$im2 = @imagecreate($srcW,$srcH);
					if ($cutMiddle)
					{
						@imagecopy($im,$im,0,0,$srcX,$srcY,$srcW,$srcH);
					}
					@imagecopyresized($ni,$im,0,0,0,0,$ftoW,$ftoH,$srcW,$srcH);
				}
			} else {
				$ni=@imagecreate($ftoW,$ftoH);
				//				$im2 = @imagecreate($srcW,$srcH);
				if ($cutMiddle)
				{
					@imagecopy($im,$im,0,0,$srcX,$srcY,$srcW,$srcH);
				}
				@imagecopyresized($ni,$im,0,0,0,0,$ftoW,$ftoH,$srcW,$srcH);
			}
			//output
			if(function_exists('imagejpeg'))
			{
				if (!$toFile)
				{
					header('content-type:image/jpeg');
					@imagepng($ni);
				}
				else
				{
					@imagejpeg($ni,$toFile);
				}
			} else {
				if (!$toFile)
				{
					header('content-type:image/png');
					@imagepng($ni);
				}
				else
				{
					@imagepng($ni,$toFile);
				}
			}
			@imagedestroy($ni);
		}
		//output
		if (!$toFile)
		{
			if(function_exists('imagejpeg'))
			{
				header('content-type:image/jpeg');
				@imagepng($im);
			} else {
				header('content-type:image/png');
				@imagepng($im);
			}
		}
		@imagedestroy($im);
	}
}
?>