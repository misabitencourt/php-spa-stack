

export const confirmOk = () => (state, actions) => {
    state.confirm.ok && state.confirm.ok();
    state.confirm = null

    return Object.assign({}, state)
}

export const confirmCancel = () => (state, actions) => {
    state.confirm.cancel && state.confirm.cancel();
    state.confirm = null

    return Object.assign({}, state)
}