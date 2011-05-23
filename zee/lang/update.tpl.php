<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>语言工具</title>
</head>

<body>
<div style="width:960px; margin:0px auto;">
<form id="form1" name="form1" method="post" action="lang.php?action=update">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>语言工具</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="10%">Code</td>
    <td>
      <input type="text" name="language_content_code" size="50" value="<?php echo $languageContentValue->code;?>" readonly />    </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>Languages</td>
  </tr>
  <?php foreach ($languageList as $languageVo) {
    if ($languageContentValue->code) {
      $languageContentVoTmp = $languageContentService->getByLangIdAndCode($languageVo->id, $languageContentValue->code);
    }
  ?>
  <tr>
    <td><?php echo $languageVo->name;?></td>
    <td><textarea name="language_content_content[<?php echo $languageVo->id;?>]" rows="5" cols="50"><?php echo $languageContentVoTmp->content;?></textarea></td>
  </tr>
  <?php }?>
  <tr>
    <td>&nbsp;</td>
    <td><input type="submit" value="更 新" /></td>
  </tr>
</table>
</form>
</div>
</body>
</html>
