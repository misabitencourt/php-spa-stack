
const { h } = window.hyperapp

const getSearchField = ({searchMethod, model, state, actions}) => {

    if (searchMethod === 'date-range') {
        return h('div', {className: 'row'}, [
            
            h('div', {className: 'col-md-4'}, [
                h('label', {className: 'text-white'}, 'Entre (inicio)'),
                h('input', {type: 'text', name: '__search_start', className: 'form-control text-white date', 
                        placeholder: 'DD/MM/YYYY',
                        value: state.inEdition.__search_start ? dayjs(state.inEdition.__search_start).format('DD/MM/YYYY') : '',
                        onchange: e => actions.editField(e)})
            ]),
            
            h('div', {className: 'col-md-4'}, [
                h('label', {className: 'text-white'}, 'Entre (fim)'),
                h('input', {type: 'text', name: '__search_end', className: 'form-control text-white date', 
                        placeholder: 'DD/MM/YYYY',
                        value: state.inEdition.hire_date ? dayjs(state.inEdition.__search_end).format('DD/MM/YYYY') : '',
                        onchange: e => actions.editField(e)})
            ]),

            h('div', {className: 'col-md-4 text-md-left pt-3'}, [
                h('button', {className: 'btn btn-primary text-white', onclick() {
                    actions.gridSearch({model, value: `${state.inEdition.__search_start}--${state.inEdition.__search_end}`})
                }}, 'Pesquisar')
            ])
        ])
    }

    return h('input', {
        type: 'text', 
        className: 'form-control text-white', 
        placeholder: 'Pesquisar',
        onkeyup: e => {
            window.keydownTimeout && window.clearTimeout(window.keydownTimeout);
            window.keydownTimeout = window.setTimeout(() => {
                actions.gridSearch({model, value: e.target.value})
            }, 800)
        }
    })
}

export default ({model, cols, state, actions, searchMethod='string'}) => {
    const list = (state.lists.find(list => list.id === model) || {items: []})

    return h('div', {className: 'table-wrp'}, [
        h('table', {
            className: 'table table-bordered table-stripped bg-white', 
            oncreate: () =>  actions.fetchGrid(model, '')
        }, [
    
            h('thead', {}, [
                h('tr', {}, [
                    h('th', {className: 'bg-primary text-md-right', colSpan: cols.length}, [
                        h('div', {className: 'row'}, [
                            h('div', {className: 'col-md-6'}),
                            h('div', {className: 'col-md-6'}, [
                                getSearchField({searchMethod, model, state, actions})
                            ])
                        ])
                    ])
                ]),
    
                h('tr', {}, cols.map(col => 
                    h('th', {className: 'bg-primary text-white'}, col.name)
                ))
            ]),
    
    
            h('tbody', {}, list.items.map(item => 
                h('tr', {className: 'pointer', onclick: () => actions.gridSelection({model, item})}, cols.map(col => 
                    h('td', {}, col.format ? col.format(item[col.id]) : item[col.id])
                ))
            ))
        ])
    ])
}
    