<?php
namespace Slaleye\Memory\Tests\Unit\Controller;

/**
 * Test case.
 *
 * @author Slaleye 
 */
class CardsControllerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
    /**
     * @var \Slaleye\Memory\Controller\GameController
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = $this->getMockBuilder(\Slaleye\Memory\Controller\GameController::class)
            ->setMethods(['redirect', 'forward', 'addFlashMessage'])
            ->disableOriginalConstructor()
            ->getMock();
    }

    protected function tearDown()
    {
        parent::tearDown();
    }

    /**
     * @test
     */
    public function listActionFetchesAllCardssFromRepositoryAndAssignsThemToView()
    {

        $allCardss = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->disableOriginalConstructor()
            ->getMock();

        $cardsRepository = $this->getMockBuilder(\Slaleye\Memory\Domain\Repository\CardsRepository::class)
            ->setMethods(['findAll'])
            ->disableOriginalConstructor()
            ->getMock();
        $cardsRepository->expects(self::once())->method('findAll')->will(self::returnValue($allCardss));
        $this->inject($this->subject, 'cardsRepository', $cardsRepository);

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $view->expects(self::once())->method('assign')->with('cardss', $allCardss);
        $this->inject($this->subject, 'view', $view);

        $this->subject->listAction();
    }
}
