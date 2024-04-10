$(document).ready(function() {
    $(".skin").click(function() {
        $(".skin").css("background-color", "");
        const teamName = $(this).text();
        $(".skin:contains('" + teamName + "')").css("background-color", "#ff005a");
    });
});