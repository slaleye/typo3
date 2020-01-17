<?php

namespace Slaleye\Memory\Task;

use TYPO3\CMS\Core\Mail\MailMessage;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Persistence\QueryResultInterface;
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
       // $highscoreData = $this->highscoreRepository->findAll();
        $highscoreData = $this->highscoreRepository->findLatestHighscore(); //returns one


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
            // Disable the findAll query to look into a specific storage pid by setting the settings to false
            $querySettings = $this->highscoreRepository->createQuery()->getQuerySettings();
            $querySettings->setRespectStoragePage(false);
            $this->highscoreRepository->setDefaultQuerySettings($querySettings);

        }
    }

    /**
     * @param QueryResultInterface $highscoredata
     * @param string $adminEmailstr
     * @return mixed
     */
    protected  function sendHighscoreToAdmin($highscoredata,$adminEmail)
    {
        $mail = GeneralUtility::makeInstance(MailMessage::class);

        $bodyText = $this->createBodyText($highscoredata);
        $mail->setSubject('memory: Latest Highscore');
        $mail->setFrom(['memory@slaleye.com' => 'Slaleye']);
        $mail->setTo(array($adminEmail));
        $mail->setBody($bodyText); // can be HTML or plaintext
        echo '<br><br><br><br><h4>'.($bodyText).')</h4>';
       // return $mail->send();
        return 'OK';

    }

    /**
     * Create the email body
     * @param QueryResultInterface $highscoredata
     */
    private function createBodyText($highscoredata)
    {
        $bodyText = '';
        if($highscoredata){
            $highscoreDataArray = $highscoredata->toArray();
            /**
             * @var \Slaleye\Memory\Domain\Model\Highscore $highscore
             */
            foreach ($highscoreDataArray as $highscore){
                if(!empty($bodyText))
                {
                    $bodyText .= "\n\n ----------" ; //php only adds new line if you use double quotes
                }
                $bodyText .= ' ID: ' . $highscore->getUId();
                $bodyText .= "\n" ;
                $bodyText .= ' Username: ' . $highscore->getUsername();
                $bodyText .= "\n" . $highscore->getUId();
                $bodyText .= ' Score:' . $highscore->getSCore();
            }
        }
        return $bodyText;
    }
}