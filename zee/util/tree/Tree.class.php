<?php
/*
$treeitems[] = array(
'id'=> 0,
'data'=>'root',
'parentId'=>-1
);

$treeitems[] = array
(
'id'=> 1,
'data'=>'node1',
'parentId'=>0
);


$treeitems[] = array
(
'id'=> 2,
'data'=>'node2',
'parentId'=>0
);

$treeitems[] = array
(
'id'=> 3,
'data'=>'node3',
'parentId'=>0
);

$treeitems[] = array
(
'id'=> 4,
'data'=>'node1-1',
'parentId'=>1
);

$treeitems[] = array
(
'id'=> 5,
'data'=>'node1-2',
'parentId'=>1
);

$treeitems[] = array
(
'id'=> 6,
'data'=>'node1-3',
'parentId'=>1
);

$treeitems[] = array
(
'id'=> 7,
'data'=>'node2-1',
'parentId'=>2
);

$treeitems[] = array
(
'id'=> 8,
'data'=>'node2-2',
'parentId'=>2
);

$treeitems[] = array
(
'id'=> 9,
'data'=>'node2-3',
'parentId'=>2
);

$treeitems[] = array
(
'id'=> 10,
'data'=>'node3-1',
'parentId'=>3
);

$treeitems[] = array
(
'id'=> 11,
'data'=>'node3-2',
'parentId'=>3
);

$treeitems[] = array
(
'id'=> 12,
'data'=>'node3-3',
'parentId'=>3
);

$treeitems[] = array
(
'id'=> 13,
'data'=>'node1-2-1',
'parentId'=>5
);

$treeitems[] = array
(
'id'=> 14,
'data'=>'node3-1-1',
'parentId'=>10
);

$treeitems[] = array
(
'id'=> 15,
'data'=>'node2-3-1',
'parentId'=>9
);
*/

class Tree
{
	private $data;
	private $nodes;
	private $tmpData;
	private $rootId;
	private $treeRoot;
	public $isActualRoot = false;

	public function getRootId()
	{
		return $this->rootId;
	}

	public function getRootNode()
	{
		return $this->treeRoot;
	}

	/**
	*
	* @param AbstractTreeNode[] $nodes
	* @param AbstractTreeNode $rootNode
	*/
	public function init($nodes, AbstractTreeNode $rootNode)
	{
		$this->data = $nodes;
		$this->rootId = $rootNode->id;
		$this->treeRoot = $rootNode;
	}

	public function getData()
	{
		return $this->data;
	}

	public function parse()
	{
		$this->tmpData = $this->data;
		$children = $this->fetchChildren($this->rootId);
		if(count($children) > 0)
		{
			$this->treeRoot->children = $children;
			return true;
		}
		else
		{
			return false;
		}
	}


	public function fetchChildren($parentId)
	{
		$childNodes = array();
		foreach($this->tmpData as $key=>$node)
		{
			if($node->parentId == $parentId)
			{
				unset($this->tmpData[$key]);

				$node->children = $this->fetchChildren($node->id);

				$childNodes[] = $node;
				$this->nodes[$node->id] = $node;
			}
		}
		return $childNodes;
	}
	public function getChildrenIds()
	{
		return $this->childrenIds;
	}
	public function getNodeArray()
	{
		return $this->nodes;
	}
	public function getLevel(AbstractTreeNode $node)
	{
		if( array_key_exists($node->id, $this->nodes))
		{
			$level = 1;
			while(true)
			{
				if($node->parentId != $this->rootId)
				{
					$level++;
					$node = $this->nodes[$node->parentId];
				}
				else
				{
					break;
				}
			}
			return $level;
		}
		else
		{
			return 0;
		}
	}

	public function getPath(AbstractTreeNode $node, $sign='/', $url=null)
	{
		if( array_key_exists($node->id, $this->nodes))
		{
			if (!$url)
			{
				$path = $node->getLabel();
			}
			else
			{
				$urlTmp = str_replace('%ID%', $node->id, $url);
				$path = "<a href=\"$urlTmp\">".$node->getLabel()."</a>";
			}
			while(true)
			{
				if($node->parentId != $this->rootId)
				{
					$node = $this->nodes[$node->parentId];
					if (!$url)
					{
						$path = $node->getlabel() . $sign . $path;
					}
					else
					{
						$urlTmp = str_replace('%ID%', $node->id, $url);
						$path = "<a href=\"$urlTmp\">".$node->getLabel()."</a>" . $sign . $path;
					}
				}
				else
				{
					if($this->isActualRoot)
					{
						if (!$url)
						{
							$path = $this->treeRoot->getlabel() . $sign . $path;
						}
						else
						{
							$urlTmp = str_replace('%ID%', $node->id, $url);
							$path = "<a href=\"$urlTmp\">".$this->treeRoot->getlabel()."</a>" . $sign . $path;
						}
					}
					break;
				}
			}
			return $path;
		}
		else
		{
			return "";
		}
	}
}

/*
$tree = new Tree();
$tree->init($treeitems, -1);
if($tree->parse())
{
echo "<pre>";
var_dump($tree->getTree());
echo "</pre>";
}

echo $tree->getLevel(14);
echo "<br>";
echo $tree->getPath(15);
echo "<br>";

echo "Node # 13";
echo "<br>";
echo "Level:" . $tree->getLevel(13);
echo "<br>";
echo "Path:" . $tree->getPath(13);
echo "<br>";
*/

/*
class EmailAddressValueNode extends TreeNode
{
public function __construct(EmailAddressValue $data)
{
$this->id = $data->id;
$this->parentId = $data->parentId;
$this->data = $data;
}

public function getLabel()
{
return $this->data->name;
}
}
*/
?>