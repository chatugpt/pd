<?php
abstract class Validation
{
	/**
	 * 验证是否为指定长度的字母/数字组合
	 *
	 * @param string $originalStr
	 * @param int $minNum
	 * @param int $maxNum
	 * @return bool
	 */
	static function isAlnum($originalStr)
	{
		return preg_match("/^[a-zA-Z0-9]+$/", $originalStr);
	}

	/**
	 * 验证是否为指定长度数字
	 *
	 * @param string $originalStr
	 * @param int $minNum
	 * @param int $maxNum
	 * @return bool
	 */
	static function isNum($originalStr, $minNum=null, $maxNum=null)
	{
		if ($maxNum&&$minNum)
		{
			$pass=preg_match("/^[0-9]{" . $minNum . "," . $maxNum . "}$/i", $originalStr);
		}
		else 
		{
			$pass=preg_match("/^\d*$/", $originalStr);
		}
		
		return $pass;
	}

	static function isCertificate($originalStr)
	{

		$pass=preg_match("/(^[a-zA-Z]\d+$)|(^\d+[a-zA-Z]$)/", $originalStr);

		return $pass;
	}
	/**
	 * 验证身份证号码
	 *
	 * @param string $originalStr
	 * @return bool
	 */
//	function isStatus($originalStr)
//	{
//		return preg_match('/(^([\d]{15}|[\d]{18}|[\d]{17}x)$)/', $originalStr);
//	}

	/**
	 * 验证邮件地址
	 *
	 * @param string $originalStr
	 * @return bool
	 */
	static function isEmail($originalStr)
	{
		return preg_match('/^[_\.0-9a-z-]+@([0-9a-z][0-9a-z-]+\.)+[a-z]{2,4}$/', $originalStr);
	}
	/**
	 * 验证电话号码
	 *
	 * @param string $originalStr
	 * @return bool
	 */
//	function isPhone($originalStr)
//	{
//		return preg_match("/^((\(\d{3}\))|(\d{3}\-))?(\(0\d{2,3}\)|0\d{2,3}-)?[1-9]\d{6,7}$/", $originalStr);
//	}
	/**
	 * 验证手机号码
	 * @param string $originalStr
	 * @return bool
	 */
//	function isMobilePhone($originalStr)
//    {
//	    return preg_match("/(^(13[0-9]{9}$))|(^(15[0-9]{9}$))/", $originalStr);
//    }
	/**
	 * 验证邮编
	 *
	 * @param string $originalStr
	 * @return bool
	 */
	static function isZip($originalStr)
	{
		return preg_match("/^[1-9]\d{6}$/", $originalStr);
	}
	/**
	 * 验证url地址
	 *
	 * @param string $originalStr
	 * @return bool
	 */
	static function isUrl($originalStr)
	{
		return preg_match("/^http:\/\/[A-Za-z0-9]+\.[A-Za-z0-9]+[\/=\?%\-&_~`@[\]\':+!]*([^<>\"\"])*$/", $originalStr);
	}
	static function isDate($originalDate)
	{
		if (!$originalDate) {
			return false;
		}
		$dateInfo = explode('-', $originalDate);
		return checkdate($dateInfo[1], $dateInfo[2], $dateInfo[0]);
	}

	/**
	 * 检查时间是否大于当天时间
	 *
	 * @param string $originalStr
	 * @return unknown
	 * <code>
	 * $originalStr = '2007-01-01 15:12:01';
	 * $originalStr = '2007-01-01';
	 * </code>
	 */
	static function isLaterToday($originalDate)
	{
		$todayDate = strtotime(date('Y-m-d'));
		if (strtotime($originalDate) >= $todayDate)
		{
			return true;
		} else {
			return false;
		}
	}
	/**
	 * 检查时间是否大于指定的时间
	 *
	 * @param string $originalDate
	 * @param string $parallelDate
	 * @return bool
	 * <code>
	 * $originalDate = '2007-01-01 15:12:01';
	 * $parallelDate = '2007-01-01 15:12:01';
	 * </code>
	 */
	static function isLaterDate($originalDate, $parallelDate)
	{
		$parallelDate = strtotime($parallelDate);
		if (strtotime($originalDate) >= $parallelDate)
		{
			return true;
		} else {
			return false;
		}
	}
	static function utf8_trim($str) 
	{
		$len = strlen($str);
		$hex ='';
		for ($i=strlen($str)-1; $i>=0; $i-=1){
		$hex .= ' '.ord($str[$i]);
		$ch = ord($str[$i]);
		if (($ch & 128)==0) return(substr($str,0,$i));
		if (($ch & 192)==192) return(substr($str,0,$i));
		}
		return($str.$hex);
	}

}