"use strict";

/**
 * Memory
 */
(function( $ ) {
    var memory = null;

    // Plugin definition.
    $.fn.memory = function( options ) {
        memory = this;

        initHighscoreForm(memory);

        $(this).find(".memory-card").each(function(){
            $(this).click(function(){
                var flipCount = 0;
                var thisCard = getCard(this);
                if ($(memory).attr("data-flipped"))
                {
                    flipCount = parseInt($(memory).attr("data-flipped"), 10);
                }

                // if more than 2 flipped, then unflip all cards first
                flipCount = unflipCards(memory, this, flipCount);

                // flip current card
                flipCard(memory, this);

                //check if there is already a card flipped, if so and its equals
                //with the current one, then delete those cards
                if (flipCount == 1 && memory.flippedCard && thisCard && $(memory.flippedCard).attr("data-uid") == $(thisCard).attr("data-uid") &&  $(memory.flippedCard).attr("data-index") != $(thisCard).attr("data-index"))
                {
                    scoreCards(memory, memory.flippedCard, thisCard);

                    //check if user has won
                    setTimeout(function(){
                        if (checkWinningState(memory))
                        {
                            //if user won, then show win message
                            win(memory);
                        }
                    }, 800);

                    flipCount = -1;
                    memory.flippedCard = null;
                }

                //save flip count
                saveFlipCount(memory, this, flipCount);

                // save flippedCard
                if (flipCount == 0)
                {
                    memory.flippedCard = $(this).next();
                }
            });
        });
    };

    /**
     * Initialize the highscore form
     * @param jQuery memory
     * @return void
     */
    function initHighscoreForm(memory)
    {
        memory.dialog = $("#highscore-form").dialog({
            autoOpen: false,
            height: 200,
            width: 300,
            modal: true,
            buttons: {
                "Save Highscore": saveHighscore,
                Cancel: function() {
                    memory.dialog.dialog("close");
                }
            }
        });
    }

    /**
     * Calculate the highscore
     * @param jQuery inMemory
     * @return integer
     */
    function calculateHighscore(inMemory)
    {
        return Math.ceil(((100 / inMemory.flipCount) + 1) * inMemory.score);
    }

    /**
     * Check if user ha swon
     * @param jQuery inMemory
     * @return boolean
     */
    function checkWinningState(inMemory)
    {
        var invisibleCount = $(inMemory).find(".memory-scored").length;
        var maxCount = $(inMemory).find(".memory-cover").length;

        return invisibleCount == maxCount ? true : false;
    }

    /**
     * Flips a card
     * @param jQuery inMemory
     * @param jQuery inElement
     * @return void
     */
    function flipCard(inMemory, inElement)
    {
        $(inElement).parent().toggleClass("memory-flip");

        //increment flip count for highscore
        if (!inMemory.flipCount)
        {
            inMemory.flipCount = 0;
        }

        inMemory.flipCount++;
    }

    /**
     * Returns the card of the given element, which can be the card
     * or its cover
     * @param jQuery inElement
     * @return jQuery
     */
    function getCard(inElement)
    {
        return $(inElement).hasClass("memory-cover") ? $(inElement).next() : $(inElement);
    }

    /**
     * Saves the current flipCount
     * @param jQuery inMemory
     * @param jQuery inElement
     * @param int inFlipCount
     * @return void
     */
    function saveFlipCount(inMemory, inElement, inFlipCount)
    {
        if ($(inElement).hasClass("memory-cover"))
        {
            $(inMemory).attr("data-flipped", inFlipCount+1);
        }else
        {
            $(inMemory).attr("data-flipped", inFlipCount-1);
        }
    }

    /**
     * Sends highscore to AjaxController
     * @param jQuery inMemory
     * @param int inHighscore
     * @return void
     */
    function saveHighscore()
    {
        var form = $(this).children();
        var saveHighscoreUrl = $("#highscore-form-save-highscore-url");

        $.ajax({
            url: saveHighscoreUrl.length > 0 ? saveHighscoreUrl.val() : $(form).attr("action"),
            data: $(form).serialize(),
            method: "post",
            dataType: "json",
            success: function(inData){
                if (inData.state == "success")
                {
                    memory.dialog.dialog("close");
                    alert("Highscore saved. Refresh Browser to restart the game.");
                }else
                {
                    alert(inData.message);
                }
            },
            error: function(inData) {
                alert("Highscore could not be saved. Make sure your entered an username.");
            }

        });
    }

    /**
     * Delete flipped cards save score
     * @param jQuery inMemory
     * @param jQuery inCard1
     * @param jQuery inCard2
     * @return void
     */
    function scoreCards(inMemory, inCard1, inCard2)
    {
        $([inCard1, inCard2]).each(function(){
            $(this).addClass("memory-equal");

            {
                var element = this;
                setTimeout(function(){
                    $(element).parent().addClass("memory-scored");
                }, 500);
            }
        });

        if (!inMemory.score)
        {
            inMemory.score = 0;
        }

        inMemory.score+=10;
        console.log("Score: " + inMemory.score);
    }

    /**
     * Unflips all cards
     * @param jQuery inMemory
     * @param jQuery inElement
     * @param int inFlipCount
     * @return void
     */
    function unflipCards(inMemory, inElement, inFlipCount)
    {
        if (inFlipCount >= 2 && $(inElement).hasClass("memory-cover"))
        {
            $(inMemory).find(".memory-flip").removeClass("memory-flip");

            //reset flipCount
            inFlipCount = 0;
        }

        return inFlipCount;
    }

    /**
     * End the game with winning message
     * @param jQuery inMemory
     * @return void
     */
    function win(inMemory)
    {
        alert("You win!!!");
        var highscore = calculateHighscore(inMemory);
        $("#highscore-form-highscore").val(highscore);
        inMemory.dialog.dialog("open");
    }

    $(document).ready(function(){
        /* Init memory Plugin */
        $(".tx-memory").memory();
    });
})( jQuery );