<?php
return '<?php
require_once "zee/util/ListPageHelper.class.php";
require_once "service/'.$moduleName.'Service.class.php";

class '.$moduleName.'Controller extends Controller {
  public function doIndex() {
    $this->doList();
  }
  public function doList() {
    //list
    $listPageHelper = new ListPageHelper();
    $listPageHelper->pageSize = 10;
    $pageNum = intval(Request::get("page"));
    $listPageHelper->pageNum = $pageNum?$pageNum:1;
    //Condition
    $'.$moduleVarName.'Condition = new '.$moduleName.'Value();
    //get data
    $'.$moduleVarName.'Service = new '.$moduleName.'Service();
    $'.$moduleVarName.'List = $'.$moduleVarName.'Service->getList($'.$moduleVarName.'Condition, $listPageHelper);
    //view
    View::set("'.$moduleName.'List", $'.$moduleVarName.'List);
    View::set("ListPageHelper", $listPageHelper);
    View::display("List");
  }
  public function doCreate() {
    View::display("Create");
  }
  public function doCreateSubmit() {
    $'.$moduleVarName.'Service = new '.$moduleName.'Service();
    $'.$moduleVarName.'Vo = Request::getValue("'.$table.'", "'.$moduleName.'Value");
    //var_dump($'.$moduleVarName.'Vo);exit;
    if (!$'.$moduleVarName.'Vo->checkOptions($'.$moduleVarName.'Vo->getCreateOptions())) {
      View::set("'.$moduleName.'CreateValue", $'.$moduleVarName.'Vo);
      View::display("Create");
      return;
    }
    $'.$moduleVarName.'Vo = $'.$moduleVarName.'Service->create($'.$moduleVarName.'Vo);
    Zee::redirect(Zee::url("'.$table.'", "list"));
  }
  public function doUpdate() {
    $'.$moduleVarName.'Service = new '.$moduleName.'Service();
    $'.$moduleVarName.'Id = intval(Request::get("update_'.$table.'_id"));
    $'.$moduleVarName.'Vo = $'.$moduleVarName.'Service->getByPrimary($'.$moduleVarName.'Id);
    View::set("'.$moduleName.'UpdateValue", $'.$moduleVarName.'Vo);
    View::display("Update");
  }
  public function doUpdateSubmit() {
    $'.$moduleVarName.'Service = new '.$moduleName.'Service();
    $'.$moduleVarName.'Vo = Request::getValue("'.$table.'", "'.$moduleName.'Value");
    //var_dump($'.$moduleVarName.'Vo);exit;
    if (!$'.$moduleVarName.'Vo->checkOptions($'.$moduleVarName.'Vo->getCreateOptions())) {
      View::set("'.$moduleName.'UpdateValue", $'.$moduleVarName.'Vo);
      View::display("Update");
      return;
    }
    $'.$moduleVarName.'Vo = $'.$moduleVarName.'Service->updateByPrimary($'.$moduleVarName.'Vo);
    Zee::redirect(Zee::url("'.$table.'", "list"));
  }
  public function doView() {
    $'.$moduleVarName.'Service = new '.$moduleName.'Service();
    $'.$moduleVarName.'Id = intval(Request::get("view_'.$table.'_id"));
    $'.$moduleVarName.'Vo = $'.$moduleVarName.'Service->getByPrimary($'.$moduleVarName.'Id);
    View::set("'.$moduleName.'ViewValue", $'.$moduleVarName.'Vo);
    View::display("View");
  }
}
';