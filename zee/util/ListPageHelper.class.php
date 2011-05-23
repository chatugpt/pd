<?php
class ListPageHelper {
  public $pageSize;
  public $pageNum;
  public $totalRow;
  public $isPagination;
  public $varName = 'page';

  const DEFAULT_PAGE_SIZE = 20;


  public function __construct() {
    $this->pageSize = self::DEFAULT_PAGE_SIZE ;
    $this->isPagination = true;
  }
  public function getTotalPage() {
    if($this->totalRow < 1) {
      return 0;
    }
    if($this->isPagination && $this->pageSize > 0) {
      return ceil($this->totalRow / $this->pageSize);
    } else {
      return 1;
    }
  }

  /**
	 * Generate SQL where statement for retrieve one page of records.
	 *
	 * @param String $inCondition - query condition
	 * @return String
	 */
  public function genPageSQL($inCondition) {
    $this->adjustPageNum();
    if($this->pageSize > 0) {
      $startRow = ($this->pageNum - 1) * $this->pageSize;
      $outCondition = "{$inCondition} limit {$startRow}, {$this->pageSize}";
      return $outCondition;
    } else {
      return $inCondition;
    }
  }

  public function adjustPageNum() {
    if($this->totalRow > 0 && $this->pageSize > 0) {
      $maxPageNum = ceil($this->totalRow / $this->pageSize);
      if($this->pageNum > $maxPageNum) {
        $this->pageNum = $maxPageNum;
      }
    } else {
      $this->pageNum = 1;
    }
  }

  public function jumpSelect()
  {
    $totalPage = $this->getTotalPage();
    $url = Zee::getCurrentUrl(array($this->varName => ""));
    if (strstr($url, '?')) {
      $separator = '&';
    } else {
      $separator = '?';
    }
    $jumpString  = "转到";
    $jumpString .= "<select id=\"jump_select\" size=\"1\" onChange=\"window.location='{$url}{$separator}{$this->varName}='+this.value\">";
    for($i = 1; $i <= $totalPage; $i++) {
      /**选中当前页*/
      if($this->pageNum == $i) {
        $extra = "selected";
      } else {
        $extra = "";
      }
      $jumpString .= "<option value='".$i."' ".$extra.">".$i."</option>";
    }
    if (!$totalPage) {
      $jumpString .= "<option selected>  </option>";
    }
    $jumpString .= "</select> 页";
    return $jumpString;
  }

  public function pageStat() {
    $totalPage = $this->getTotalPage();
    $statString  = "共有 ".$this->totalRow." 条记录  ";
    $statString .= "当前第 ".$this->pageNum." 页/共有 ".$totalPage." 页 ";
    $statString .= "每页显示 ".$this->pageSize." 条";
    return $statString;
  }

  public function toHTML() {
    $pageNum = $this->pageNum;
    $totalPage = $this->getTotalPage();
    return $this->jumpSelect();
  }
}