<?php
$cwd = dirname(__FILE__);

function clean_source($source) {
	$replace = array(
	   "\n\n"  => "\n",
	   "<?php" => "",
	   "?>"    => ""
	);
	$source = str_replace(array_keys($replace), array_values($replace), $source);

	$source =  trim($source);

	// remove comments
	$source = preg_replace("@/\*.*\*/@smU", " ", $source);

    return $source;
}

class FileFilter extends FilterIterator {
    public function accept() {
        $current = (string)$this->current();
        if (substr($current, -4) != '.php') {
            return false;
        }
        return true;
    }
}

$output = "<?php \n";

$path  = realpath($cwd .'/../application/domain');
$files = new FileFilter(new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path)));
foreach($files as $file) {
    $path    = $file->getPathname();
    $buffer  = file_get_contents($path);

    var_dump($path);

    $buffer = clean_source($buffer);

    $output .= $buffer ."\n";
}


var_dump( file_put_contents($cwd ."/../generated/domain.php", $output) );
