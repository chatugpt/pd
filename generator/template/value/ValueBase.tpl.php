<?php

$outCodes = '<?php
abstract class '.$moduleName.'ValueBase extends Value {
  //setup
  public $primary = "'.$primaryName.'";
  public $tableName = "'.$table.'";
  public $fieldMap = array(
';
$i = 0;
foreach ($fieldList as $field)
{
  if ($i == 0) {
    $outCodes .= '    "'.$field->name.'"';
  } else {
    $outCodes .= '    ,"'.$field->name.'"';
  }

  $outCodes .= "\n";
  $i++;
}
$outCodes .= '
  );


  //fields
  ';
$outCodes .= "\n";
foreach ($fieldList as $field)
{
  if (($field->name=='created')||($field->name=='modified')||($field->name=='status'))
  {
    continue;
  }
  $outCodes .= '  public $'.$field->name.';';
  $outCodes .= "\n";
}
$outCodes .= '
  
  //methods
  public function getPrimary() {
    return $this->{$this->primary};
  }
  public function setPrimary($value) {
    $this->{$this->primary} = $value;
  }

';
$outCodes .= "\n";
foreach ($fieldList as $field)
{
  if (($field->name=='created')||($field->name=='modified')||($field->name=='status'))
  {
    continue;
  }
  $tmpField = ucwords(str_replace('_', ' ', $field->name));
  $tmpField = str_replace(' ', '', $tmpField);
  $outCodes .= '
  public function add'.$tmpField.'Condition($value, $condition) {
    $this->addFieldCondition("'.$field->name.'", $value, $condition);
  }';
  $outCodes .= "\n";
}
$outCodes .= '
}';
return $outCodes;
