<?php
namespace Slaleye\Memory\Tests\Unit\Domain\Model;

/**
 * Test case.
 *
 * @author Slaleye 
 */
class CardsTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
    /**
     * @var \Slaleye\Memory\Domain\Model\Cards
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = new \Slaleye\Memory\Domain\Model\Cards();
    }

    protected function tearDown()
    {
        parent::tearDown();
    }

    /**
     * @test
     */
    public function getCardReturnsInitialValueForFileReference()
    {
        self::assertEquals(
            null,
            $this->subject->getCard()
        );
    }

    /**
     * @test
     */
    public function setCardForFileReferenceSetsCard()
    {
        $fileReferenceFixture = new \TYPO3\CMS\Extbase\Domain\Model\FileReference();
        $this->subject->setCard($fileReferenceFixture);

        self::assertAttributeEquals(
            $fileReferenceFixture,
            'card',
            $this->subject
        );
    }
}
