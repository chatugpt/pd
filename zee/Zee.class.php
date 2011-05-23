<?php
include_once "Config.class.php";
abstract class Zee {
  static private $_registry = array();
  static public function register($name, $obj) {
    self::$_registry[$name] = $obj;
  }
  
  static public function registry($name) {
    return self::$_registry[$name];
  }
  
  static public function url($controller, $action, $params = array()) {
    if (Config::LANG_EDIT_MODE) {
      return "#";
    }
    $url = "index.php?module={$controller}&action={$action}";
    if (count($params) > 0) {
      $url .= '&';
    }
    foreach ($params as $varName => $varValue) {
      $url .= "{$varName}={$varValue}";
    }
    return $url;
  }

  static public function getCurrentUrl($params = array()) {
    $url = $_SERVER['REQUEST_URI'];
    foreach ($params as $varName => $varValue) {
      $pattern = "/(\?|&){$varName}=[^&]+/i";
      if (preg_match($pattern, $url)) {
        $url = preg_replace($pattern, "", $url);
      }
      if (strstr($url, '?')) {
        $separator = '&';
      } else {
        $separator = '?';
      }
      if ($varValue."" != "") {
        $url .= "{$separator}{$varName}={$varValue}";
      }
    }
    return $url;
  }
  
  static public function getCurrentLanguageId() {
    if (isset($_SESSION['CURRENT_LANGUAGE_ID']) && $_SESSION['CURRENT_LANGUAGE_ID'] > 0) {
      return $_SESSION['CURRENT_LANGUAGE_ID'];
    }
    return Config::DEFAULT_LANGUAGE_ID;
  }
  /**
	 * 取得用户的ip地址
	 *
	 * @access public
	 * 
	 * @return string
	 */
  public static function getClientIp() {
    static $client_ip;
    if (!empty($client_ip)) {
      return $client_ip;
    }

    if(getenv('HTTP_CLIENT_IP') && strcasecmp(getenv('HTTP_CLIENT_IP'), 'unknown')) {
      $client_ip = getenv('HTTP_CLIENT_IP');
    } elseif(getenv('HTTP_X_FORWARDED_FOR') && strcasecmp(getenv('HTTP_X_FORWARDED_FOR'), 'unknown')) {
      $client_ip = getenv('HTTP_X_FORWARDED_FOR');
    } elseif(getenv('REMOTE_ADDR') && strcasecmp(getenv('REMOTE_ADDR'), 'unknown')) {
      $client_ip = getenv('REMOTE_ADDR');
    } elseif(isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], 'unknown')) {
      $client_ip = $_SERVER['REMOTE_ADDR'];
    }
    $client_ip = preg_replace("/^([\d\.]+).*/", "\\1", $client_ip);
    return $client_ip;
  }

  /**
	 * 页面重定向
	 *
	 * @param string $url 重定向链接
	 * @return void
	 * @access public
	 * @static 
	 */
  public static function redirect($url, $target_window = 'self') {
    if ($target_window == 'self') {
      $is_sent = headers_sent();
      if($is_sent == false) {
        header("Location: {$url}");
      } else {
        print "<meta http-equiv=\"refresh\" content=\"0; url={$url}\">\n";
      }
    } elseif ($target_window == 'top') {
      echo "<script language='javascript' type='text/javascript'>";
      echo "top.location.href='{$url}';";
      echo "</script>";
    }
    exit;
  }
}