$.fn.exists = function () {
    return this.length !== 0;
};

$(document).ready(function () {
    const $title = $("#title");
    /**
     *  Érdekesség a jquery világából :-)
     *  Ha valamire rámutatunk akkor történik valami.

     $(".btn").hover(function () {
        $(".btn").css("font-size", "20px");
        $(".btn").css("bg-color", "yellow");
    }, function () {
        $(".btn").css("bg-color", "white");
        $(".btn").css("font-size", "16px");
    });
     */
    // A kezdőoldal keresőmezője
    if ($title.exists()) {
        $title.focus();
        $("#egybelep").disabled = true;
        $title.autocomplete({
            minLength: 2,
            delay: 300,
            source: "index.php/kezd/getAutocomplete/?",
            select: function (event, ui) {
                $("[name='sorsz']").val(ui.item.sorsz);
                $("[name='nev']").val(ui.item.nev);
                $("[name='szul_datum']").val(ui.item.szul_datum);
                $("[name='cegnev']").val(ui.item.cegnev);
                $("[name='besorolas']").val(ui.item.besorolas);
                $("[name='programresz']").val(ui.item.programresz);
                $("[name='megjegy']").val(ui.item.megjegyzes);
                $("[name='belepett']").val(ui.item.belepett);
                $("[name='befiz']").val(ui.item.szdarab);
                $("[name='gybefiz']").val(ui.item.gyszdarab);
                $("#egybelep").prop("disabled", false);
                $("#karsz").prop("disabled", false);
                $("#gykarsz").prop("disabled", false);
                return false;
            }
        }).data("ui-autocomplete")._renderItem = function (ul, item) {
            let bel = "";
            if (item.belepett === "Nincs belépve") {
                bel = "<div class=\"d-inline bg-light text-danger \">Nincs belépve.</div>";
            } else {
                bel = "<div class=\"d-inline bg-light text-primary\">" + item.belepett + "</div>";
            }
            return $("<li class=\"list-group-item p-0\">")
                .append("<div><strong>" + item.nev + "</strong> - " + item.szul_datum + "<br>" + item.cegnev + "<br>" + bel + "</div></li>")
                .appendTo(ul);
        };
    }
});
