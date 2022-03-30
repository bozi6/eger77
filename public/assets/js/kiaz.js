$.fn.exists = function () {
    return this.length !== 0;
};

/*$(document).ready(function () {
    $("#eddigtablazat").tablesorter({
        theme: "metro-dark",
        sortLocaleCompare: true,
        sortStable: true,
        widgets: ["zebra"],
        headers: {
            4: {
                sorter: false
            }
        }
    });

 */
    // Az eddig belépett keresőmezője
    const $eddig = $("#eddig");
    const $eddigtbl = $("#eddigtbl");
    if ($eddig.exists()) {
        //$eddig.focus();
        $eddig.keyup(function () {
            const nev = $eddig.val();
            $.ajax({
                beforesend: function () {
                    $eddig.addClass("ui-autocomplete-loading");
                },
                url: "belepve/getEddig",
                complete: function () {
                    $eddig.removeClass("ui-autocomplete-loading");
                },
                method: "post",
                data: "nev=" + nev
            }).done(function (bennvannak) {
                bennvannak = JSON.parse(bennvannak);
                $eddigtbl.empty();
                bennvannak.forEach(function (bennvan) {
                    $eddigtbl.append("<tr>");
                    $eddigtbl.append("<td><strong>" + bennvan.id + ".</strong></td>");
                    $eddigtbl.append("<td>" + bennvan.nev + "</td>");
                    $eddigtbl.append("<td>" + bennvan.ceg + "</td>");
                    $eddigtbl.append("<td>" + bennvan.belepett + "</td>");
                    $eddigtbl.append("<td>" + bennvan.megjegyzes + "</td>");
                    $eddigtbl.append("</tr>");
                });
            });
        });
    }

//});
