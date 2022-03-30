$.fn.exists = function () {
    return this.length !== 0;
};


/**
 *
 * A csoportos belépésnél a legördülő listában
 * kiválasztott cégnevek alapján, létrehozza a
 * cégben lévő belépők listáját.
 *
 */
$(document).ready(function () {
    const $csoportok = $("#csoportok");
    const $csopgomb = $("#csopgomb");
    if ($csoportok.exists()) {
        $csoportok.focus();
        $csoportok.change(function () { // a legördülő listában változtatunk
            let csid = $csoportok.val();
            // A csoportok lekérdezése ajax-al.
            $.ajax({
                url: "csoportos/csopval",
                method: "post",
		dataType: "json",
                data: "csid=" + csid,
                error: function (xhr) {
		    $("#benvan").empty();
		    $("#szamok").empty();
                }
            }).done(function (fellepok) {
                $("#csopupd").removeClass("disabled");
                //fellepok = JSON.parse(fellepok);
                $("#benvan").empty();
                $("#szamok").empty();
                let i = 1; // sorszámok megadása
                let belepett_szama = 0; // beléptetettek száma
                const chkbox = '; <input class="ml-1" type="checkbox" id="felhaszn" name="fellepo[]" value="';
                const label = '<label class="form-check-label ml-2" for="felhaszn">';
                fellepok.forEach(function (fellepo) {
                    let felhid = fellepo.sorsz;
                    if (fellepo.belepett == 1) {
                    	let lisben = '<li class="list-group-item p-1 bg-warning text-dark" title="Belépett: '+fellepo.miko+'\nProgramrész: '+fellepo.programresz+'">';
                        $('#benvan').append(lisben + i + chkbox + felhid + '" checked>' + label + fellepo.nev + '</label></li>');
                        belepett_szama++;
                        i++;
                    } else {
                    	let lis = '<li class="list-group-item p-1 bg-dark" title="Programrész: '+fellepo.programresz+'\nMég nem lépett be.">';
                        $('#benvan').append(lis + i + chkbox + felhid + '">' + label + fellepo.nev + '</label></li>');
                        i++;
                    }
                });
                i = i - 1;
		if(belepett_szama == 0) {
		console.log("Senki nem lépett be");
		}
                $("#szamok").append("Összesen: " + i + ", ebből: " + belepett_szama + " belépett." + "<br>Szabad jegyek száma: " + (i - belepett_szama));
            });
            $csopgomb.removeClass("disabled");
            $csopgomb.attr("href", "csoportos/csopbel/" + csid);
        });
    }
});
