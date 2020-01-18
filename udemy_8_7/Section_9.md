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
    
 