$.fn.exists = function () {
    return this.length !== 0;
};

$(document).ready(function () {
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
});
