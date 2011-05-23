<?php
abstract class AbstractTreeNode
{
	public $id;
	public $data;
	public $parentId;
	public $children;
	public $childrenIds;
	public $leadSymbol;
	abstract public function getLabel();

	public function hasChild()
	{
		if(is_array($this->children) && count($this->children) > 0)
		{
			return true;
		}
		else
		{
			return false;
		}

	}
}
?>