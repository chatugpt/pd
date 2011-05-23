<?php
$outCodes = '<?php
require_once "value/base/'.$moduleName.'ValueBase.class.php";
class '.$moduleName.'Value extends '.$moduleName.'ValueBase {
  public function getCreateOptions() {
    return array(
      "created" => ""
      ,"modified" => ""
      ,"status" => ""
';
foreach ($fieldList as $field)
{
	if (($field->name=='created') || ($field->name=='modified') || ($field->name=='status'))
	{
		continue;
	}
	if ($field->not_null)
	{
		$outCodes .= '	   	,"'.$field->name.'" => "required:ERROR.REQUIRED;"';
		$outCodes .= "\n";
		continue;
	}
	$outCodes .= '	    	, "'.$field->name.'" => ""';
	$outCodes .= "\n";
}
	
$outCodes .= '      );
  }

  public function getUpdateOptions() {
    return $this->getCreateOptions();
  }
}'
;

return $outCodes;
