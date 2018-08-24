import api from '../repos/api'

export default {

    async list(model, search='') {
        return await api.get(`/api/${model}/${search ? `?search=${encodeURIComponent(search)}` : ''}`)
    },

    async save(model, data) {
        try {
            return await api.post(`/api/${model}/`, data)
        } catch (e) {
            throw e;
        }
    },

    async update(model, data, id) {
        try {
            return await api.put(`/api/${model}/${id}/`, data)
        } catch (e) {
            throw e;
        }
    },

    async destroy(model, id) {
        return await api.destroy(`/api/${model}/${id}/`)
    }

}