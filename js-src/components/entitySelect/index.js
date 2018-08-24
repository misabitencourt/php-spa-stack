import icon from '../icon/index'
const { h } = window.hyperapp

export default ({state, actions, parent, model, descriptionProp, childrenList=null, childIndex=null}) => {
    const searchingList = state.lists.find(l => l.model === `${parent}_${model}`)
    console.log(state.inEdition)

    let value
    if (childrenList) {
        value = state.inEdition && state.inEdition[childrenList][childIndex][model]
    } else {
        value = state.inEdition && state.inEdition[model]
    }

    return h('div', {className: 'entity-select'}, [
    
        value ? (
    
            h('div', {className: 'row'}, [
                h('div', {className: 'col-md-9 pt-2 description'}, value[descriptionProp] || ''),

                h('div', {className: 'col-md-3'}, [
                    h('button', {className: 'btn btn-sm btn-default', type: 'button', onclick: () => {
                        actions.editField({target: {
                            name: model,
                            value: null,
                            childrenList,
                            childIndex
                        }}) 
                    }}, [
                        icon({name: 'delete', w: 24, he: 24})
                    ])
                ])
            ])
    
        ) : (
            
            h('input', {className: 'form-control', placeholder: 'Pesquisar', onkeyup: e => {
                window.searchDebounce && window.clearTimeout(window.searchDebounce);
                window.searchDebounce = setTimeout(() => {
                    actions.entityModelSearch({parent, model, value: e.target.value})
                }, 800)
            }})
        ),

        ((!value) && searchingList && searchingList.value.length) ? (
            h('ul', {className: 'dropdown-menu always-visible'}, searchingList.value.map(item => 
                h('li', {className: 'dropdown-item', onclick: () => {
                    actions.editField({
                        target: {
                            name: model,
                            value: item
                        },
                        childrenList,
                        childIndex
                    })
                }}, item[descriptionProp])
            ))
        ) : (
            h('div')
        )
    
    ])
}