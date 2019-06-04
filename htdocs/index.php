<?php
/**
 * Created by PhpStorm.
 * User: butvin
 * Date: 03.06.19
 * Time: 12:35
 * Author:	Sergey Butvin
 * Email:	butvin.sergey@gmail.com
 */

include 'lib/classTask.php';

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


