<?php
namespace Clio\Component\Task;

use Clio\Component\Task\Task,
	Clio\Component\Task\TaskManager,
	Clio\Component\Task\Task\ScheduledTask;

interface Scheduler
{
	function scheduleTask(Task $task);

	function descheduleTask(ScheduledTask $task);

	function waitFor(ScheduledTask $task);

	function getManager();

	function setManager(TaskManager $manager);
}

