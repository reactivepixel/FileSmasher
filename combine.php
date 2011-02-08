<?php
/*====================================================================================
	Title: 		File Smasher
	Version: 	1.0
	Date: 		10.5.2010
	Created:	Christopher Chapman												
	Email: 		cchapman@fulsail.com
====================================================================================
	This work is licensed under a Creative Commons GNU General Public License License. 
	Please use, share, distribute or modify this in any way. Enjoy!
	http://creativecommons.org/licenses/GPL/2.0/
====================================================================================*/

function cleanWhiteSpace($input){
	$input = ereg_replace("/\n\r|\r\n|\n|\r/", " ", $input);	// remove line breaks
	$input = preg_replace('/\s\s+/', ' ',$input);				// remove all double spaces.
	$input = preg_replace("/\t/", "", $input); 					// remove tabs
	return $input;
}

function fileSmash($aryFiles){
	$aryReturnTypes = array();									// instantiate the return ary
	
	foreach($aryFiles as $key=>$value){							// loop the ary of files passed
		if(!strpos($value, $_SERVER['DOCUMENT_ROOT'])){			// detect if a doc root was provided
			$value = $_SERVER['DOCUMENT_ROOT']. "/" .$value;	// attach doc root making the path
		}
		$fileData = cleanWhiteSpace(file_get_contents($value));	// get the contents of the targeted file + strip whitespace
		$tmpAry = explode(".",$value);							// explode path
		$ext = strtolower($tmpAry[count($tmpAry)-1]);			// determin extention of file. force to lowercase to avoid issues with Capitalization diffrences.
		if(!array_key_exists($ext,$aryReturnTypes)){			// check to see if the extention has already been hit in this loop
			$aryReturnTypes[$ext]="";							// instantiate the var
		}
		$aryReturnTypes[$ext].= $fileData;						// append the contents of the file to the already provided data
	}
	return $aryReturnTypes;
}

/* 	Usage */
// 	specify any combination of files within the Array passed to file smasher... 
//	An aray keyed to the provided extentions will be retuned where identical 
//	extentioned files will be trimmed of white space, tabs and new lines.
 	$aryCombine = fileSmash(array("/inc/style.css","/inc/fake.css")); 
 	echo "<style type='text/css'>";
	echo $aryCombine['css'];
 	echo "</style>";
 
 	echo "<script type='text/javascript'>";
	echo $aryCombine['js'];
 	echo "</script>";
 