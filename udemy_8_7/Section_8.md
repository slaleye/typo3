## Section 8 : Scheduler

Scheduler : Typo3 System extension to execute task
Background scripts

## 26 Creating a task

Create Task in Classes\Task
Extends \TYPO3\CMS\Scheduler\Task\AbstractTask
And override execute method
Initialize repository
--
REgister Scheduler task in ext_localconf

If Scheduler Extension not installed by default, add install it in backend
--
IN Backend go to SYSTEM/Sheduler
Add Task
select Class: you should see under memory/Send  Latest Highscore

Type: single/Recurring
if single: can execute it Manually