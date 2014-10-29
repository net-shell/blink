<?php
 
namespace Ash\Extensions\Html;
 
class HtmlBuilder extends \Illuminate\Html\HtmlBuilder
{
    public function myHtmlMacro($value1, $value2)
    {
		return '<div class="panel panel-danger"><div class="panel-heading">Error 0xB075</div><div class="panel-body">Provider namespace could not be resolved.</div></div>';
		return '<' . $value1 . '>' . $value2 . '</' . $value1 . '>';
    }
}