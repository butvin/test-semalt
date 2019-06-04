<?php
/**
 * Created by PhpStorm.
 * User: butvin
 * Date: 03.06.19
 * Time: 12:35
 * Author:	Sergey Butvin
 * Email:	butvin.sergey@gmail.com
 */

/**
 *
 */
include 'lib/classTask.php';

echo "Task #1";
echo "<hr>";
$task = new Test\TestTask;

$string = 'A lead generating website';
$task->setString($string);
$task->setJump(2);
$jump = (int)$task->getJump();
$str = $task->getString();

Test\TestTask::output($task->generateArray($str, $jump));

echo "Task #2";
echo "<hr>";
$arrayData = Test\TestTask::cutNumbers();
Test\TestTask::output($arrayData);

echo "Task #3";
echo "<hr>";
$task->setPath('/test/');
$path = $task->getPath();
$task->setSuffix('.txt');
$suffix = $task->getSuffix();
$data = $task->sortFiles($path, $suffix);
Test\TestTask::output($data, true);