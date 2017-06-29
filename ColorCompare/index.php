<?php

date_default_timezone_set("Australia/Sydney");
require_once("ColorCompare.php");

// files to be tested
$filenames = array(	"images/test1.png", 
										"images/test2.png",
										"images/test3.png",
										"images/test4.png",
										"images/test5.png",
										"images/test6.png");
										
// max colors
$max_colors = 20;

// display the palette
print "<table width='300' border='1'><tr>
	<td colspan=\"2\"><b>Color Swatches</b></td></tr>";

foreach (ColorCompare::$swatches as $name => $color)
	print "<tr><td width='50%'>$name</td><td bgcolor='#$color'>&nbsp;</td></tr>\n";
	
print "</table><p><b>Test Images</b></p>
	<p>Max Colors = $max_colors
	<br>Threshold Filter = ".ColorCompare::$threshold_filter."%</p>";	

	
// loop through each test pattern
for ($i = 0; $i < count($filenames); $i++)
{
	print "<table><tr><td><img src='{$filenames[$i]}'></td>\n";
	$result = ColorCompare::compare($max_colors, $filenames[$i]);
	var_dump($result);
	print "<td><table width='200' border='1'>";
	
	if ($result == false)
		print "<tr><td>[failed]</td></tr>\n";
	else
	{	
		print "<tr><td><b>Color</b></td><td><b>Pixel Count</b></td></tr>";
		
		foreach ($result as $color => $count)
		{
			print "<tr><td width='50' bgcolor='#".ColorCompare::$swatches[$color]
				."'>&nbsp;</td><td>".$count."</td></tr>\n";
		}		
	}		
		
	print "</table></td></tr></table><br><hr><br>\n";	
}


?>