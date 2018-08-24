
export default {

    async get(url) {
        const res = await fetch(url, {
            credentials: 'same-origin'
        })

        if (res.status === 401) {
            sessionStorage.clear()
            return window.location.reload()
        }

        return await res.json()
    },

    async post(url, body) {
        const res = await fetch(url, {
            method: 'POST',
            body,
            credentials: 'same-origin'
        })

        if (res.status === 500 || res.status === 400) {
            throw await res.text();
        }

        if (res.status === 401) {
            sessionStorage.clear()
            return window.location.reload()
        }

        return await res.json()
    },

    async put(url, body) {
        const res = await fetch(url, {
            method: 'PUT',
            body: JSON.stringify(body),
            credentials: 'same-origin'
        })

        if (res.status === 500 || res.status === 400) {
            throw await res.text();
        }

        if (res.status === 401) {
            sessionStorage.clear()
            return window.location.reload()
        }

        return await res.json()
    },

    async destroy(url) {
        const res = await fetch(url, {
            method: 'DELETE',
            credentials: 'same-origin'
        })

        if (res.status === 401) {
            sessionStorage.clear()
            return window.location.reload()
        }

        return await res.json()
    }
}