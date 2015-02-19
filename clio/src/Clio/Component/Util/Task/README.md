# Task Component


```
$taskManager = new TaskManager(new QueuedTaskScheduler($queue, $resultMapStorage));

$task = new Task('task.name', array('arg1' => 'foo', 'arg2' => 'bar'));

// now task is managed under the manager
// which means now, $task is ManagedTask instance
$managedTask = $taskManager->scheduleTask($task);

// cancel the scheduled task.
$taskManager->deschedule($task);

// Wait until the task end.
$managedTask->wait();

// Execute task without schedule.
$task = $taskManager->execute($task);
```
