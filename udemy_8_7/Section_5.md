## Creation and Configuration of an Extension

05_12_2020

Create Main page
set behaviour as "root tree"

Go to template
Edit Setup.ts
Instead of breaking the whole page when an exception occurs,
 an error message is shown for the part of the page that is broken. Be aware that unlike before, it is now possible that a page with error message gets cached.
````
page.config.contentObjectExceptionHandler = 0

````

To disable Composer Mode install for Extensiosn only:
vendor/typo3/cms-composer-installers/autoload-include.php

// TYPO3 is installed via composer. Flag this with a constant.
#if (!defined('TYPO3_COMPOSER_MODE')) {
#    define('TYPO3_COMPOSER_MODE', TRUE);
#}
# Disable Composer mode


* Go to the Extensions / Get Extensions
Search for Extension Builder

TER ( typo3 Extension Repository)

Install the Extension Builder corresponding to typo3 version.


Extension Builder
Extenison Properties
Name: Memory
key: memory 
// Frontend plugin
Name : Memory, Key : game
/ Controller actions

 Game=>board

/ Non Cacheable actions

Game => board

Because of the form use  Non Cachable

//Backend Plugin
Name: Highscore, key: highscore

Main Module : tools
can choose  web, user
web: appears on Web module
user: appears under user menu
Tools: appears in Admin Tools

Controller action combinations:
Highscore =>leaderboard

Click SAVE
IGnore warning message
Click OK on success

## Create Two Models
* Drag and drop New Model Object 
* Click on Show Advanced Options

**DOmain Obkject Settings**
DOmain Object Type : Entity
is aggregate root ? : Checked (A database table will be created
for this model, a repository will be create),
Don't need an aggregate root if object is a part of another object

**DEfault Action**
CRUD
board will act like 'list'
rest of the card will be done in the backend
Could have created the board action here under 'custom actions'
as well

**Properties**
Add new :
card : image
    set allowed number of file : 1
    set is required :checked
    IS excclude field (to show for admins)
    Admin can edit it but not the editor groups
    
 exclude l10n_mode = exclude: for multilanguage support
 leave it default
 
 Create  a new Model Object: Highscore
 type: entity. aggregate rot
 
 
 Properties: 
 username: string, required
 score: integer, required

Save everything
and Install Extension 'Memory'

Notice a new Module added to the Admin Tools,
Ned to be configured later, now shows an error message when clicked on it
>Could not analyse class: "Slaleye\Memory\Controller\HighscoreController"
 maybe not loaded or no autoloader? Class Slaleye\Memory\Controller\HighscoreController does not exist

Also in page , plugin memory is available

## Create pages
 create new pages : standard 'Memory' and folder 'Memory'
 Edit Memory page
  add content  Plugin : Memory
  General
    add headline: memory
    set type : hidden
  Plugin
    add Record Storage page  'Memory' folder
## Edit Root Template
Click on root page, Template /Edit whole records

Go to Includes, add
Memory (Memory ) to Include static from extensions.

## uploading Pictures into the backend
Got to File module /Filelist/
Create folder: udemy_course/memory

Go to Folder Memory then List Module
and create 4 records of type cards and add the images respectively.
  