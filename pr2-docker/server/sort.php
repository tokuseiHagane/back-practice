<?php
$array = $_GET['array']);
function quick_sort($array)
 {
	$loe = $gt = array();
	if(count($array) < 2)
	{
		return $array;
	}
	$pivot_key = key($array);
	$pivot = array_shift($array);
	foreach($array as $val)
	{
		if($val <= $pivot)
		{
			$loe[] = $val;
		}elseif ($val > $pivot)
		{
			$gt[] = $val;
		}
	}
	return array_merge(quick_sort($loe),array($pivot_key=>$pivot),quick_sort($gt));
}
$sorted_array = quick_sort($array);
echo ''.implode(',',$sorted_array);
?>