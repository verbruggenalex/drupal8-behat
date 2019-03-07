<?php

namespace VerbruggenAlex\Drupal8Behat\TaskRunner\Commands;

use OpenEuropa\TaskRunner\Commands\AbstractCommands;
use NuvoleWeb\Robo\Task as NuvoleWebTasks;
use OpenEuropa\TaskRunner\Contract\FilesystemAwareInterface;
use OpenEuropa\TaskRunner\Tasks as TaskRunnerTasks;
use OpenEuropa\TaskRunner\Traits as TaskRunnerTraits;
use Symfony\Component\Console\Input\InputOption;

/**
 * Class DrupalCommands.
 */
class BehatCommands extends AbstractCommands implements FilesystemAwareInterface
{
    use TaskRunnerTraits\ConfigurationTokensTrait;
    use TaskRunnerTraits\FilesystemAwareTrait;
    use TaskRunnerTasks\CollectionFactory\loadTasks;
    use TaskRunnerTasks\ProcessConfigFile\loadTasks;
    use NuvoleWebTasks\Config\loadTasks;

    /**
     * Run behat tests.
     *
     * @command behat:run-drupal8
     */
    public function drupalCoreBehat()
    {
        $taskCollection = [];
        $vendorFolder = 'vendor/verbruggenalex/drupal8-behat';
        $taskCollection[] = $this->taskProcessConfigFile("$vendorFolder/behat.yml.dist", "$vendorFolder/behat.yml");
        $taskCollection[] = $this->taskExec("./vendor/bin/behat -c $vendorFolder/behat.yml");

        
        return $this->collectionBuilder()->addTaskList($taskCollection);
    }
}
