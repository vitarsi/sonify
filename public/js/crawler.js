var urls = [
            "http://stackoverflow.com/questions/tagged/c",
            "http://stackoverflow.com/questions/tagged/php",
            "http://stackoverflow.com/questions/tagged/mysql",
            "http://stackoverflow.com/questions/tagged/database",
            "http://stackoverflow.com/questions/tagged/regex",
            "http://stackoverflow.com/questions/tagged/android",
            "http://stackoverflow.com/questions/tagged/java",
            "http://stackoverflow.com/questions/tagged/jquery",
            "http://stackoverflow.com/questions/tagged/css",
            "http://stackoverflow.com/questions/tagged/sockets"
            ];
var index = 0,
    questionsProcessed = 0,
    questionsToProcess = 0,
    tag = "";
function docInitialise() {
    $("#startButton").click(function() {
        crawl(index);
        $("#startButton").fadeOut();
    });
}
function crawl(index) {
    $("#currentJob").html("Fetching");
    $("#currentUrl").html(urls[index] + " - (" + (index+1) + " of " + urls.length + ")");
    
    // Extract the tag from the url
    tag = urls[index].match(/tagged\/([^?]+)/)[1];

    // Load the page and then parse
    var loader = $("#loader");
    loader.attr("src", "get.php?url="+urls[index]);
    loader.on("load", function() {
        extract(tag);
    });
    }
function extract(tag) {
    $("#currentJob").html("Processing: "+tag);
    var contents = $("#loader").contents();

    // Iterate through all questions
    contents.find(".question-summary").each(function(index, element){
        // Extract the summarised details
        var questionID, question, link, countAnswers, countVotes, countViews, excerpt;

        questionID = ($(element).attr('id')).match(/(\d)+/)[0];
        question = $(element).find("h3>a").html();
        link = $(element).find("h3>a").attr("href");
        countAnswers = $(element).find(".status>strong").html();
        countVotes = $(element).find(".vote-count-post>strong").html();
        countViews = ($(element).find(".views").html()).match(/([\d]+)/)[0];
        excerpt = $(element).find(".excerpt").html();

        questionsToProcess++;
        $("#currentState").html("Processing: "+questionsProcessed+"/"+questionsToProcess+" questions");
        // Save these details in the database
        $.post("update.php",{
                                questionID:questionID,
                                question:question,
                                link:link,
                                countAnswers:countAnswers,
                                countVotes:countVotes,
                                countViews:countViews,
                                excerpt:excerpt,
                                tag:tag
                            },
            function(data) {
                if (data.success=="false") {
                    alert("An error was encountered.");
                    alert(data.error);
                } else {
                    questionsProcessed++;
                    refresh();
                }

            }, "json");
    });
}
function refresh() {
    $("#currentState").html("Processing: "+questionsProcessed+"/"+questionsToProcess+" questions");
    if (questionsProcessed==questionsToProcess) {
        questionsProcessed = questionsToProcess = 0;
        index++;
        if (index < urls.length) {
            crawl(index);
        }
    } else if (index>=urls.length) {
        $("#currentJob").html("Done");
        $("#currentUrl").html("(all " + urls.length + " URLs)");
        $("#currentState").html("");
    }
}