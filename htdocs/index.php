<?php
/**
 * Created by PhpStorm.
 * User: butvin
 * Date: 03.06.19
 * Time: 12:35
 * Author:	Sergey Butvin
 * Email:	butvin.sergey@gmail.com
 * Class:	TestTask is the result of the test
 */

class TestTask {
	/**
	 * Private variables for class operations
	 * @var $_inputString (string)
	 * @var $_jump (integer)
	 * @var $_path; (string)
	 *    example: /test/ or /some/another/path/
	 * @var $_suffix (string)
	 *    example: .txt|.log|.abc
	 */
	private $_inputString;
	private $_jump;
	private $_path;
	private $_suffix;
	/**
	 * @const STR is reserved string for Task #2
	 */
	const STR = 'This server has 386GB RAM and 5000 GB storage';

	/**
	 * Setter for private variable $_inputString
	 * Task #1
	 * @param string $string
	 */
	public function setString(string $string) {
		$this->_inputString = $string;
	}

	/**
	 * Getter for private variable $_inputString
	 * Task #1
	 * @return string
	 */
	public function getString():string {
		return $this->_inputString;
	}

	/**
	 * Setter for private variable $_jump
	 * Task #1
	 * @param int $jump
	 */
	public function setJump(int $jump) {
		$this->_jump = $jump;
	}

	/**
	 * Getter for private variable $_jump
	 * Task #1
	 * @return int
	 */
	public function getJump():int {
		return $this->_jump;
	}

	/**
	 * @param string $path
	 * Task #3
	 * Setter for private variable $_path
	 */
	public function setPath(string $path){
		$this->_path = $path;
	}

	/**
	 * Getter for private variable $_path
	 * Task #3
	 * @return string
	 */
	public function getPath():string {
		return $this->_path;
	}

	/**
	 * Setter for private variable $_suffix
	 * Task 3
	 * @param string $suffix
	 */
	public function setSuffix(string $suffix){
		$this->_suffix = $suffix;
	}

	/**
	 * Getter for private variable $_suffix
	 * Task 3
	 * @return string
	 */
	public function getSuffix():string {
		return $this->_suffix;
	}

	/**
	 * A method that returns an array with all variations of consecutive words,
	 * in string, starting with 2
	 * @param string $inputString
	 * @param int $jump
	 * @return array
	 */
	public function generateArray(string $inputString = '', int $jump = 2):array {

		$inputString = $this->getString() ? $this->getString() : $inputString;
		$jump = $this->getJump() ? $this->getJump() : $jump;

		$outputArray =[];
		/** @var $inputArray - contains array, where each element is a world of input string */
		$inputArray = explode(' ', trim($inputString));
		$num = count($inputArray);
		if ($num <= $jump) return $inputArray;
		$lastIndex = $num -1;
		while ( $jump <= $num){
			$i = 0;
			while ( $i <= $lastIndex ) {
				$item = array_slice($inputArray, $i, $jump);
				if (count($item) != $jump) break;
				$outputArray[] = implode(' ', $item);
				$i++;
			}
			$jump++;
		}
		return $outputArray;
	}

	/**
	 * Implement an algorithm for extracting numeric values and dimensions from a string
	 * @return array
	 */
	static public function cutNumbers():array {
		$string = self::STR;
		// $string = str_replace(',', '.', $string);
		/** @var $regex - contain RegExp for cut natural numbers and dimensions with or
		 * without space.
		 */
		$regex = '((\d\.)?\d+\s*(GB))';
		preg_match_all($regex, $string, $matches);
		return $matches[0];
	}

	/**
	 * @param string $path
	 * @param string $suffix
	 * @return array
	 */
	public function sortFiles(string $path = '/test/', string $suffix = '.txt'):array {

		$path = $this->getPath() ? $this->getPath() : $path;
		$suffix = $this->getSuffix() ? $this->getSuffix() : $suffix;
		/** @var  $filePath - contain full path to folder */
		$filePath = $_SERVER['DOCUMENT_ROOT'] . trim($path);
		$files = [];
		/** @var  $file - contains all files with @var $suffix*/
		foreach(glob($filePath . '*' . trim($suffix)) as $file) {
			$fileName = basename($file, $suffix);
			/** Get all files with only numbers and latin letters */
			if(preg_match('/^[A-Za-z0-9\d]+$/', $fileName) == true){
				$fileSize = filesize($file);
				/** As a key is size of the file. It gives better filtering by file size */
				$files[$fileSize] = $fileName . $suffix . "\t size: " . $fileSize . ' bytes';
			}
		}
		krsort($files);
		return $files;
	}

	/**
	 * Static function for array printing
	 * @param array $array
	 * @param bool $files
	 */
	static public function output(array $array, $files = false) {
		if (!$array && empty($array)) echo "empty array";

		if ($files === true) {
			$i = 1;
			echo "<pre>";
			foreach ($array as $key => $value) {
				echo "{$i}\t"."{$value}\n";
				$i++;
			}
			echo "</pre>";
		} else {
			echo "<pre>";
			print_r($array);
			echo "</pre>";
		}
	}
}



echo "Task #1";
echo "<hr>";
$task_1 = new TestTask;
$str = 'A lead generating website';
$task_1->setString($str);
$task_1->setJump(2);
$arr = $task_1->getString();
TestTask::output($task_1->generateArray($arr));

echo "Task #2";
echo "<hr>";
TestTask::output(TestTask::cutNumbers());

echo "Task #3";
echo "<hr>";
$task_3 = new TestTask();
$task_3->setPath('/test/');
$task_3->setSuffix('.txt');
TestTask::output($task_3->sortFiles(), true);


