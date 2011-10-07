<?php

class TemplateProcessor{

    // declare data members
    private $output;
    private $rowTag='p';
    private $tags;
    private $templateFile;
    private $cacheFile;
    private $expiry;
    
    public function __construct($tags=array(),$pageSections=array(), $path_to_templates, $path_to_cache) {
		if(count($tags)<1||count($pageSections)<1){
        	throw new Exception('Invalid number of parameters for template processor');
		}
		foreach($pageSections as $key=>$expiry){
			// define template files
			$this->templateFile[$key] = $path_to_templates.$key.'_template.htm';
			// define cache files
			$this->cacheFile[$key] = $path_to_cache.md5($key).'.txt';
			// assign cache expiration values
			$this->expiry[$key]=$expiry;
			// assign tags for replacement
			$this->tags[$key]=$tags[$key];
			// initialize page outputs
			$this->output[$key]='';
		}
		foreach($this->cacheFile as $key=>$cacheFile){
			// check if cache files are valid
			if($this->isCacheValid($key)){
				// read data from cache files
				$this->output[$key]=$this->readCache($key);
			} else {
				// read template files
				$this->output[$key]=file_get_contents($this->templateFile[$key]);
				// process template files
				$this->processTemplate($tags[$key],$key);
				// clean up empty tags
				$this->output[$key]=preg_replace("/{\w}|}/",'',$this->output[$key]);
				// write crunched data to cache files
				$this->writeCache($key);
			}
		}
	}
	
	// check validity of cache files
	private function isCacheValid($key){
		// determine if cache file is valid or not
		if(file_exists($this->cacheFile[$key])&&filemtime($this->cacheFile[$key])>(time()-$this->expiry[$key])){
			return true;
		}
		return false;
	}
	
	// process template file
	private function processTemplate($tags,$key){
		foreach($tags as $tag=>$data){
			// if data is array, traverse recursive array of tags
			if(is_array($data)){
				$this->output[$key]=preg_replace("/\{$tag/",'',$this->output[$key]);
				$this->processTemplate($data,$key);
			}
			// if data is a file, fetch processed file
			elseif(file_exists($data)){
				$data=$this->processFile($data);
			}
			// if data is a MySQL result set, obtain a formatted list of database rows
			elseif(@get_resource_type($data)=='mysql result'){
				$rows='';
				while($row=mysql_fetch_row($data)){
					$cols='';
					foreach($row as $col){
						$cols.='&nbsp;'.$col.'&nbsp;';
					}
					$rows.='<'.$this->rowTag.'>'.$cols.'</'.$this->rowTag.'>';
				}
				$data=$rows;
			}
			// if data contains the '[code]' elimiter, parse data as PHP code
			elseif(substr($data,0,6)=='[code]'){
				$data=eval(substr($data,6));
			}
			$this->output[$key]=str_replace('{'.$tag.'}',$data,$this->output[$key]);
		}
	}
	// process input file
	private function processFile($file){
		ob_start();
		include($file);
		$contents=ob_get_contents();
		ob_end_clean();
		return $contents;
	}
	// write compressed data to cache file
	private function writeCache($key){
		if(!$fp=fopen($this->cacheFile[$key],'w')){
			throw new Exception('Error writing data to cache file');
		}
		fwrite($fp,$this->getCrunchedHTML($key));
		fclose($fp);
	}
	// read compressed data from cache file
	private function readCache($key){
		if(!$cacheContents=file_get_contents($this->cacheFile[$key])){
			throw new Exception('Error reading data from cache file');
        }
		return $cacheContents;
	}
	// return overall output
	public function getHTML(){
		$html='';
		foreach($this->output as $output){
			$html.=$output;
		}
		return $html;
	}
	// return crunched output
	private function getCrunchedHTML($key){
		// crunch (X)HTML content compress it with gzip
		$this->output[$key]=preg_replace("/(\r\n|\n)/","",$this->output[$key]);
		// return compressed (X)HTML content
		return $this->output[$key];
	}
}

?>