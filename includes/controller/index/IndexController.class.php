<?php
require_once "zee/util/ListPageHelper.class.php";
require_once "service/MessageService.class.php";

class IndexController extends Controller {
  public function doIndex() {
    View::display("Index");
  }
}
