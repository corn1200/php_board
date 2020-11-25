function getParameterByName(name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
            results = regex.exec(location.search);
    return results == null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}


$(document).ready(function(e) {
    $("#order").change(function() {
        var self = $(this);
        var select;

        if(self.attr("id") === "order") {
            select = self.val();
        }

        $.post("/controller/select_checker.php", { category: getParameterByName('category'), search: getParameterByName('search') }, function(data) {
            location.href = '/view/mainpage.php?list='+document.getElementById('num').options[document.getElementById('num').selectedIndex].text+'&order='+document.getElementById('order').options[document.getElementById('order').selectedIndex].text+data;
        });
    })
});