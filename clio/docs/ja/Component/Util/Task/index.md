# Taskコンポーネント

Taskコンポーネントは、処理のタスク化に向けた、共通コンポーネントです。


## タスクの種類

タスクの実行方法には、幾つかの可能性があります。

  - InProcessで処理されるタスク
  - batchなどにより処理される非同期タスク
  - MessageQueueなどを用いて処理される分散非同期タスク

これらの振る舞いは、そのタスクではなく、スケジューラによって決定されるべきだと考えました。

```
// Create TaskManager with default "inProcess" TaskScheduler 
$taskManager = new TaskManager(new QueuedTaskScheduler(new SimpleQueue(), new SimpleMap()), 'inProcess');
// Add Scheduler using Celery TaskQueue
$taskManager->addScheduler('celery.async', new CeleryTaskScheduler($celeryClient));
// Using Doctrine ORM as 
$taskManager->addScheduler('batch', new QueuedTaskScheduler(new DoctrineOrmQueue($taskQueueRepository), new DoctrineMap($taskStatusRepository));


// Create task
$task = new Task('task1', array('arg1' => 'arg1'), array('opt1' => 'option1'));

// ScheduleTask with "inProcess"
$scheduledTask = $taskManager->scheduleTask($task);

$scheduledTask = $taskManager->scheduleTask($task, 'celery.async');

// Wait until the task is exected.
$scheduledTask->wait();
```

## タスクの実行
タスクの実行は、Executorクラスが行います。  
Executorクラスは、タスク（名によって一意なタスク）によって決定されます。


```
$taskManager->setExecutor('echo', new EchoExecutor());

 $taskManager->setExecutor('console.echo', new ConsoleExecutor('command:echo', array('arg' => 'arg1', '--option' => 'option1')));
 
 $taskManager->setExecutor('process.echo', new ProcessExecutor('echo "hello"'));
 

```