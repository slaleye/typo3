<?php

namespace Slaleye\Memory\Task;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Scheduler\Task\AbstractTask;

class LatestHighscoreTask extends AbstractTask
{
    protected $adminEmail;

    /**
     * @var \Slaleye\Memory\Domain\Repository\HighscoreRepository;
     *
     */
    protected $highscoreRepository;
    /**
     * Task that sends the Highscore data via Email
     * @return bool|void
     */
    public function execute()
    {
        // Scheduler does not support @inject , need to initialize the repository manually
        //Ini
        $this->initialize();
        // #1 get higschore data
        $highscoreData = $this->highscoreRepository->findAll();

        $result = true;
        //Send data to admin
        if($highscoreData)
        {// All  scheduled tasks are run by the Scheduler in a queue,
          // if not properly added the queue line can be interrupted and break other tasks
            try
            {
                $this->sendHighscoreToAdmin($highscoreData,$this->adminEmail);
                $result = true;
            }catch(\Exception $e) {
                $result = false;
            }

        }

    }

    /**
     * Initialiye task
     */
    protected function initialize()
    {
        $this->adminEmail = 'admin@slaleye.com';
        if(!$this->highscoreRepository)
        { // Repository is not already initialize
            // create instance from the ObjectManager
            $objectManager = GeneralUtility::makeInstance(\TYPO3\CMS\Extbase\Object\ObjectManager::class);
            // Use objectManager to get instance of HighscoreRepository
            $this->highscoreRepository = $objectManager->get(\Slaleye\Memory\Domain\Repository\HighscoreRepository::class);
        }
    }

}