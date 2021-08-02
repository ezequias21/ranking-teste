
function startPaginator() {

    const html = {
        get(element) {
            return $(element)
        }
    }

    let perPage = 4
    const table = {
        classTable: ".custom-pagination",
        tableBody: ".custom-pagination tbody",
        tableRow: ".custom-pagination tbody tr",
        paginationControls: ".pagination-controls",
        paginationcontrolsLi: ".pagination-controls li",
        paginationcontrolsLiNumber: ".pagination-controls .number"

    }
    const state = {
        page: 1,
        perPage,
        totalPage: Math.ceil($(table.tableRow).length / perPage),
        maxVisibleButtons: 4,
        buttonsLeft: 2,
        buttonsRight: 1,
    }

    console.log(state)
    console.log(table)
    const controls = {
        next() {
            state.page++
            const lastPage = state.page > state.totalPage
            if (lastPage) {
                state.page--
            }
        },
        prev() {
            state.page--
            if (state.page < 1) {
                state.page++
            }
        },
        goTo(page) {
            if (state.page < 1) {
                page = 1
            }
            state.page = page

            if (page > state.totalPage) {
                state.page = state.totalPage
            }
        },
        createListeners() {
            /*  html.get('.first').click(function(){
                 controlsGoTo(1)
                 update()
             })
             html.get('.last').click(function(){
                 controlsGoTo(state.totalPage)
                 update()
             }) */
            html.get('.btn-prev').click(function () {
                controls.prev()
                update()
            })
            html.get('.btn-next').click(function () {
                controls.next()
                update()
            })
        }
    }
    const list = {
        create(item) {

        },
        update() {
            const { tableRow } = table
            html.get(tableRow).hide()
            let page = state.page - 1
            let start = page * state.perPage
            let end = start + state.perPage
            html.get(tableRow).slice(start, end).show()

        }
    }

    const buttons = {
        create(page) {

            var classActive = state.page == page ? classActive = "active" : ""
            html.get(table.paginationControls)
                .append(`<li class="number ${classActive}"><span>${page}</span></li>`)
        },
        update() {

            const { buttonsLeft, buttonsRight } = state
            html.get(table.paginationcontrolsLi).remove()

            if (state.totalPage <= state.maxVisibleButtons) {
                maxLeft = 1
                maxRight = state.totalPage
            }
            else if ((state.page - state.maxVisibleButtons + buttonsRight) <= 0) {
                maxLeft = 1
                maxRight = state.maxVisibleButtons
            }
            else if (state.page + buttonsRight <= state.totalPage) {
                maxLeft = state.page - buttonsLeft
                maxRight = state.page + buttonsRight
            } else {
                maxLeft = state.totalPage + 1 - state.maxVisibleButtons
                maxRight = state.totalPage
            }

            html.get(table.paginationControls).append(`<li class="btn-prev"><i class="fas fa-angle-left icon-right"></i><span>Anterior</span></li>`)
            for (let page = maxLeft; page <= maxRight; page++) {
                buttons.create(page)
            }

            html.get(table.paginationControls).append(`<li class="btn-next"><span>Próximo</span><i class="fas fa-angle-right icon-next"></i></li>`)

            html.get(table.paginationcontrolsLiNumber).each(function () {
                $(this).click(function () {
                    html.get(table.paginationcontrolsLiNumber).removeClass("active")
                    const page = parseInt($(this).addClass("active").text())
                    controls.goTo(page)
                    list.update()
                })
            })
            controls.createListeners()

        },
        calculateMaxVisible() {
            const { maxVisibleButtons } = state
            let maxLeft = (state.page - Math.floor(maxVisibleButtons / 2))
            let maxRight = (state.page + Math.floor(maxVisibleButtons / 2))
            if (maxLeft < 1) {
                maxLeft = 1
                maxRight = maxVisibleButtons
            }
            if (maxRight > state.totalPage) {
                maxLeft = state.totalPage - (maxVisibleButtons - 1)
                maxRight = state.totalPage
            }
            return { maxLeft, maxRight }
        }
    }
    function update() {
        list.update()
        buttons.update()
    }
    function init() {
        buttons.update()
        list.update()
    }
    init()
}



