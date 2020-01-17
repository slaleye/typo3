<?php


namespace Slaleye\Memory\Controller\Eid;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use function GuzzleHttp\json_encode;

class GameEidController extends AbstractEidController
{
    /**
     * @var \Slaleye\Memory\Domain\Repository\HighscoreRepository
     */
    protected $highscoreRepository;

    /**
     * {@inheritDoc}
     * @see \Slaleye\Memory\Controller\Eid\AbstractEidController::initialize()
     */
    public function initialize($inStoragePid)
    {
        parent::initialize($inStoragePid);

        if(!$this->highscoreRepository){
            $this->highscoreRepository = $this->objectManager->get(\Slaleye\Memory\Domain\Repository\HighscoreRepository::class);
            $querySettings = $this->highscoreRepository->createQuery()->getQuerySettings();

            if(is_numeric($inStoragePid) && $inStoragePid != 0){
                $storagePids = $querySettings->getStoragePageIds();
                $storagePids[] =$inStoragePid;
                $querySettings->setStoragePageIds($storagePids);
            }else{
                $querySettings->setRespectStoragePage(false); // Fetches all data regardless of the page where they are stored in
            }

            $this->highscoreRepository->setDefaultQuerySettings($querySettings);
        }
    }

    /**
     * Ajax Post request to save highscore
     * @param \TYPO3\CMS\Core\Http\ServerRequest $inRequest
     * @param \TYPO3\CMS\Core\Http\Response $inResponse
     * @return string
     */
    public function saveHighscore(\TYPO3\CMS\Core\Http\ServerRequest $inRequest, \TYPO3\CMS\Core\Http\Response $inResponse )
    {
        $postData = GeneralUtility::_POST('tx_memory_game');

        if(is_array($postData) && array_key_exists('highscore',$postData)
        && is_array($postData['highscore']) && array_key_exists('score',$postData['highscore'])
        && array_key_exists('username',$postData['highscore']))
        {
            // Initialize eID
            $this->initialize('3'); // This is the page id of the memory folder in the backend
            // Create new highscore
            $newHighscore = $this->objectManager->get(\Slaleye\Memory\Domain\Model\Highscore::class);

            // assign post data to new object
            $newHighscore->setUsername($postData['highscore']['username']);
            $newHighscore->setScore($postData['highscore']['score']);
            $newHighscore->setPid($this->pluginStruct->pid);

            // ASsign model to repository
            $this->highscoreRepository->add($newHighscore);

            // Close transaction will commit the new highscore to db
            $this->persistenceManager->persistAll();

            echo json_encode([
                'state' => 'success'
            ]);
        }else{
            echo json_encode([
                'ErrorCode' => 'error',
                'State' => 'error',
                'RawData' => json_encode($postData)
            ]);
        }
    }
}