<?php
require_once("lib/util/tree/Tree.class.php");

class HTMLTreeHelper
{
	const TREE_PERSENTATION_STYLE_HIERARCHICAL = "hierarchical";
	const TREE_STYLE_HIERARCHICAL_SPACE = "hierarchical_space";
	const TREE_ROOT_SYMBOL = '/';

	static public $urlTemplate = null;
	static public function coverToOptionList(Tree $tree, $style)
	{
		$root = $tree->getRootNode();
		$outOptions = self::genOptions($tree, $root, $style);
		//if($root->id == -1)
		//{
		//	unset($outOptions[0]);
		//}
		return $outOptions;
	}

	static public function genOptions(Tree $tree, AbstractTreeNode $root, $style)
	{
		$options = array();
		$option = self::genOption($tree, $root, $style);
		if ($option instanceof Option)
		{
			$options[] = $option;
		}
		if (count($root->children))
		{
			foreach($root->children as $child)
			{
				$childOptions = self::genOptions($tree, $child, $style);
				if(count($childOptions) > 0)
				{
					$options = array_merge($options, $childOptions);
				}
			}
		}
		return $options;
	}

	static public function genOption(Tree $tree, AbstractTreeNode $node, $style)
	{
		$option = new Option();
		if($node->id != $tree->getRootId())
		{
			$option->data = $node->data;
		}
		switch ($style)
		{
			case self::TREE_PERSENTATION_STYLE_HIERARCHICAL :
				{
					$option->key = $node->id;
					if($node->id == $tree->getRootId())
					{
						return null;
					}
					else
					{
						$level = $tree->getLevel($node);
						$outString = "";
						$outString = '|'. str_repeat('&nbsp;&nbsp;&nbsp;|', $level-1).'---';
						$option->value = $outString . $node->getLabel();
					}
					break;
				}
			case self::TREE_STYLE_HIERARCHICAL_SPACE :
				{
					$option->key = $node->id;
					if($node->id == $tree->getRootId())
					{
						return null;
					}
					else
					{
						$level = $tree->getLevel($node);
						$treeIcon = "";
						if ($level==1)
						{
							$treeIcon = "<img src=\"template/default/images/list_first.gif\" align=\"absmiddle\" />";
						}
						elseif ($level==2)
						{
							$treeIcon = "<img src=\"template/default/images/list_second.gif\" align=\"absmiddle\" />";
						}
						else
						{
							$treeIcon = "<img src=\"template/default/images/list_third.gif\" align=\"absmiddle\" />";
						}
						$outString = "";
						$outString = str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', $level-1);
						if (self::$urlTemplate)
						{
							$url = str_replace('%ID%', $node->id, self::$urlTemplate);
							$targetType = '';
							if ($node->getType() == ListService::TYPE_LINK)
							{
								$targetType = 'target="_blank"';
							}
							$option->value = "{$outString}{$treeIcon}<a href=\"{$url}\" {$targetType}>".$node->getLabel()."</a>";
						}
						else
						{
							$option->value = $outString.$treeIcon.$node->getLabel();
						}
					}
					break;
				}
		}
		return $option;
	}
}


class Option
{
	public $key;
	public $value;
	public $data;
}
?>