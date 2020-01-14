## Section 7 Ajax & eID

###Typenum

add PAGE object type ajax and get content of the plugin, then removes html stuff.
````
ajax = PAGE
ajax {
    typeNum = 100
    10  < tt_content.list.20.memory_game
    config {
        disableAllHeaderCode = 1
        xhtml_cleaning = 0
        admPanel = 0
        debug = 0
        no_cache = 1
        contentObjectExceptionHandler = 1
    }
}

````
Then add parameter type = 100 in form

````xml
<div id="highscore-form" title="{f:translate(key:'highscore-form-title')}">
    <f:form action="saveHighscoreForm" object="{highscore}" name="highscore" additionalParams="{type:100}">
        <fieldset>
            <f:form.hidden  id="highscore-form-highscore"  property="score" value="0"/>
            <f:form.textfield id="highscore-form-username" property="username"
            value="" placeholder="{f:translate(key:'highscore-form-username')}" />
        </fieldset>
    </f:form>
</div>

````
Ajax via eID
special T3 mode, no frontend context: no user sessions, injectiosn, processing of annotations
uses less resources

eID skips processes in normal request, so we should define the processes required for the request
