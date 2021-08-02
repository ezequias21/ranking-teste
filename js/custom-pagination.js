function paginar() {

    
    var trnum = 0
    var maxRows = 5
    var totalRows = $(".custom-pagination tbody tr").length
    console.log("maxRows = ", maxRows)
    console.log("totalRows = ", totalRows)

    $(".custom-pagination tr:gt(0)").each(function () {
        trnum++
        if (trnum > maxRows) {
            console.log("trnum= ", trnum)
            $(this).hide()
        }
        if (trnum <= maxRows) {
            $(this).show()
        }
    })

    if (totalRows > maxRows) {
        var pagenum = Math.ceil(totalRows / maxRows)
        for (var i = 1; i <= pagenum; i++) {
            $(".pagination-controls").append("<li class='number'  data-page='" + i + "'><span>" + i + "</span></li>").show()
        }
        $(".pagination-controls li:first-child").addClass("active")
        $(".pagination-controls").prepend("<li class='btn-prev'><span><i class='fas fa-angle-left'></i> Anterior</span></li>")
        $(".pagination-controls").append(" <li class='btn-next'><span>Próximo <i class='fas fa-angle-right'></i></span></li>")

    }
    $(".pagination-controls li").on("click", function () {
        var pagenum = $(this).attr("data-page")
        var trIndex = 0
        $(".pagination-controls li").removeClass("active")
        $(this).addClass("active")
        $(".custom-pagination tr:gt(0)").each(function () {
            trIndex++
            if (trIndex > (maxRows * pagenum) || trIndex <= ((maxRows * pagenum) - maxRows)) {
                $(this).hide()
            } else {
                $(this).show()
            }
        })
    })












}









function removePagination() {
    $(".pagination-controls li").remove()
}