/* class Paginator {


    constructor(state, table, namePaginator) {
        this.state = state
        this.nameTable = table
        this.namePaginator = namePaginator
    }
    htmlGet(element) {
            return $(element)
        
    }
    table = {

        classTable: this.nameTable,
        tableBody: this.nameTable + " tbody",
        tableRow: this.nameTable + " tbody tr",
        paginationControls: this.namePaginator,
        paginationcontrolsLi: this.namePaginator + " li",
        paginationcontrolsLiNumber: this.namePaginator + " .number"

    }


    controlsNext() {
        state.page++
        const lastPage = state.page > state.totalPage
        if (lastPage) {
            state.page--
        }
    }
    controlsPrev() {
        state.page--
        if (state.page < 1) {
            state.page++
        }
    }
    controlsGoTo(page) {
        if (state.page < 1) {
            page = 1
        }
        state.page = page

        if (page > state.totalPage) {
            state.page = state.totalPage
        }
    }
    controlsCreateListeners() {
       
        this.htmlGet('.btn-prev').click(function () {
            controlsPrev()
            this.update()
        })
        this.htmlGet('.btn-next').click(function () {
           controlsNext()
            this.update()
        })
    }



    createList(item) {

    }

    updateList() {
        const { tableRow } = this.table
        this.htmlGet(tableRow).hide()
        let page = state.page - 1
        let start = page * state.perPage
        let end = start + state.perPage
        this.htmlGet(tableRow).slice(start, end).show()

    }



    createButtons(page) {

        var classActive = state.page == page ? classActive = "active" : ""
        this.htmlGet(this.table.paginationControls)
            .append(`<li class="number ${classActive}"><span>${page}</span></li>`)
    }
    updateButtons() {

        const { buttonsLeft, buttonsRight } = this.state
        this.htmlGet(this.table.paginationcontrolsLi).remove()

        if (this.state.totalPage <= this.state.maxVisibleButtons) {
            maxLeft = 1
            maxRight = this.state.totalPage
        }
        else if ((this.state.page - this.state.maxVisibleButtons + buttonsRight) <= 0) {
            maxLeft = 1
            maxRight = this.state.maxVisibleButtons
        }
        else if (this.state.page + buttonsRight <= this.state.totalPage) {
            maxLeft = this.state.page - buttonsLeft
            maxRight = this.state.page + buttonsRight
        } else {
            maxLeft = this.state.totalPage + 1 - this.state.maxVisibleButtons
            maxRight = this.state.totalPage
        }

        this.htmlGet(this.table.paginationControls).append(`<li class="btn-prev"><i class="fas fa-angle-left icon-right"></i><span>Anterior</span></li>`)
        for (let page = maxLeft; page <= maxRight; page++) {
            this.createButtons(page)
        }

        this.htmlGet(this.table.paginationControls).append(`<li class="btn-next"><span>Próximo</span><i class="fas fa-angle-right icon-next"></i></li>`)

        this.htmlGet(this.table.paginationcontrolsLiNumber).each(function () {
            $(this).click(function () {
                this.htmlGet(this.table.paginationcontrolsLiNumber).removeClass("active")
                const page = parseInt($(this).addClass("active").text())
                this.controlsGoTo(page)
                this.updateList()
            })
        })
        this.controlsCreateListeners()

    }
    calculateMaxVisible() {
        const { maxVisibleButtons } = state
        let maxLeft = (this.state.page - Math.floor(maxVisibleButtons / 2))
        let maxRight = (this.state.page + Math.floor(maxVisibleButtons / 2))
        if (maxLeft < 1) {
            maxLeft = 1
            maxRight = maxVisibleButtons
        }
        if (maxRight > state.totalPage) {
            maxLeft = state.totalPage - (maxVisibleButtons - 1)
            maxRight = state.totalPage
        }
        return { maxLeft, maxRight }
    }



    update() {
        this.updateList()
        this.updateButtons()
    }
    init() {
        this.updateButtons()
        this.updateList()
    }



} */

