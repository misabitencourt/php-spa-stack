

export const addChildrenInEdition = ({children}) => (state, actions) => {
    state.inEdition = state.inEdition || {};
    state.inEdition[children] = state.inEdition[children] || [];
    state.inEdition[children].push({})

    return Object.assign({}, state)
}


export const removeChildrenInEdition = ({children, index}) => (state, actions) => {
    state.inEdition = state.inEdition || {};
    state.inEdition[children] = state.inEdition[children] || [];
    state.inEdition[children].splice(index, 1)

    return Object.assign({}, state)
}