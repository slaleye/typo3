## Section 9 :Backend Module

Backend Module: all the items in the T3 Backend
Extensions for Bakcend
Positions: : web, tools, user

Creating a Backend Module:
* ActionController
 *actionnameAction()
 Registered in the ext_tables.php
 Configuration custom template folder in TS
 * Layout
 * Templates
 * Partials
 
 ### 29 Registering module and creating controller
 
 Module registered in ext_table

Controller,
no need to intialize repository, just use @inject

Debug utility for typo3

    DebugUtility::debug($highscores->toArray()); 
  
 USe debugutility to narow down errors   
//   DebugUtility::debug(__CLASS__.'::'.__FUNCTION__.'::'.__LINE__);

debug can be printed in fluid as well
<f:debug>{variablename}</f:debug>

<f:debug>{_all}</f:debug> print available variable for fluid

itn Typo3 Templates tools
Setup :
page.config.contentObjectExceptionHandler = 0
to print stack trace of errors !! not in dev env

Can also set in the backend
all config
[SYS][devIPmask] to print out dev output to user with those IPs