function removePagination(nomePaginador){
   /*  if(nomePaginador){
        $(nomePaginador + " li").remove();

    } */
}
function startPaginatorParametros(nomeTabela, nomePaginador) {


   

        const html = {
            get(element) {
                return $(element)
            }
        }
        
        let perPage = 4
        const table = {
            classTable: nomeTabela,
            tableBody: nomeTabela + " tbody",
            tableRow: nomeTabela + " tbody tr",
            paginationControls: nomePaginador,
            paginationcontrolsLi: nomePaginador +  " li",
            paginationcontrolsLiNumber: nomePaginador + " .number"
            
        }
        const state = {
            page: 1,
            perPage,
            totalPage: Math.ceil($(table.tableRow).length / perPage),
            maxVisibleButtons: 4,
            buttonsLeft: 2,
            buttonsRight: 1,
        }
        

        const controls = {
            next() {
                state.page++
                const lastPage = state.page > state.totalPage
                if (lastPage) {
                    state.page--
                }
            },
            prev() {
                state.page--
                if (state.page < 1) {
                    state.page++
                }
            },
            goTo(page) {
                if (state.page < 1) {
                    page = 1
                }
                state.page = page

                if (page > state.totalPage) {
                    state.page = state.totalPage
                }
            },
            createListeners() {
                /*  html.get('.first').click(function(){
                    controlsGoTo(1)
                    update()
                })
                html.get('.last').click(function(){
                    controlsGoTo(state.totalPage)
                    update()
                }) */
                html.get('.btn-prev').click(function () {
                    controls.prev()
                    update()
                })
                html.get('.btn-next').click(function () {
                    controls.next()
                    update()
                })
            }
        }
        const list = {
            create(item) {
                
            },
            update() {
                const { tableRow } = table
                html.get(tableRow).hide()
                let page = state.page - 1
                let start = page * state.perPage
                let end = start + state.perPage
                html.get(tableRow).slice(start, end).show()
                
            }
        }
        
        const buttons = {
            create(page) {
                
                var classActive = state.page == page ? classActive = "active" : ""
                html.get(table.paginationControls)
                .append(`<li class="number ${classActive}"><span>${page}</span></li>`)
        },
        update() {
            
            const { buttonsLeft, buttonsRight } = state
            html.get(table.paginationcontrolsLi).remove()
            if (state.totalPage <= state.maxVisibleButtons) {
                maxLeft = 1
                maxRight = state.totalPage
            }
            else if ((state.page - state.maxVisibleButtons + buttonsRight) <= 0) {
                maxLeft = 1
                maxRight = state.maxVisibleButtons
            }
            else if (state.page + buttonsRight <= state.totalPage) {
                maxLeft = state.page - buttonsLeft
                maxRight = state.page + buttonsRight
            } else {
                maxLeft = state.totalPage + 1 - state.maxVisibleButtons
                maxRight = state.totalPage
            }
            
            html.get(table.paginationControls).append(`<li class="btn-prev"><i class="fas fa-angle-left icon-right"></i><span>Anterior</span></li>`)
            for (let page = maxLeft; page <= maxRight; page++) {
                buttons.create(page)
            }
            
            html.get(table.paginationControls).append(`<li class="btn-next"><span>Próximo</span><i class="fas fa-angle-right icon-next"></i></li>`)
            
            html.get(table.paginationcontrolsLiNumber).each(function () {
                $(this).click(function () {
                    html.get(table.paginationcontrolsLiNumber).removeClass("active")
                    const page = parseInt($(this).addClass("active").text())
                    controls.goTo(page)
                    list.update()
                })
            })
            controls.createListeners()
            
        },
        calculateMaxVisible() {
            const { maxVisibleButtons } = state
            let maxLeft = (state.page - Math.floor(maxVisibleButtons / 2))
            let maxRight = (state.page + Math.floor(maxVisibleButtons / 2))
            if (maxLeft < 1) {
                maxLeft = 1
                maxRight = maxVisibleButtons
            }
            if (maxRight > state.totalPage) {
                maxLeft = state.totalPage - (maxVisibleButtons - 1)
                maxRight = state.totalPage
            }
            return { maxLeft, maxRight }
        }
    }
    function update() {
        list.update()
        buttons.update()
    }
    function init() {
        buttons.update()
        list.update()
    }
    init()

}