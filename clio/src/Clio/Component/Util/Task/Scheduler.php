<?php
namespace Clio\Component\Util\Task;

use Clio\Component\Util\Task\Task,
	Clio\Component\Util\Task\TaskManager,
	Clio\Component\Util\Task\Task\ScheduledTask;

interface Scheduler
{
	function scheduleTask(Task $task);

	function descheduleTask(ScheduledTask $task);

	function waitFor(ScheduledTask $task);

	function getManager();

	function setManager(TaskManager $manager);
}

