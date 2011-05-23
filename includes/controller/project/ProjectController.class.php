<?php
require_once "zee/util/ListPageHelper.class.php";
require_once "service/ProjectService.class.php";

class ProjectController extends Controller {
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
    $projectCondition = new ProjectValue();
    $projectCondition->addCondition(' 1=1 ORDER BY father_id ASC');
    //get data
    $projectService = new ProjectService();
    $projectList = $projectService->getList($projectCondition, $listPageHelper);
    $projectCopy = $projectService->getList(new ProjectValue());
    //view
    View::set("ProjectCopy",$projectCopy);
    View::set("ProjectList", $projectList);
    View::set("ListPageHelper", $listPageHelper);
    View::display("List");
  }
  public function doCreate() {
    $projectService = new ProjectService();
    
    $projectlist = $projectService->getList(new ProjectValue());
    View::set("Projectlist",$projectlist);    
    View::display("Create");
  }
  public function doDelete() {
    $projectId = intval(Request::get("delete_project_id"));
    Zee::registry("DB")->exec('delete from project  where project_id= '.$projectId);
    Zee::redirect(Zee::url("project", "list"));
  }
  public function doCreateSubmit() {
     $projectService = new ProjectService();
    
    $projectlist = $projectService->getList(new ProjectValue());
    
    $projectService = new ProjectService();
    $projectVo = Request::getValue("project", "ProjectValue");
    //var_dump($projectVo);exit;
    if (!$projectVo->checkOptions($projectVo->getCreateOptions())) {
      View::set("Projectlist",$projectlist);
      View::set("ProjectCreateValue", $projectVo);
      View::display("Create");
      return;
    }
    $projectVo = $projectService->create($projectVo);
    Zee::redirect(Zee::url("project", "list"));
  }
  public function doUpdate() {
    $projectService = new ProjectService();
    
    $projectlist = $projectService->getList(new ProjectValue());
    
    $projectId = intval(Request::get("update_project_id"));
    $projectVo = $projectService->getByPrimary($projectId);

    View::set("Projectlist",$projectlist);
    View::set("ProjectUpdateValue", $projectVo);
    View::display("Update");
  }
  public function doUpdateSubmit() {
    $projectService = new ProjectService();
    $projectVo = Request::getValue("project", "ProjectValue");
    //var_dump($projectVo);exit;
    if (!$projectVo->checkOptions($projectVo->getCreateOptions())) {
      View::set("ProjectUpdateValue", $projectVo);
      View::display("Update");
      return;
    }
    $projectVo = $projectService->updateByPrimary($projectVo);
    Zee::redirect(Zee::url("project", "list"));
  }
  public function doView() {
    $projectService = new ProjectService();
    $projectId = intval(Request::get("view_project_id"));
    $projectVo = $projectService->getByPrimary($projectId);
    View::set("ProjectViewValue", $projectVo);
    View::display("View");
  }
}
