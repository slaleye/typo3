<?php
namespace  Slaleye\Memory\Domain\Validator;

use Slaleye\Memory\Domain\Model\Highscore;
use TYPO3\CMS\Extbase\Validation\Validator\AbstractValidator;

/**
 * Class HighscoreValidator
 * Validates highscore object
 * @package Slaleye\Memory\Domain\Validator
 */
class HighscoreValidator extends AbstractValidator
{
    /**
     * Check if $highscore is valid value
     *
     * @param Highscore $newHighscore
     */
    protected function isValid($newHighscore)
    {

        // check user name, only of letters
        $username = $newHighscore->getUsername();
        // username may not be empty as already checkd in the Not empty validator
        // Also checks with preg_match() if start and end is between A-z and has a minium lenght of 1 -255
        if(empty($username) || preg_match('/^[A-z]{1,255}$/', $username) !== 1)
        {
            // an error occurred
            $this->addError(
                $this->translateErrorMessage('validator.highscore.invalidUsername','memory'), time());
        }


        // score is of integer, no floats or string
        $score = $newHighscore->getScore();
        if( $score == 0 || !is_numeric($score))
        {
            // an error occurred
            $this->addError(
                $this->translateErrorMessage('validator.highscore.invalidScore','memory'), time());
        }
    }


}