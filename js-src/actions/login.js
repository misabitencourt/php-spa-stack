import loginSrv from '../services/login'

export const submit = e => (state, actions) => {
    e.preventDefault()
    const credentials = new FormData(e.target)
    loginSrv.login(credentials).then(user => {
        sessionStorage.setItem('user', JSON.stringify(user))
        window.location.reload()
    }).catch(err => {
        if (err === 'INVALID_CREDENTIALS') {
            actions.pushNotificationShow({
                type: 'danger',
                msg: 'Login incorreto'
            })
        } else {
            console.log('NOT_ERROR')
        }
    })

    return Object.assign({}, state)
}