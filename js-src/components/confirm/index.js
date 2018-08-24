const { h } = window.hyperapp

export default (state, actions) => h('div', {className: 'confirm-wrp'}, [
    h('div', {className: 'confirm-inner'}, [
        h('div', {className: 'row'}, [
            h('div', {className: 'col-md-8 pt-2'}, [
                h('p', {className: 'text-white'}, state.confirm.msg)
            ]),
            h('div', {className: 'col-md-4 text-md-right'}, [
                h('button', {className: 'btn btn-success mr-3', onclick: () => {
                    actions.confirmOk()
                }}, 'Sim'),
    
                h('button', {className: 'btn btn-danger', onclick: () => {
                    actions.confirmCancel()
                }}, 'Não')
            ])
        ])
    ])
])