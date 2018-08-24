

export const price = val => {
    if (isNaN(val)) {
        return ''
    }

    return `R$${parseFloat(val).toFixed(2).split('.').join(',')}`
}