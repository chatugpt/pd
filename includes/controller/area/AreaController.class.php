<?php
require_once "zee/util/ListPageHelper.class.php";
require_once "service/AreaService.class.php";

class AreaController extends Controller {
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
    $areaCondition = new AreaValue();
    //get data
    $areaService = new AreaService();
    $areaList = $areaService->getList($areaCondition, $listPageHelper);
    //view
    View::set("AreaList", $areaList);
    View::set("ListPageHelper", $listPageHelper);
    View::display("List");
  }
  public function doCreate() {
    View::display("Create");
  }
  public function doDelete() {
    $areaId = intval(Request::get("delete_area_id"));
    Zee::registry("DB")->exec('delete from area  where area_id= '.$areaId);
    Zee::redirect(Zee::url("area", "list"));
  }
  public function doCreateSubmit() {
    $areaService = new AreaService();
    $areaVo = Request::getValue("area", "AreaValue");
    //var_dump($areaVo);exit;
    if (!$areaVo->checkOptions($areaVo->getCreateOptions())) {
      View::set("AreaCreateValue", $areaVo);
      View::display("Create");
      return;
    }
    $areaVo = $areaService->create($areaVo);
    Zee::redirect(Zee::url("area", "list"));
  }
  public function doUpdate() {
    $areaService = new AreaService();
    $areaId = intval(Request::get("update_area_id"));
    $areaVo = $areaService->getByPrimary($areaId);
    View::set("AreaUpdateValue", $areaVo);
    View::display("Update");
  }
  public function doUpdateSubmit() {
    $areaService = new AreaService();
    $areaVo = Request::getValue("area", "AreaValue");
    //var_dump($areaVo);exit;
    if (!$areaVo->checkOptions($areaVo->getCreateOptions())) {
      View::set("AreaUpdateValue", $areaVo);
      View::display("Update");
      return;
    }
    $areaVo = $areaService->updateByPrimary($areaVo);
    Zee::redirect(Zee::url("area", "list"));
  }
  public function doView() {
    $areaService = new AreaService();
    $areaId = intval(Request::get("view_area_id"));
    $areaVo = $areaService->getByPrimary($areaId);
    View::set("AreaViewValue", $areaVo);
    View::display("View");
  }
}
