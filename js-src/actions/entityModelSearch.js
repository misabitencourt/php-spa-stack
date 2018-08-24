import genericSrv from '../services/generic'

export default ({parent, model, value}) => (state, actions) => {
    const identifier = `${parent}_${model}`

    genericSrv.list(model, value).then(items => {
        actions.entitySearchFill({identifier, items})
    })
}

export const entitySearchFill = ({identifier, items}) => (state, actions) => {
    const exists = state.lists.find(l => l.model === identifier)
    if (exists) {
        state.lists.splice(state.lists.indexOf(exists), 1)
    }

    state.lists.push({
        model: identifier,
        value: items
    })

    return Object.assign({}, state)
}