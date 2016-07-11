<?php
namespace LineBotCallback\Shell;

use Cake\Console\Shell;

/**
 * Message shell command.
 */
class MessageShell extends Shell
{
	public $tasks = ['LineBotCallback.Parse'];

    public function getOptionParser()
    {
        $parser = parent::getOptionParser();

        return $parser;
    }

    /**
     * main() method.
     *
     * @return bool|int Success or error code.
     */
    public function main() 
    {
        $this->Parse->main();
    }
}
