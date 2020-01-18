<?php


namespace Slaleye\Memory\Controller;


use Slaleye\Memory\Domain\Repository;
use TYPO3\CMS\Core\Utility\DebugUtility;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;

class HighscoreController extends ActionController
{


    /**
     * HighscoreRepository
     * @var \Slaleye\Memory\Domain\Repository\HighscoreRepository
     * @inject
     */
    protected $highscoreRepository = null;

    // Two types of intiliaze function global and specific that will be called before the action
    // initializeAction() and initializeActionnameAction()

    /**
     * Intialize function for leaderboardAction
     *
     */
    public function initializeLeaderboardAction()
    {
        // Will make repository show all the objects regardless of their storage page
        $querySettings = $this->highscoreRepository->createQuery()->getQuerySettings();
        $querySettings->setRespectStoragePage(false);
        // Reorder the result by score
        $this->highscoreRepository->setDefaultOrderings([
            'score' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_DESCENDING
        ]);
        $this->highscoreRepository->setDefaultQuerySettings($querySettings);
    }
    public function leaderBoardAction()
    {
        //fetch all highscore data from repository
        $highscores = $this->highscoreRepository->findAll(); // By using @inject there is no need to intiliaze the repository
        // check if any data was in the db
        if($highscores->count() == 0)
        {
            // print empty message , typo3 method to alert user
            $this->addFlashMessage(
                LocalizationUtility::translate('module.highscore.no_entries', $this->extensionName),
                '',
                \TYPO3\CMS\Core\Messaging\AbstractMessage::INFO
            );
        }
      //  DebugUtility::debug($highscores->toArray()); // TYPO3 debugger  uses current namespace to print out variable
        //assign highscore to view
        $this->view->assign('highscores',$highscores);

    }

}