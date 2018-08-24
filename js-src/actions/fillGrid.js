
export default ({model, items}) => (state, actions) => {
    let list = state.lists.find(list => list.id === model)
    if (! list) {
        list = {id: model, items: []}
        state.lists.push(list)
    }

    list.items.splice(0, list.items.length)
    items.forEach(i => list.items.push(i))

    return Object.assign({}, state)
}