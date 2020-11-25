$(document).ready(function(e) {
    $("#id").on("keyup", function() {
        var self = $(this);
        var userid;

        if(self.attr("id") === "id") {
            userid = self.val();
        }

        $.post("/controller/sign_checker.php", { userid: userid }, function(data) {
            self.parent().parent().find("#id_check").html(data);
            if(data == "ID already exists.") {
                self.parent().parent().find("#id_check").css("color", "#F00");
                $('#submit').attr('disabled', true);
            } else if(data == "Your ID is valid.") {
                self.parent().parent().find("#id_check").css("color", "#00871d");
                $('#submit').attr('disabled', false);
            } else {
                self.parent().parent().find("#id_check").css("color", "#000000");
                $('#submit').attr('disabled', true);
            }
        });
    });
});