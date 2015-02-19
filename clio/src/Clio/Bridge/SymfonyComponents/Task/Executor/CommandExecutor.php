<?php
namespace Clio\Bridge\SymfonyComponents\Task\Executor;

use Clio\Component\Util\Task\Executor\AbstractExecutor;
use Clio\Component\Util\Task\Task;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface,
	Symfony\Component\Console\Input\ArrayInput
;
use Symfony\Component\Console\Output\OutputInterface,
	Symfony\Component\Console\Output\NullOutput
;

use Symfony\Component\Console\Application;
use Symfony\Bundle\FrameworkBundle\Console\FrameworkApplication;

/**
 * CommandExecutor 
 * 
 * @uses AbstractExecutor
 * @package { PACKAGE }
 * @copyright Copyrights (c) 1o1.co.jp, All Rights Reserved.
 * @author Yoshi<yoshi@1o1.co.jp> 
 * @license { LICENSE }
 */
class CommandExecutor extends AbstractExecutor 
{
	static protected $application;

	/**
	 * initApplication 
	 * 
	 * @param Application $application 
	 * @static
	 * @access public
	 * @return void
	 */
	static public function initApplication(Application $application = null)
	{
		if($application) {
			self::$application = $application;
		} else if(isset($GLOBALS['application'])) {
			$application = $GLOBALS['application'];

			if($application instanceof Application) {
				self::$application = $application;
			}
		}

		if(!self::$application) {
			// Create new Application
			$kernel = $GLOBALS['kernel'];
			if(!$kernel) {
				throw new \RuntimeException('There is no GLOBALS $kernel instance.');
			}
			self::$application = new FrameworkApplication($kernel);
		}
	}

	/**
	 * getApplication 
	 * 
	 * @static
	 * @access public
	 * @return void
	 */
	static public function getApplication()
	{
		if(!self::$application) {
			self::initApplication();
		}
		return self::$application;
	}

	/**
	 * command 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $command;

	/**
	 * input 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $input;

	/**
	 * output 
	 * 
	 * @var mixed
	 * @access protected
	 */
	protected $output;

	/**
	 * __construct 
	 * 
	 * @param mixed $command 
	 * @param mixed $input 
	 * @param OutputInterface $output 
	 * @access public
	 * @return void
	 */
	public function __construct($command = null, $input = null, OutputInterface $output = null)
	{
		$this->command = $command;

		if(is_array($input)) {
			$this->input = $input;
		} else if($input instanceof InputInterface) {
			$args = $input->getArguments();
			$opts = $input->getOptions();

			$this->input = array_merge($args, $options);
		} else {
			$this->input = array();
		}

		if(!$output) {
			$output = new NullOutput();
		}
		$this->output = $output;
	}

	/**
	 * doRun 
	 * 
	 * @param Task $task 
	 * @access protected
	 * @return integer ReturnCode
	 */
	protected function doRun(Task $task)
	{
		$app = self::getApplication();

		$args = $task->getArguments();
		
		$args = array_merge($this->input, array('command' => $this->command), $args);

		$command = $app->find($args['command']);
		
		return $command->run(new ArrayInput($args), $this->output);
	}
    
    /**
     * getCommand 
     * 
     * @access public
     * @return void
     */
    public function getCommand()
    {
        return $this->command;
    }
    
    /**
     * setCommand 
     * 
     * @param mixed $command 
     * @access public
     * @return void
     */
    public function setCommand($command)
    {
        $this->command = $command;
        return $this;
    }
    
    /**
     * getInput 
     * 
     * @access public
     * @return void
     */
    public function getInput()
    {
        return $this->input;
    }
    
    /**
     * setInput 
     * 
     * @param mixed $input 
     * @access public
     * @return void
     */
    public function setInput($input)
    {
        $this->input = $input;
        return $this;
    }
    
    /**
     * getOutput 
     * 
     * @access public
     * @return void
     */
    public function getOutput()
    {
        return $this->output;
    }
    
    /**
     * setOutput 
     * 
     * @param mixed $output 
     * @access public
     * @return void
     */
    public function setOutput($output)
    {
        $this->output = $output;
        return $this;
    }
}

