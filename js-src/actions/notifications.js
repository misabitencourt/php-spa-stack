
export const show = notice => (state, actions) => {
    state.pushNotifications = [notice, ...state.pushNotifications]
    setTimeout(() => {
        actions.pushNotificationHide(notice)
    }, 5e3)

    return Object.assign({}, state)
}


export const hide = notice => (state, actions) => {
    state.pushNotifications.splice(state.pushNotifications.indexOf(notice), 1)
    return Object.assign({}, state)
}