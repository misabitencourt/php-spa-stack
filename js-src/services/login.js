import api from '../repos/api'

export default {

    async login(credentials) {
        const res = await fetch('/api/login/', {
            method: 'POST',
            credentials: 'same-origin',
            body: credentials
        })

        if (res.status === 401) {
            throw 'INVALID_CREDENTIALS'
        } else if (res.status !== 200) {
            throw new Error()
        }

        const json = await res.json()

        return json
    },

    async getPermissions() {
        return await api.get('/api/permissions/')
    }

}
